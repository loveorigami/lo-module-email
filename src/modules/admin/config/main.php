<?php

use lo\modules\email\adapters\EmailSettings;
use lo\modules\email\adapters\EmailSettingsInterface;
use lo\modules\email\modules\admin\services\Mailing;
use lo\modules\email\modules\admin\services\MailingInterface;

return [
    'container' => [
        'singletons' => [
            EmailSettingsInterface::class => [
                'class' => EmailSettings::class,
                'cache' => 'cacheCommon',
                'cachingDuration' => 6000,
            ],
            MailingInterface::class =>  Mailing::class
        ],
    ],
    'modules' => [
        'email' => [
            'class' => 'lo\modules\email\modules\admin\Module',
			'controllerNamespace' => 'lo\modules\email\modules\admin\controllers',
            'defaultRoute' => 'email-item',
        ],
    ],
];