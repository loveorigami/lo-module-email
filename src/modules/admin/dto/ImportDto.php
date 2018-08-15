<?php

namespace lo\modules\email\modules\admin\dto;

use lo\modules\email\models\EmailItem;

class ImportDto
{
    public $email;
    public $cat_id;
    public $status;

    /**
     * @param $email
     * @param $cat_id
     * @param $status
     * @return ImportDto
     */
    public static function init($email, $cat_id, $status): self
    {
        $state = new self;
        $state->email = mb_strtolower($email);
        $state->cat_id = (int)$cat_id;
        $state->status = (bool)$status ? EmailItem::STATUS_PUBLISHED : EmailItem::STATUS_DRAFT;

        return $state;
    }
} 
