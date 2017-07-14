<?php

namespace lo\modules\email\modules\admin\controllers;

use lo\modules\email\forms\CheckForm;
use lo\modules\email\modules\admin\services\CheckService;
use yii\web\Controller;

/**
 * Class EmailSendController
 * @package lo\modules\email\modules\admin\controllers
 * @author Lukyanov Andrey <loveorigami@mail.ru>
 */
class EmailCheckController extends Controller
{
    /** @var CheckService */
    private $checkService;

    /**
     * EmailSendController constructor.
     * @param string $id
     * @param \yii\base\Module $module
     * @param CheckService $service
     * @param array $config
     */
    public function __construct($id, $module, CheckService $service, $config = [])
    {
        $this->checkService = $service;
        parent::__construct($id, $module, $config);
    }

    /**
     * @return string
     */
    public function actionIndex()
    {
        $model = new CheckForm();

        return $this->render('index', [
            'model' => $model,
            'data' => $this->checkService->getBounces()
        ]);
    }
}
