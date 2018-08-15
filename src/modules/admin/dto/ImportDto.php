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
    public static function init(string $email, int $cat_id, string $status): self
    {
        $state = new self;
        $state->email = mb_strtolower($email);
        $state->cat_id = $cat_id;
        $state->status = ($status === 'true') ? EmailItem::STATUS_PUBLISHED : EmailItem::STATUS_DRAFT;

        return $state;
    }
} 
