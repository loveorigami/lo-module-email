<?php

use lo\modules\email\repositories\EmailItemRepository;
use lo\modules\email\repositories\EmailItemRepositoryInterface;

return [
    'container' => [
        'definitions' => [

        ],
        'singletons' => [
            EmailItemRepositoryInterface::class => EmailItemRepository::class,
        ],
    ],
    'modules' => [
        'email' => [
            'controllerNamespace' => 'lo\modules\email\controllers',
            'class' => lo\modules\email\Module::class,
            'defaultRoute' => 'email/subscribe/index'
        ],
    ],
    'components' => [
        'urlManager' => [
            'rules' => [
                ['pattern' => 'subscribe', 'route' => 'email/subscribe/index'],
            ]
        ]
    ],
];