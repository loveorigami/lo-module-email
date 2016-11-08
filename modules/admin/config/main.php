<?php

return [
    'bootstrap' => ['lo\modules\email\modules\admin\Bootstrap'],
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