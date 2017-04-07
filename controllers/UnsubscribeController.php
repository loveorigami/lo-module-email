<?php

namespace lo\modules\email\controllers;

use lo\core\exceptions\FlashException;
use lo\modules\email\forms\UnsubscribeForm;
use lo\modules\email\services\EmailService;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;

/**
 * Class UnsubscribeController
 * @package lo\modules\email\controllers
 * @author Lukyanov Andrey <loveorigami@mail.ru>
 */
class UnsubscribeController extends Controller
{
    protected $emailService;

    public function __construct($id, $module, emailService $emailService, $config = [])
    {
        $this->emailService = $emailService;
        parent::__construct($id, $module, $config);
    }

    public function actionIndex()
    {
        $form = Yii::createObject([
            'class' => UnsubscribeForm::class,
        ]);

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $data = $form->toArray();
                $this->emailService->unsubscribeByEmail($data['email']);

                Yii::$app->session->setFlash('success', 'Вы успешно отписались от рассылки');
                return $this->refresh();
            } catch (FlashException $exception) {
                $exception->catchFlash();
            }
        }

        return $this->render('index', ['model' => $form]);
    }

    /**
     * @param $hash
     * @return \yii\web\Response
     */
    public function actionHash($hash)
    {
        try {
            $this->emailService->unsubscribeByHash($hash);
            Yii::$app->session->setFlash('success', 'Вы успешно отписались от рассылки');
        } catch (FlashException $exception) {
            $exception->catchFlash();
        }

        return $this->redirect(Url::home());
    }
} 