<?php

use lo\core\helpers\DateHelper;
use lo\core\widgets\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var \lo\modules\email\forms\CheckForm $model
 * @var \lo\modules\email\modules\admin\dto\StateDto $data
 */

$this->title = Yii::t('backend', 'Logger');
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
            date: $('#logform-date').val(),
        },
        success: function (data) {           
            $('#log').html(data['log']);
            if (data['status']) {
                $('#logform-date').val(data['date']),
                StartSend(e);
            } else {
                alert(data['text']);
            }
        }
    });

}";
echo $this->render('/_menu');
$this->registerJs($js, yii\web\View::POS_END);
?>

<div class="contact-form">

    <div class="col-md-6">
        <?php $form = ActiveForm::begin([
            'id' => 'email-form',
            'action' => ['email-log/send'],
        ]); ?>

        <?= $form->field($model, 'date')->textInput()->widget(DatePicker::class, [
            'pluginOptions' => [
                'autoclose' => true,
                'format' => DateHelper::DP_DATE_FORMAT
            ]
        ]) ?>

        <div class="form-group">
            <?= Html::submitButton('Загрузить данные', [
                'id' => 'start-send',
                'class' => 'btn btn-primary'
            ]) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
    <div class="col-md-12">
        <div id="log">
            <?= $this->render('_log', ['data' => $data]) ?>
        </div>
    </div>
</div>