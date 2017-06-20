<?php

use lo\modules\email\adapters\EmailSettings;
use lo\modules\email\adapters\EmailSettingsInterface;
use lo\modules\email\modules\admin\services\Mailing;
use lo\modules\email\modules\admin\services\MailingInterface;
use lo\modules\email\repositories\EmailItemRepository;
use lo\modules\email\repositories\EmailItemRepositoryInterface;

return [
    'container' => [
        'definitions' => [

        ],
        'singletons' => [
            EmailSettingsInterface::class => [
                'class' => EmailSettings::class,
                'cachingDuration' => 6000,
            ],
            EmailItemRepositoryInterface::class => EmailItemRepository::class,
            MailingInterface::class => [
                'class' => Mailing::class,
                'fromEmail' => 'noreply@gintur.com',
            ]
        ],
    ],
    'components'=>[
        'sparkpost' => [
            'class' => \lo\modules\email\components\sparkpost\Mailer::class,
            'apiKey' => getenv('SPARKPOST_API_KEY'),
            'sandbox' => false,
            'httpAdapter' => 'Ivory\HttpAdapter\Guzzle6HttpAdapter',
        ],
    ],
    'modules' => [
        'email' => [
            'class' => 'lo\modules\email\modules\admin\Module',
			'controllerNamespace' => 'lo\modules\email\modules\admin\controllers',
            'defaultRoute' => 'email-item',
            'menuItems' => [
                [
                    'label' => \Yii::t('backend', 'Emails'),
                    'url' => ['/email/email-item/index'],
                ],
                [
                    'label' => \Yii::t('backend', 'Categories'),
                    'url' => ['/email/email-cat/index'],
                ],
                [
                    'label' => \Yii::t('backend', 'Templates'),
                    'url' => ['/email/email-tpl/index'],
                ],
                [
                    'label' => \Yii::t('backend', 'Send emails'),
                    'url' => ['/email/email-send/index'],
                ],
            ]
        ],
    ],
];