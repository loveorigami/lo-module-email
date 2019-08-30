<?php

namespace lo\modules\email\modules\admin\dto;

use lo\modules\email\models\EmailItem;

class ImportDto
{
    public $email;
    public $cat_id;
    public $status;
    public $is_move;

    /**
     * @param string $email
     * @param int    $cat_id
     * @param string $status
     * @param string $is_move
     * @return ImportDto
     */
    public static function init(
        string $email,
        int $cat_id,
        string $status,
        string $is_move
    ): self {
        $state = new self;
        $state->email = mb_strtolower($email);
        $state->cat_id = $cat_id;
        $state->status = $status === 'true' ? EmailItem::STATUS_PUBLISHED : EmailItem::STATUS_DRAFT;
        $state->is_move = $is_move === 'true' ? EmailItem::STATUS_PUBLISHED : EmailItem::STATUS_DRAFT;

        return $state;
    }
} 
