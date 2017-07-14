<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var \lo\modules\email\forms\CheckForm $model
 * @var \lo\modules\email\modules\admin\dto\StateDto $data
 */

$this->title = Yii::t('backend', 'Check emails');
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="contact-form">
    <?php echo $this->render('/_menu'); ?>
    <div class="col-md-12">
        <?php $form = ActiveForm::begin([
            'id' => 'email-form',
            'action' => ['email-send/send'],
        ]); ?>

        <?= $form->field($model, 'date')->textInput() ?>

        <div class="form-group">
            <?= Html::submitButton('Начать проверку', [
                'id' => 'start-send',
                'class' => 'btn btn-primary'
            ]) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
    <div class="col-md-12">
        <div id="log">
            <?= $this->render('log', ['data' => $data]) ?>
        </div>
    </div>
</div>