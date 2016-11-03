<?php

namespace lo\modules\email\modules\admin\controllers;

use lo\core\helpers\CalculationHelper;
use lo\core\actions\crud\Settings;
use lo\modules\email\adapters\EmailSettingsInterface;
use lo\modules\email\forms\EmailForm;
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
        $data = $this->checkStatus();
        return $this->render('index', ['model' => $model, 'data' => $data]);
    }

    /**
     * @return mixed
     */
    public function actionSend()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $cat_id = Yii::$app->request->post('cat_id');
        $tpl = Yii::$app->request->post('tpl');

        $status = $this->checkStatus();

        if ($status['status']) {
            $status['email'] = $this->sendServive->sendEmail($cat_id, $tpl, $status['session']);

            if (!$status['email']) {
                $status['text'] = 'Group is empty';
                $status['status'] = false;
            }
        }

        if ($status['status']) {
            $this->settings->set(self::COUNT, $status['count'] + 1);
        }

        $data = [
            'status' => $status['status'],
            'percent' => $status['percent'],
            'text' => $status['text'],
            'log' => $this->renderAjax('log', ['data' => $status])
        ];

        return $data;
    }

    /**
     * @return array
     */
    private function checkStatus()
    {
        $status = true;
        $text = 'Ok';
        $session = $this->settings->get(self::SESSION);
        $limit = $this->settings->get(self::LIMIT);
        $count = $this->settings->get(self::COUNT);
        $date = $this->settings->get(self::DATE_SEND);
        $today = date('Y-m-d');

        $data = [
            'count' => $count,
            'limit' => $limit,
            'session' => $session,
            'date' => $date,
            'email' => '',
            'status' => $status,
            'label' => 'success',
            'percent' => CalculationHelper::percent($count, $limit),
            'text' => $text
        ];

        if ($date >= $today) {
            $data['text'] = "Finish today limit";
            $data['label'] = 'danger';
            $data['status'] = false;
            return $data;
        }

        if ($count >= $limit) {
            $this->settings->set(self::DATE_SEND, $today);
            $this->settings->set(self::COUNT, 0);
            $data['text'] = "Finish today limit $limit";
            $data['label'] = 'danger';
            $data['status'] = false;
        }

        return $data;
    }
}
