<?php

namespace lo\modules\email\modules\admin\models\meta;

use lo\modules\email\models\meta\EmailItemMeta;
use lo\core\db\fields;
use yii\helpers\ArrayHelper;

/**
 * Class EmailItemMeta
 * @package lo\modules\email\models
 * @author Lukyanov Andrey <loveorigami@mail.ru>
 */
class BackEmailItemMeta extends EmailItemMeta
{
    /**
     * @inheritdoc
     */
    protected function config()
    {
        return ArrayHelper::merge(parent::config(), [
            "email" => [
                "definition" => [
                    "class" => fields\TextField::class,
                ],
            ]
        ]);
    }
}