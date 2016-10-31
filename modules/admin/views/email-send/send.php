<?php

use yii\bootstrap\Progress;

/**
 * @var int $persent
 */

echo Progress::widget([
    'bars' => [
        ['percent' => $persent, 'options' => ['class' => 'progress-bar-danger']],
    ]
]);