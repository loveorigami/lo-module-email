<?php

namespace lo\modules\email\forms;

use lo\modules\email\models\EmailItem;
use lo\modules\email\forms\meta\SubscribeFormMeta;

class SubscribeForm extends EmailItem
{
    /**
     * @inheritdoc
     */
    public function metaClass()
    {
        return SubscribeFormMeta::class;
    }
}