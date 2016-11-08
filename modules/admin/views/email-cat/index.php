<?php
use lo\core\widgets\admin\Grid;
use lo\core\widgets\admin\CrudLinks;
use lo\core\widgets\admin\TabMenu;
use lo\widgets\modal\ModalAjax;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 */
$this->title = Yii::t('backend', 'Emails Cat');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-index">
    <?php
    echo TabMenu::widget();
    echo CrudLinks::widget(["action" => CrudLinks::CRUD_LIST, "model" => $searchModel]);

    echo ModalAjax::widget([
        'options' => ['class' => 'header-primary'],
        'autoClose' => true,
        'selector' => 'a.btn',
        'pjaxContainer' => '#grid-lo-modules-email-models-emailcat-pjax'
    ]);

    echo $this->render('_filter', ['model' => $searchModel]);

    echo Grid::widget([
        'dataProvider' => $dataProvider,
        'model' => $searchModel,
    ]);
    ?>

</div>
