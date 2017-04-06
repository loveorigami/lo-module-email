<?php

namespace lo\modules\email\models;

use lo\core\db\ActiveRecord;
use lo\modules\email\models\meta\EmailItemMeta;

/**
 * This is the model class for table "email__item".
 *
 * @property integer $id
 * @property string $email
 * @property string $session_id
 * @property integer $status
 * @property integer $hash
 * @property integer $created_at
 * @property integer $updated_at
 */
class EmailItem extends ActiveRecord
{
    const STATUS_DRAFT = 0;
    const STATUS_PUBLISHED = 1;

    const CATEGORY_SUBSCRIBE = 8;
    const CATEGORY_CONTACT = 17;
    const CATEGORY_COMMENT = 18;
    const CATEGORY_MINISITE = 20;
    const CATEGORY_ORDER = 24;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%email__item}}';
    }

    /**
     * @inheritdoc
     */
    public function metaClass()
    {
        return EmailItemMeta::class;
    }

    public function getCat()
    {
        return $this->hasOne(EmailCat::class, ['id' => 'cat_id']);
    }


}
