<?php

use yii\bootstrap\Nav;

echo Nav::widget([
    'options' => [
        'class' => 'nav-tabs',
        'style' => 'margin-bottom: 15px'
    ],
    'items' => [
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
        [
            'label' => \Yii::t('backend', 'Import emails'),
            'url' => ['/email/email-import/index'],
        ],
        [
            'label' => \Yii::t('backend', 'Log'),
            'url' => ['/email/email-log/index'],
            'items' => [
                [
                    'label' => \Yii::t('backend', 'List'),
                    'url' => ['/email/email-log/index'],
                ],
                [
                    'label' => \Yii::t('backend', 'Load'),
                    'url' => ['/email/email-log/logger'],
                ],
                [
                    'label' => \Yii::t('backend', 'Check emails'),
                    'url' => ['/email/email-check/index'],
                ],
            ]
        ],
    ]
]);
