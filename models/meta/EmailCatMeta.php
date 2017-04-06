<?php
namespace lo\modules\email\models\meta;

use Yii;
use lo\core\db\MetaFields;
use lo\core\db\fields;


/**
 * Class EmailCatMeta
 * @package lo\modules\email\models
 * @author Lukyanov Andrey <loveorigami@mail.ru>
 */
class EmailCatMeta extends MetaFields
{
    /**
     * @inheritdoc
     */
    protected function config()
    {
        return [
            "name" => [
                "definition" => [
                    "class" => fields\TextField::class,
                    "title" => Yii::t('backend', 'Name'),
                    "showInGrid" => true,
                    "showInFilter" => true,
                    "isRequired" => false,
                    "editInGrid" => true,
                ],
                "params" => [$this->owner, "name"]
            ],
        ];
    }
}