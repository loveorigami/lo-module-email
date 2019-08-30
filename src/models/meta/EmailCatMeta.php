<?php

namespace lo\modules\email\models\meta;

use lo\core\inputs\CheckBoxInputA;
use Yii;
use lo\core\db\MetaFields;
use lo\core\db\fields;

/**
 * Class EmailCatMeta
 *
 * @package lo\modules\email\models
 * @author  Lukyanov Andrey <loveorigami@mail.ru>
 */
class EmailCatMeta extends MetaFields
{
    /**
     * @return array
     */
    protected function config(): array
    {
        return [
            'name' => [
                'definition' => [
                    'class' => fields\TextField::class,
                    'title' => Yii::t('backend', 'Name'),
                    'showInGrid' => true,
                    'showInFilter' => true,
                    'isRequired' => false,
                    'editInGrid' => true,
                ],
                'params' => [$this->owner, 'name'],
            ],
            'slug' => [
                'definition' => [
                    'class' => fields\SlugField::class,
                    'title' => Yii::t('backend', 'Slug'),
                    'showInGrid' => true,
                    'showInFilter' => true,
                    'isRequired' => true,
                    'editInGrid' => false,
                ],
                'params' => [$this->owner, 'slug'],
            ],
            'is_hold' => [
                'definition' => [
                    'class' => fields\CheckBoxField::class,
                    'title' => Yii::t('backend', 'Is hold'),
                    'inputClass' => CheckBoxInputA::class,
                    'showInGrid' => true,
                    'showInFilter' => true,
                    'editInGrid' => true,
                ],
                'params' => [$this->owner, 'is_hold'],
            ],
        ];
    }
}
