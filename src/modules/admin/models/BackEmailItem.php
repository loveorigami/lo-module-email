<?php

namespace lo\modules\email\modules\admin\models;

use lo\modules\email\models\EmailItem;
use lo\modules\email\modules\admin\models\meta\BackEmailItemMeta;

class BackEmailItem extends EmailItem
{
    /**
     * @inheritdoc
     */
    public function metaClass()
    {
        return BackEmailItemMeta::class;
    }
}
