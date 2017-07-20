<?php

return [
    'modules' => [
        'email' => [
            'controllerNamespace' => 'lo\modules\email\controllers',
            'class' => lo\modules\email\Module::class,
            'defaultRoute' => 'email/subscribe/index'
        ],
    ],
];