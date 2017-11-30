<?php
/**
 * @var yii\web\View $this
 * @var \lo\modules\email\models\EmailTpl $model
 */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => 'Email Tpl',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Emails Tpl'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-create">
    <?php echo $this->render('_form', [
        'model' => $model
    ]) ?>
</div>
