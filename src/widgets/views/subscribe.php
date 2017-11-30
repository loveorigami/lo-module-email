<?php
/**
 * @var \lo\modules\email\forms\SubscribeForm $model
 */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$meta = $model->getMetaFields();
?>
<div class="ir-form">
    <div class="inner">
        <p>Хотите получить лучшие предложения<br/>в ваш почтовый ящик?</p>
        <?php $form = ActiveForm::begin([
            'method' => 'post',
            'action' => Url::to(['/email/subscribe/index'])
        ]); ?>
        <?= $meta->getField('email')->getWrappedForm($form) ?>
        <?= Html::submitButton('Подписаться', ['class' => 'button blue-button']) ?>
        <?php ActiveForm::end(); ?>
    </div>
</div>