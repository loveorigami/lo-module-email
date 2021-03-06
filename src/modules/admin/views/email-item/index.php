<?php

use lo\core\widgets\admin\Grid;
use lo\core\widgets\admin\CrudLinks;
use yii\helpers\Html;

/**
 * @var yii\web\View                       $this
 * @var yii\data\ActiveDataProvider        $dataProvider
 * @var \lo\modules\email\models\EmailItem $searchModel
 */
$this->title = Yii::t('backend', 'Emails');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-index">
    <?php
    echo $this->render('/_menu');
    echo Html::a(Yii::t('email', 'Not sended'), ['index', 'not-sended' => 1], [
        'class' => 'btn btn-primary',
    ]);
    echo CrudLinks::widget(['action' => CrudLinks::CRUD_LIST, 'model' => $searchModel]);
    echo $this->render('_filter', ['model' => $searchModel]);

    echo Grid::widget([
        'dataProvider' => $dataProvider,
        'model' => $searchModel,
    ]);
    ?>
</div>
