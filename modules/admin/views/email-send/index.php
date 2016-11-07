<?php
use lo\core\widgets\admin\TabMenu;
use lo\modules\email\models\EmailCat;
use lo\modules\email\models\EmailTpl;
use lo\widgets\modal\AjaxModal;
use yii\bootstrap\Progress;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var \lo\modules\email\forms\EmailForm $model
 * @var array $data
 */
$this->title = Yii::t('backend', 'Send emails');
$this->params['breadcrumbs'][] = $this->title;

$js = "

$('#start-send').click(StartSend);
   
function StartSend(e) {
    e.preventDefault();
   
    $.ajax({
        url: $('#email-form').attr('action'),
        type: 'post',
        dataType: 'json',
        cache: false,
        data: {
            cat_id: $('#emailform-cat_id option:selected').val(),
            tpl: $('#emailform-tpl_id option:selected').val()
        },
        success: function (data) {
            var value = data['percent'] + '%';
            $('.progress-bar').width(value).html(value);
            
            $('#log').html(data['log']);
            if (data['status']) {
                StartSend(e);
            } else {
                alert(data['text']);
            }
        }
    });

}";

$this->registerJs($js, yii\web\View::POS_END);
?>

<div class="contact-form">
    <?php
    echo AjaxModal::widget([
        'header' => 'Email настройки',
        'toggleButton' => [
            'label' => 'Email настройки',
            'class' => 'btn btn-primary pull-right'
        ],
        'url' => ['email-send/settings'],
        'options' => ['class' => 'header-primary'],
        'autoClose' => true,
    ]);
    echo TabMenu::widget();

    $categories = EmailCat::find()->select(['name', 'id'])->indexBy('id')->orderBy('name')->column();
    $templates = ArrayHelper::map(EmailTpl::find()->published()->asArray()->orderBy("name")->all(), 'name', 'name');

    ?>

    <?php
    echo Progress::widget([
        'percent' => $data['percent'],
        'label' => $data['percent'] . '%',
        'barOptions' => ['class' => 'progress-bar-success'],
        'options' => ['class' => 'active  progress-striped']
    ]);
    ?>

    <div class="col-md-6">
        <?php $form = ActiveForm::begin([
            'id' => 'email-form',
            'action' => ['email-send/send'],
        ]); ?>

        <?= $form->field($model, 'cat_id')->dropDownList($categories) ?>
        <?= $form->field($model, 'tpl_id')->dropDownList($templates) ?>

        <div class="form-group">
            <?= Html::submitButton('Начать рассылку', [
                'id' => 'start-send',
                'class' => 'btn btn-primary'
            ]) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
    <div class="col-md-6">
        <div id="log">
            <?= $this->render('log', ['data' => $data]) ?>
        </div>
    </div>
</div>