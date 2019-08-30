<?php

namespace lo\modules\email\modules\admin\controllers;

use lo\core\actions\crud;
use lo\core\helpers\DateHelper;
use lo\modules\email\adapters\EmailSettingsInterface;
use lo\modules\email\forms\LogForm;
use lo\modules\email\models\EmailLog;
use lo\modules\email\modules\admin\dto\CheckDto;
use lo\modules\email\modules\admin\services\LogService;
use Yii;
use yii\web\Controller;
use yii\web\Response;

/**
 * Class EmailSendController
 * @package lo\modules\email\modules\admin\controllers
 * @author Lukyanov Andrey <loveorigami@mail.ru>
 */
class EmailLogController extends Controller
{
    const DATE_LOG = 'email.date_log';

    /** @var EmailSettingsInterface */
    private $settings;

    /** @var LogService */
    private $logService;

    /**
     * EmailSendController constructor.
     * @param string $id
     * @param \yii\base\Module $module
     * @param EmailSettingsInterface $settings
     * @param LogService $service
     * @param array $config
     */
    public function __construct($id, $module, EmailSettingsInterface $settings, LogService $service, $config = [])
    {
        $this->settings = $settings;
        $this->logService = $service;
        parent::__construct($id, $module, $config);
    }

    /**
     * @return array
     */
    public function actions()
    {
        $class = EmailLog::class;
        return [
            'index' => [
                'class' => crud\Index::class,
                'modelClass' => $class,
                'orderBy' => ['date' => SORT_DESC]
            ],
            'create' => [
                'class' => crud\Create::class,
                'modelClass' => $class,
            ],
            'update' => [
                'class' => crud\Update::class,
                'modelClass' => $class,
            ],
            'delete' => [
                'class' => crud\Delete::class,
                'modelClass' => $class,
            ],
            'groupdelete' => [
                'class' => crud\GroupDelete::class,
                'modelClass' => $class,
            ],
            'settings' => [
                'class' => crud\Settings::class,
                'keys' => [
                    self::DATE_LOG => [
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
    public function actionLogger()
    {
        $model = new LogForm();
        $model->date = $this->settings->get(self::DATE_LOG);

        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('logger', [
                'model' => $model,
                'data' => []
            ]);
        } else {
            return $this->render('logger', [
                'model' => $model,
                'data' => []
            ]);
        }
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
            sleep(5);
            $this->logService->getMetricsList($date);
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
            $this->settings->set(self::DATE_LOG, $today);
            return $state;
        }

        return $state;
    }

}
