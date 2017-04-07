<?php
/**
 * @var $this \yii\web\View
 * @var \lo\modules\email\forms\UnsubscribeForm $model
 */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$meta = $model->getMetaFields();
$this->title = 'Отписаться от новостной рассылки';
echo Html::tag('h1', $this->title);
?>
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <p>Желаете отписаться от новостной рассылки?</p>
        <?php $form = ActiveForm::begin([
            'method' => 'post',
            'action' => Url::to(['/email/unsubscribe/index'])
        ]); ?>
        <?= $meta->getField('email')->getWrappedForm($form) ?>
        <?= Html::submitButton('Отписаться', ['class' => 'button blue-button']) ?>
        <?php ActiveForm::end(); ?>
    </div>
</div>