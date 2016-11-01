<?php
use lo\core\widgets\admin\TabMenu;
use lo\modules\email\models\EmailCat;
use lo\modules\email\models\EmailTpl;
use lo\widgets\modal\Modal;
use yii\bootstrap\Progress;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var \lo\modules\email\forms\SparkpostForm $model
 * @var int $persent
 */
$this->title = Yii::t('backend', 'Send emails');
$this->params['breadcrumbs'][] = $this->title;

$js = "

//$('#start-send').click();
var count = 0;

setInterval(StartSend, 100);

function StartSend() {
    //e.preventDefault();
    count++;
    
	var from = $('#sparkpostform-start_send').val();
    var to = $('#sparkpostform-end_send').val();
    
    var total = to - from;
    var value = (count * 100 / total).toFixed(2) + '%';
    
    if (count <= total) {
        $('.progress-bar').width(value).html(value);
        //StartSend(e);
        //console.log(value);
    } 

}


function StartSend2(e) {
    e.preventDefault();
    var from = $('input[name=from]').val();
	var to = $('input[name=to]').val();
	var total = to - from;
    
        $.ajax({
				url: $('#email-form').attr('action'),
				type: 'post',
				dataType: 'json',
				cache: false,
				data: {
					id: count,
					id_cat: $('#select_egroup option:selected').val(),
					tpl: $('#select_etpl option:selected').val()
				},
				success: function (msg) {
					//count++;
					//status = msg['status'];
					
					var value = count * 100 / total;
					$('.progress-bar').attr('aria-valuenow', value);
					
					if (count <= total && status) {
						$('#log').html(count + ' - ' + msg['text']);
						StartParser(e);
					} else{
						alert(msg['text']);
					}
					
				}
			});
    
}";

$this->registerJs($js, yii\web\View::POS_END);
?>

<div class="contact-form">
    <?php
    echo Modal::widget([
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
    $templates = EmailTpl::find()->select(['name', 'id'])->indexBy('id')->orderBy('name')->column();
    ?>
    <div id="log">
        <?php
        echo Progress::widget([
            'percent' => $persent,
            'label' => $persent . '%',
            'barOptions' => ['class' => 'progress-bar-success'],
            'options' => ['class' => 'active  progress-striped']
        ]);
        ?>
    </div>
    <div class="col-md-6">
        <?php $form = ActiveForm::begin([
            'id' => 'email-form',
        ]); ?>

        <?= $form->field($model, 'cat_id')->dropDownList($categories) ?>
        <?= $form->field($model, 'tpl_id')->dropDownList($templates) ?>
        <?= $form->field($model, 'start_send')->textInput() ?>
        <?= $form->field($model, 'end_send')->textInput() ?>

        <div class="form-group">
            <?= Html::submitButton('Начать рассылку', [
                'id' => 'start-send',
                'class' => 'btn btn-primary'
            ]) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>