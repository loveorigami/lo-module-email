<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var \lo\modules\email\forms\CheckForm $model
 * @var \lo\modules\email\models\EmailItem $item
 * @var array $data
 */

$this->title = Yii::t('backend', 'Import emails');
$this->params['breadcrumbs'][] = $this->title;
$meta = $item->getMetaFields();

$js = "

$('#start-send').click(StartSend);
   
function StartSend(e) {
    e.preventDefault();
    
    var lines = $('#importform-list').val().split(`\n`);
    console.log(lines);
    var total = lines.length;
    var count = 0;
    
    $.each(lines, function(){
        $.ajax({
            url: $('#email-form').attr('action'),
            type: 'post',
            dataType: 'json',
            cache: false,
            data: {
                email: this,
                cat_id: $('#emailitem-cat_id option:selected').val(),
            },
            success: function (data) {           
                $('#log').html(data);
            }
        });
        
    });

}";

$this->registerJs($js, yii\web\View::POS_END);
?>

<div class="contact-form">
    <?php
    echo $this->render('/_menu');
    ?>
    <div class="col-md-12">
        <?php $form = ActiveForm::begin([
            'id' => 'email-form',
            'action' => ['email-import/send'],
        ]); ?>

        <?= $meta->getField('cat_id')->getWrappedForm($form); ?>
        <?= $meta->getField('status')->getWrappedForm($form); ?>
        <?= $form->field($model, 'list')->textarea(['rows' => 10]); ?>

        <div class="form-group">
            <?= Html::submitButton('Начать импорт', [
                'id' => 'start-send',
                'class' => 'btn btn-primary'
            ]) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
    <div class="col-md-12">
        <div id="log"></div>
    </div>
</div>
