<?php
namespace lo\modules\email\models\meta;

use Yii;
use lo\core\db\MetaFields;
use lo\core\db\fields;
use lo\core\inputs;


/**
 * Class EmailTplMeta
 * @package lo\modules\email\models
 * @author Lukyanov Andrey <loveorigami@mail.ru>
 */
class EmailTplMeta extends MetaFields
{
    const PATH = "emails/tpl";

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
                    "class" => fields\HtmlField::class,
                    "inputClass" => [
                        'class' => inputs\CKEditorInput::class,
                        'path' => self::PATH,
                    ],
                    "title" => Yii::t('backend', 'Text'),
                    "showInGrid" => false,
                    "isRequired" => false,
                ],
                "params" => [$this->owner, "text"]
            ],
        ];
    }
}