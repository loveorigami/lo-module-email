<?php

namespace lo\modules\email\forms;

use yii\base\Model;

class ImportForm extends Model
{
    public $list;

    public function rules()
    {
        return [
            [['list'], 'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'list' => 'Список',
        ];
    }
}