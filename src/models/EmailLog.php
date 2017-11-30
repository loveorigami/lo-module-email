<?php

namespace lo\modules\email\models;

use lo\core\db\ActiveRecord;
use lo\modules\email\models\meta\EmailLogMeta;

/**
 * This is the model class for table "email__log".
 *
 * @property integer $id
 * @property string $date
 */
class EmailLog extends ActiveRecord
{
    const STATUS_DRAFT = 0;
    const STATUS_PUBLISHED = 1;

    public $useDefaultConfig = false;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%email__log}}';
    }

    /**
     * @inheritdoc
     */
    public function metaClass()
    {
        return EmailLogMeta::class;
    }

}
