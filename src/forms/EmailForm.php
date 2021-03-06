<?php

namespace lo\modules\email\forms;

use yii\base\Model;

class EmailForm extends Model
{
    public $cat_id;
    public $tpl_id;

    public function rules()
    {
        return [
            [['cat_id', 'tpl_id'], 'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'cat_id' => 'Категория',
            'tpl_id' => 'Шаблон',
        ];
    }
}