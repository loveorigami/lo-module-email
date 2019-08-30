<?php

namespace lo\modules\email\modules\admin\controllers;

use lo\modules\email\forms\ImportForm;
use lo\modules\email\models\EmailItem;
use lo\modules\email\modules\admin\dto\ImportDto;
use lo\modules\email\modules\admin\services\ImportService;
use Yii;
use yii\base\Module;
use yii\web\Controller;
use yii\web\Response;

/**
 * Class EmailSendController
 *
 * @package lo\modules\email\modules\admin\controllers
 * @author  Lukyanov Andrey <loveorigami@mail.ru>
 */
class EmailImportController extends Controller
{
    /**
     * @var ImportService
     */
    private $importService;

    /**
     * EmailSendController constructor.
     *
     * @param string        $id
     * @param Module        $module
     * @param ImportService $service
     * @param array         $config
     */
    public function __construct($id, $module, ImportService $service, $config = [])
    {
        $this->importService = $service;
        parent::__construct($id, $module, $config);
    }

    /**
     * @return string
     */
    public function actionIndex(): string
    {
        $model = new ImportForm();
        $item = new EmailItem();

        return $this->render('index', [
            'model' => $model,
            'item' => $item,
        ]);
    }

    /**
     * @return mixed
     */
    public function actionSend()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $email = (string)Yii::$app->request->post('email');
        $cat_id = (int)Yii::$app->request->post('cat_id');
        $status = (string)Yii::$app->request->post('status'); // fix for checkboxes
        $is_move = (string)Yii::$app->request->post('is_move');

        $dto = ImportDto::init($email, $cat_id, $status, $is_move);

        $data = $this->importService->createOrUpdate($dto);

        return $this->renderAjax('log', ['data' => $data]);
    }

}
