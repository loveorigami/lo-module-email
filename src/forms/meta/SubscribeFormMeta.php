<?php

namespace lo\modules\email\forms\meta;

use lo\core\db\MetaFields;
use lo\core\db\fields;

/**
 * Class EmailItemMeta
 * @package lo\modules\email\models
 * @author Lukyanov Andrey <loveorigami@mail.ru>
 */
class SubscribeFormMeta extends MetaFields
{

    /**
     * @inheritdoc
     */
    protected function config()
    {
        return [
            "email" => [
                "definition" => [
                    "class" => fields\EmailField::class,
                    "title" => 'Адрес электронной почты:',
                    "isRequired" => true,
                    "checkDNS" => true,
                    'rules' => [
                        'unique'
                    ]
                ],
                "params" => [$this->owner, "email"]
            ]
        ];
    }
}