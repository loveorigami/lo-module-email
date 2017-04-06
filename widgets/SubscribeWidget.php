<?php

namespace lo\modules\email\widgets;

use lo\modules\email\forms\SubscribeForm;
use yii\base\Widget;

/**
 * Class SubscribeWidget
 * @package lo\modules\email\widgets
 * @author Lukyanov Andrey <loveorigami@mail.ru>
 */
class SubscribeWidget extends Widget
{
    public $model;

    public function run()
    {
        SubscribeAsset::register($this->getView());
        if (!$this->model) {
            $this->model = new SubscribeForm();
        }
        return $this->render('subscribe', ['model' => $this->model]);
    }
}