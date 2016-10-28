<?php
namespace lo\modules\email\models;

use Yii;
use lo\core\db\MetaFields;
use lo\core\db\fields;
use yii\helpers\ArrayHelper;


/**
 * Class EmailItemMeta
 * @package lo\modules\email\models
 * @author Lukyanov Andrey <loveorigami@mail.ru>
 */
class EmailItemMeta extends MetaFields
{
    /**
     * Возвращает массив для привязки к категории
     * @return array
     */
    public function getCats()
    {
        $models = EmailCat::find()->published()->orderBy(["name" => SORT_ASC])->asArray()->all();
        return ArrayHelper::map($models, "id", "name");
    }
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
            "email" => [
                "definition" => [
                    "class" => fields\EmailField::class,
                    "title" => Yii::t('backend', 'Email'),
                    "showInGrid" => true,
                    "showInFilter" => true,
                    "isRequired" => true,
                ],
                "params" => [$this->owner, "email"]
            ],

            "cat_id" => [
                "definition" => [
                    "class" => fields\HasOneField::class,
                    "title" => Yii::t('backend', 'Cat'),
                    "isRequired" => true,
                    "data" => [$this, "getCats"], // массив всех категорий (см. выше)
                    "eagerLoading" => true,
                    "relationName" => "cat" // relation getCat
                ],
                "params" => [$this->owner, "cat_id"]
            ],

            "hash" => [
                "definition" => [
                    "class" => fields\HashField::class,
                    "title" => Yii::t('backend', 'Hash'),
                    "showInGrid" => false,
                    "showInFilter" => false,
                    "isRequired" => false,
                ],
                "params" => [$this->owner, "hash"]
            ],
        ];
    }
}