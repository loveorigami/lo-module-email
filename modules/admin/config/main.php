<?php

return [
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
            ]
        ],
    ],
];