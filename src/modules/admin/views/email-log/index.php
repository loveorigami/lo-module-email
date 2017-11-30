<?php
use lo\core\widgets\admin\Grid;
use lo\core\widgets\admin\CrudLinks;
use lo\widgets\modal\ModalAjax;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var \lo\modules\email\models\EmailLog $searchModel
 */
$this->title = Yii::t('backend', 'Logger');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-index">
    <?php
    echo $this->render('/_menu');

    echo ModalAjax::widget([
        'header' => 'Email настройки',
        'toggleButton' => [
            'label' => 'Настройки',
            'class' => 'btn btn-primary pull-right'
        ],
        'url' => ['email-log/settings'],
        'options' => ['class' => 'header-primary'],
        'autoClose' => true,
    ]);

    echo CrudLinks::widget(["action" => CrudLinks::CRUD_LIST, "model" => $searchModel]);
    echo $this->render('_filter', ['model' => $searchModel]);

    echo Grid::widget([
        'dataProvider' => $dataProvider,
        'model' => $searchModel,
    ]);
    ?>
</div>
