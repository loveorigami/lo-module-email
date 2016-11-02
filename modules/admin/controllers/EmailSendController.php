<?php

namespace lo\modules\email\modules\admin\controllers;

use lo\core\helpers\CalculationHelper;
use lo\core\actions\crud\Settings;
use lo\modules\email\adapters\EmailSettingsInterface;
use lo\modules\email\forms\EmailForm;
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

    private $_settings;

    public function __construct($id, $module, EmailSettingsInterface $settings, $config = [])
    {
        $this->_settings = $settings;
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
                            ['required']
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
                            ['integer'], ['required']
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
        //$post = Yii::$app->request->post();

        $status = $this->checkStatus();

        if ($status['status']) {
            // get email from group
            if ($status['id'] == 5) {
                $status['text'] = 'Group is empty';
                $status['status'] = false;
            };
            //todo send email
        }

        if ($status['status']) {
            $this->_settings->set(self::COUNT, $status['id'] + 1);
        }

        $data = [
            'id' => $status['id'],
            'percent' => $status['percent'],
            'status' => $status['status'],
            'text' => $status['text'],
            'log' => $this->renderAjax('log', ['data' => $status])
        ];

        return $data;
    }

    /**
     *
     */
    protected function checkStatus()
    {
        $status = true;
        $text = 'Ok';
        $limit = $this->_settings->get(self::LIMIT);
        $count = $this->_settings->get(self::COUNT);
        $date = $this->_settings->get(self::DATE_SEND);
        $today = date('Y-m-d');

        $data = [
            'id' => $count,
            'status' => $status,
            'percent' => CalculationHelper::percent($count, $limit),
            'text' => $text
        ];

        if ($date >= $today) {
            $data['text'] = "Finish today $date limit";
            $data['status'] = false;
            return $data;
        }

        if ($count >= $limit) {
            $this->_settings->set(self::DATE_SEND, $today);
            $data['text'] = "Finish today limit $limit";
            $data['status'] = false;
        }

        return $data;
    }
}
