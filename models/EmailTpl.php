<?php

namespace lo\modules\email\models;

use lo\core\db\ActiveRecord;

/**
 * This is the model class for table "email__tpl".
 *
 * @property integer $id
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class EmailTpl extends ActiveRecord
{
    const STATUS_DRAFT = 0;
    const STATUS_PUBLISHED = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%email__tpl}}';
    }

    /**
     * @inheritdoc
     */
    public function metaClass()
    {
        return EmailTplMeta::class;
    }

}
