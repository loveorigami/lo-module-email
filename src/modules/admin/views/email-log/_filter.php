<?php
use lo\core\widgets\admin\ExtFilter;

/**
 * @var yii\web\View $this
 * @var \lo\modules\email\models\EmailLog $model
 */

echo ExtFilter::widget(["model" => $model]);