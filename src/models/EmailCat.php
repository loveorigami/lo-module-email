<?php

namespace lo\modules\email\models;

use lo\core\db\ActiveRecord;
use lo\modules\email\models\meta\EmailCatMeta;

/**
 * This is the model class for table "email__cat".
 *
 * @property integer $id
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $is_hold
 */
class EmailCat extends ActiveRecord
{
    public const STATUS_DRAFT = 0;
    public const STATUS_PUBLISHED = 1;

    /**
     * @inheritdoc
     */
    public static function tableName(): string
    {
        return '{{%email__cat}}';
    }

    /**
     * @inheritdoc
     */
    public function metaClass(): string
    {
        return EmailCatMeta::class;
    }

}
