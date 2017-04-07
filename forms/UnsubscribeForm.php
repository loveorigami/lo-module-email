<?php

namespace lo\modules\email\forms;

use lo\modules\email\models\EmailItem;
use lo\modules\email\forms\meta\UnsubscribeFormMeta;

class UnsubscribeForm extends EmailItem
{
    /**
     * @inheritdoc
     */
    public function metaClass()
    {
        return UnsubscribeFormMeta::class;
    }
}