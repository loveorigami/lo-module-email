<?php

namespace lo\modules\email\modules\admin\controllers;

use lo\modules\email\forms\ImportForm;
use lo\modules\email\models\EmailItem;
use lo\modules\email\modules\admin\services\ImportService;
use Yii;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\Response;

/**
 * Class EmailSendController
 * @package lo\modules\email\modules\admin\controllers
 * @author Lukyanov Andrey <loveorigami@mail.ru>
 */
class EmailImportController extends Controller
{
    /**
     * @var ImportService
     */
    private $importService;

    /**
     * EmailSendController constructor.
     * @param string $id
     * @param \yii\base\Module $module
     * @param ImportService $service
     * @param array $config
     */
    public function __construct($id, $module, ImportService $service, $config = [])
    {
        $this->importService = $service;
        parent::__construct($id, $module, $config);
    }

    /**
     * @return string
     */
    public function actionIndex()
    {
        $model = new ImportForm();
        $item = new EmailItem();

        return $this->render('index', [
            'model' => $model,
            'item' => $item
        ]);
    }

    /**
     * @return mixed
     */
    public function actionSend()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $email = Yii::$app->request->post('email');
        $cat_id = Yii::$app->request->post('cat_id');

        $model = new EmailItem();
        $model->email = $email;
        $model->cat_id = $cat_id;

        if ($model->validate()) {
            $data = [
                'email' => $email,
                'cat_id' => $cat_id,
                'status' => 1
            ];
            $this->importService->createEmail($data);
        } else {
            $data = [
                'email' => $email,
                'cat_id' => $cat_id,
                'status' => Html::errorSummary($model)
            ];
        }

        return $this->renderAjax('log', ['data' => $data]);
    }

}
