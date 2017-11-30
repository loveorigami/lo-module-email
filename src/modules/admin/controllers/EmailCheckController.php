<?php

namespace lo\modules\email\modules\admin\controllers;

use lo\core\actions\crud\Settings;
use lo\core\helpers\DateHelper;
use lo\modules\email\adapters\EmailSettingsInterface;
use lo\modules\email\forms\CheckForm;
use lo\modules\email\models\EmailItem;
use lo\modules\email\modules\admin\dto\CheckDto;
use lo\modules\email\modules\admin\services\CheckService;
use Yii;
use yii\web\Controller;
use yii\web\Response;

/**
 * Class EmailSendController
 * @package lo\modules\email\modules\admin\controllers
 * @author Lukyanov Andrey <loveorigami@mail.ru>
 */
class EmailCheckController extends Controller
{
    const DATE_CHECK = 'email.date_check';
    const SESSION = 'email.send_session';

    /** @var EmailSettingsInterface */
    private $settings;

    /** @var CheckService */
    private $checkService;

    /**
     * EmailSendController constructor.
     * @param string $id
     * @param \yii\base\Module $module
     * @param EmailSettingsInterface $settings
     * @param CheckService $service
     * @param array $config
     */
    public function __construct($id, $module, EmailSettingsInterface $settings, CheckService $service, $config = [])
    {
        $this->settings = $settings;
        $this->checkService = $service;
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
                    self::DATE_CHECK => [
                        'label' => Yii::t('backend', 'Last date check'),
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
        $model = new CheckForm();
        $model->date = $this->settings->get(self::DATE_CHECK);

        return $this->render('index', [
            'model' => $model,
            'data' => []
        ]);
    }

    /**
     * @return string
     */
    public function actionEmail()
    {
        $model = new CheckForm();
        $model->date = $this->settings->get(self::SESSION);

        return $this->render('email', [
            'model' => $model,
            'data' => []
        ]);
    }


    /**
     * @return mixed
     */
    public function actionValidate()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $sess = Yii::$app->request->post('session');

        $query = EmailItem::find()
            ->alias('i')
            ->andWhere(['AND',
                ['!=', 'i.session_id', $sess],
                ['!=', 'i.session_id', $sess . $sess]
            ])
            ->limit(100)
            ->published()
            ->all();

        $i = 0;

        foreach ($query as $model) {
            /** @var EmailItem $model */
            if (!$this->checkEmail($model->email)) {
                $model->status = EmailItem::STATUS_DRAFT;
                $model->date_unsubscribe = DateHelper::nowDate();
                $model->save(false);
                $i++;
            } else {
                $model->session_id = $sess . $sess;
                $model->save(false);
            }
        }

        $data = [
            'status' => count($query) > 0,
            'text' => 'ok',
            'log' => 'hide - ' . $i
        ];

        return $data;
    }

    /**
     * @return mixed
     */
    public function actionSend()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $date = Yii::$app->request->post('date');
        $state = $this->checkState($date);

        if ($state->isValid()) {
            $this->checkService->messageEventsList($date);
        }

        $data = [
            'date' => DateHelper::rangeDateByDays(1, $date),
            'status' => $state->status,
            'text' => $state->text,
            'log' => $this->renderAjax('_log', ['data' => $state])
        ];

        return $data;
    }

    /**
     * @param $date
     * @return CheckDto
     */
    private function checkState($date)
    {
        $state = CheckDto::init($date);
        $today = DateHelper::nowDate();

        if (!$state->isValidToday($today)) {
            $this->settings->set(self::DATE_CHECK, $today);
            return $state;
        }

        return $state;
    }

    /**
     * @param $email
     * @return bool
     */
    private function checkEmail($email)
    {
        //Perform a basic syntax-Check
        //If this check fails, there's no need to continue
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        //extract host
        list($user, $host) = explode("@", $email);
        //check, if host is accessible
        if (!checkdnsrr($host, "MX") && !checkdnsrr($host, "A")) {
            return false;
        }

        return true;
    }

}
