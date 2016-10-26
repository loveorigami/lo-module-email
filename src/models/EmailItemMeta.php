<?php
namespace lo\modules\geo\models;

use Yii;
use lo\core\db\MetaFields;


/**
 * Class AuthorMeta
 * Мета описание модели
 * @package lo\modules\geo\models
 */
class EmailItemMeta extends MetaFields
{

    /**
     * @inheritdoc
     */
    protected function config()
    {
        return [

            "img" => [
                "definition" => [
                    "class" => \lo\core\db\fields\ElfImgField::class,
                    "gridWidth" => 25,
                    "viewWidth" => 50,
                    "inputClassOptions" => [
                        "widgetOptions"=>[
                            'path'=>'geo/country'
                        ],
                    ],
                    "title" => Yii::t('backend', 'Image'),
                ],
                "params" => [$this->owner, "img"]
            ],
            "name" => [
                "definition" => [
                    "class" => \lo\core\db\fields\TextField::class,
                    "title" => Yii::t('backend', 'Name'),
                    "showInGrid" => true,
                    "showInFilter" => true,
                    "isRequired" => true,
                    "editInGrid" => true,
                ],
                "params" => [$this->owner, "name"]
            ],
            "name_en" => [
                "definition" => [
                    "class" => \lo\core\db\fields\TextField::class,
                    "title" => Yii::t('backend', 'NameEn'),
                    "showInGrid" => true,
                    "showInFilter" => true,
                    "isRequired" => false,
                ],
                "params" => [$this->owner, "name_en"]
            ],

        ];
    }
}