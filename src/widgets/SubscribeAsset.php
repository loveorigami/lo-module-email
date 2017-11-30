<?php

namespace lo\modules\email\widgets;

use lo\modules\email\forms\SubscribeForm;
use yii\base\Widget;

use yii\web\AssetBundle;

class SubscribeAsset extends AssetBundle
{
    public $css = [
        'subscribe.css',
    ];

    public $depends = [
        'yii\web\JqueryAsset'
    ];

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->sourcePath = __DIR__ . "/assets";
        parent::init();
    }
}