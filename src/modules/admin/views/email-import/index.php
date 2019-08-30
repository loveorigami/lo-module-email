<?php

use lo\modules\email\forms\ImportForm;
use lo\modules\email\models\EmailItem;
use lo\widgets\Toggle;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var ImportForm   $model
 * @var EmailItem    $item
 * @var array        $data
 */

$this->title = Yii::t('backend', 'Import emails');
$this->params['breadcrumbs'][] = $this->title;
$meta = $item->getMetaFields();

$js = "

$('#start-send').click(StartSend);
    
function StartSend(e) 
{
    e.preventDefault();
    var lines = $('#importform-list').val().split(`\n`);   
    var total = lines.length;
    var count = 0;
    
    sendAjax(lines, total, count);
   
}

function sendAjax(lines, total, count)
{
    if(count < total) {
       $.ajax({
            url: $('#email-form').attr('action'),
            type: 'post',
            dataType: 'json',
            cache: false,
            showNoty: false,
            data: {
                email: lines[count],
                cat_id: $('#emailitem-cat_id option:selected').val(),
                status: $('#emailitem-status').prop('checked'),
                is_move: $('#importform-is_move').prop('checked')
            },
            success: function (data) {           
                $('#log').html(count + ' - ' + data);
                count++;
                sendAjax(lines, total, count);
            }
        });
    }
}

";

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

        <?= $meta->getField('cat_id')->getWrappedForm($form) ?>
        <div class="row">
            <div class="col-md-2">
                <?= $form->field($model, 'is_move', [
                    'template' => '{label} <div class="clearfix"></div>{input}{error}{hint}',
                ])->widget(Toggle::class, [
                    'options' => [
                        'label' => null,
                        'inline' => true,
                        'data-on' => Yii::t('common', 'Yes'),
                        'data-off' => Yii::t('common', 'No'),
                    ],
                ]) ?>
            </div>
            <div class="col-md-2">
                <?= $meta->getField('status')->getWrappedForm($form) ?>
            </div>
        </div>


        <?= $form->field($model, 'list')->textarea(['rows' => 10]) ?>

        <div class="form-group">
            <?= Html::submitButton('Начать импорт', [
                'id' => 'start-send',
                'class' => 'btn btn-primary',
            ]) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
    <div class="col-md-12">
        <div id="log"></div>
    </div>
</div>
