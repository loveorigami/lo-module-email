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
 */
class EmailCat extends ActiveRecord
{
    const STATUS_DRAFT = 0;
    const STATUS_PUBLISHED = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%email__cat}}';
    }

    /**
     * @inheritdoc
     */
    public function metaClass()
    {
        return EmailCatMeta::class;
    }

}
