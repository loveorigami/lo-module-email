<?php

/**
 * @var yii\web\View $this
 * @var \lo\modules\email\models\EmailLog $model
 */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
        'modelClass' => 'Log',
    ]) . ' ' . $model->date;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Logger'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->date, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="page-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
