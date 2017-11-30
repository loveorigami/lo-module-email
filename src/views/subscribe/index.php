<?php
/**
 * @var $this \yii\web\View
 * @var \lo\modules\email\forms\SubscribeForm $model
 */
use lo\modules\email\widgets\SubscribeWidget;
use yii\helpers\Html;

$this->title = 'Подписка на новостную рассылку';
echo Html::tag('h1', $this->title);
?>
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <?= SubscribeWidget::widget(['model' => $model]); ?>
    </div>
</div>