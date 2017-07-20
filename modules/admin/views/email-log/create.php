<?php
/**
 * @var yii\web\View $this
 * @var \lo\modules\email\models\EmailLog $model
 */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => 'Log',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Logger'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-create">
    <?php echo $this->render('_form', [
        'model' => $model
    ]) ?>
</div>
