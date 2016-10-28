<?php
namespace lo\modules\email\models;

use Yii;
use lo\core\db\MetaFields;
use lo\core\db\fields;


/**
 * Class EmailTplMeta
 * @package lo\modules\email\models
 * @author Lukyanov Andrey <loveorigami@mail.ru>
 */
class EmailTplMeta extends MetaFields
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
                    "editInGrid" => false,
                ],
                "params" => [$this->owner, "name"]
            ],
            "text" => [
                "definition" => [
                    "class" => fields\TextField::class,
                    "title" => Yii::t('backend', 'Text'),
                    "showInGrid" => true,
                    "showInFilter" => true,
                    "isRequired" => true,
                ],
                "params" => [$this->owner, "text"]
            ],
        ];
    }
}