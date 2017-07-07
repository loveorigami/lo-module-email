<?php

namespace lo\modules\email\modules\admin\controllers;

use lo\core\helpers\DateHelper;
use lo\core\actions\crud\Settings;
use lo\modules\email\adapters\EmailSettingsInterface;
use lo\modules\email\forms\EmailForm;
use lo\modules\email\modules\admin\dto\StateDto;
use lo\modules\email\modules\admin\services\SendService;
use Yii;
use yii\web\Controller;
use yii\web\Response;

/**
 * Class EmailSendController
 * @package lo\modules\email\modules\admin\controllers
 * @author Lukyanov Andrey <loveorigami@mail.ru>
 */
class EmailSendController extends Controller
{
    const CAT_ID = 'email.cat_id';
    const TPL_ID = 'email.tpl_id';
    const SESSION = 'email.send_session';
    const COUNT = 'email.count';
    const LIMIT = 'email.limit';
    const DATE_SEND = 'email.date_send';

    /** @var EmailSettingsInterface */
    private $settings;

    /** @var SendService */
    private $sendServive;

    /**
     * EmailSendController constructor.
     * @param string $id
     * @param \yii\base\Module $module
     * @param EmailSettingsInterface $settings
     * @param SendService $service
     * @param array $config
     */
    public function __construct($id, $module, EmailSettingsInterface $settings, SendService $service, $config = [])
    {
        $this->settings = $settings;
        $this->sendServive = $service;
        parent::__construct($id, $module, $config);
    }

    /**
     * @return array
     */
    public function actions()
    {
        return [
            'settings' => [
                'class' => Settings::class,
                'keys' => [
                    self::SESSION => [
                        'label' => Yii::t('backend', 'Send session'),
                        'rules' => [
                            ['required'], ['string', 'length' => [2, 6]]
                        ]
                    ],
                    self::COUNT => [
                        'label' => Yii::t('backend', 'Send today'),
                        'rules' => [
                            ['integer'],
                        ]
                    ],
                    self::LIMIT => [
                        'label' => Yii::t('backend', 'Limit'),
                        'rules' => [
                            ['integer'],
                        ]
                    ],
                    self::DATE_SEND => [
                        'label' => Yii::t('backend', 'Last date send'),
                        'rules' => [
                            ['date', 'format' => 'php:Y-m-d']
                        ]
                    ],
                    self::CAT_ID => [
                        'label' => Yii::t('backend', 'Category'),
                    ],
                    self::TPL_ID => [
                        'label' => Yii::t('backend', 'Template'),
                    ],
                ],
            ],
        ];
    }

    /**
     * @return string
     */
    public function actionIndex()
    {
        $model = new EmailForm();

        $model->cat_id = $this->settings->get(self::CAT_ID);
        $model->tpl_id = $this->settings->get(self::TPL_ID);

        $data = $this->checkState($model->cat_id, $model->tpl_id);
        return $this->render('index', ['model' => $model, 'data' => $data]);
    }

    /**
     * @return mixed
     */
    public function actionSend()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $cat1 = Yii::$app->request->post('cat_id');
        $tpl1 = Yii::$app->request->post('tpl_id');

        $state = $this->checkState($cat1, $tpl1);

        if ($state->isValid()) {
            $state->email = $this->sendServive->getEmail($cat1, $state->session);
        }

        if ($state->isValidEmail()) {
            // тут проверка нужна на статус отправки
            $this->sendServive->sendEmail($state->email, $tpl1);
            $this->settings->set(self::COUNT, $state->count + 1);
        }

        $data = [
            'status' => $state->status,
            'percent' => $state->percent,
            'text' => $state->text,
            'log' => $this->renderAjax('log', ['data' => $state])
        ];

        return $data;
    }

    /**
     * @param $cat1
     * @param $tpl1
     * @return StateDto
     */
    private function checkState($cat1, $tpl1)
    {
        $cat2 = $this->settings->get(self::CAT_ID);
        if ($cat1 != $cat2) {
            $this->settings->set(self::CAT_ID, $cat1);
        }

        $tpl2 = $this->settings->get(self::TPL_ID);
        if ($tpl1 != $tpl2) {
            $this->settings->set(self::TPL_ID, $tpl1);
        }

        $state = StateDto::init(
            $this->settings->get(self::SESSION),
            $this->settings->get(self::LIMIT),
            $this->settings->get(self::COUNT),
            $this->settings->get(self::DATE_SEND)
        );

        $today = DateHelper::nowDate();

        if (!$state->isValidToday($today)) {
            return $state;
        }

        if (!$state->isValidCount()) {
            $this->settings->set(self::DATE_SEND, $today);
            $this->settings->set(self::COUNT, 0);
            return $state;
        }

        return $state;
    }
}
