<?php
use lo\core\widgets\admin\Detail;
use lo\core\widgets\admin\CrudLinks;

/**
 * @var yii\web\View $this
 * @var \lo\modules\email\models\EmailCat $model
 */

$this->title = Yii::t('backend', 'View');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Email Cat'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-view">

    <?= CrudLinks::widget(["action" => CrudLinks::CRUD_VIEW, "model" => $model]) ?>

    <?= Detail::widget([
        'model' => $model,
    ]) ?>

</div>