<?php

namespace lo\modules\email\models;

use lo\core\db\ActiveRecord;
use lo\modules\email\models\meta\EmailItemMeta;
use lo\modules\email\models\query\EmailItemQuery;

/**
 * This is the model class for table "email__item".
 *
 * @property integer $id
 * @property integer $cat_id
 * @property string  $email
 * @property string  $session_id
 * @property string  $date_send
 * @property string  $date_subscribe
 * @property string  $date_unsubscribe
 * @property integer $status
 * @property integer $hash
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property integer $sp_bounce_class
 * @property integer $sp_error_code
 * @property string  $sp_raw_reason
 * @property string  $sp_transmission_id
 * @property string  $sp_timestamp
 * @property string  $sp_type
 */
class EmailItem extends ActiveRecord
{
    public const STATUS_DRAFT = 0;
    public const STATUS_PUBLISHED = 1;

    public const CATEGORY_SUBSCRIBE = 8;
    public const CATEGORY_CONTACT = 17;
    public const CATEGORY_COMMENT = 18;
    public const CATEGORY_MINI_SITE = 20;
    public const CATEGORY_ORDER = 24;
    public const CATEGORY_AUTO_UNSUBSCRIBE = 30;

    /**
     * @return string
     */
    public static function tableName(): string
    {
        return '{{%email__item}}';
    }

    /**
     * @return string
     */
    public function metaClass(): string
    {
        return EmailItemMeta::class;
    }

    /**
     * @return EmailItemQuery
     */
    public static function find(): EmailItemQuery
    {
        return new EmailItemQuery(static::class);
    }

    /**
     * @return \lo\core\db\ActiveQuery
     */
    public function getCat(): \lo\core\db\ActiveQuery
    {
        return $this->hasOne(EmailCat::class, ['id' => 'cat_id']);
    }

}
