<?php

namespace lo\modules\geo\models;

use Yii;

/**
 * This is the model class for table "geo__country".
 *
 * @property integer $id
 * @property string $slug
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class EmailItem extends \lo\core\db\ActiveRecord
{
    const STATUS_DRAFT = 0;
    const STATUS_PUBLISHED = 1;

    const DEF_COUNTRY = 188;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%geo__country}}';
    }

    /**
     * @inheritdoc
     */
    public function metaClass()
    {
        return CountryMeta::class;
    }

}
