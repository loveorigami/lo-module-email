<?php

namespace lo\modules\email\controllers;

use lo\modules\email\forms\SubscribeForm;
use lo\modules\email\services\EmailService;
use Yii;
use yii\web\Controller;

/**
 * Class SubscribeController
 * @package modules\base\controllers
 * @author Lukyanov Andrey <loveorigami@mail.ru>
 */
class SubscribeController extends Controller
{
    protected $emailService;

    public function __construct($id, $module, EmailService $emailService, $config = [])
    {
        $this->emailService = $emailService;
        parent::__construct($id, $module, $config);
    }

    public function actionIndex()
    {
        $form = Yii::createObject([
            'class' => SubscribeForm::class,
            'scenario' => SubscribeForm::SCENARIO_INSERT
        ]);

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            $data = $form->toArray();
            $this->emailService->createEmail($data);

            Yii::$app->session->setFlash('success', 'Вы успешно подписаны на рассылку');
            return $this->refresh();
        }

        return $this->render('index', ['model' => $form]);
    }
} 