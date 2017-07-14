<?php

namespace lo\modules\email\forms;

use yii\base\Model;

class CheckForm extends Model
{
    public $date;

    public function rules()
    {
        return [
            [['date'], 'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'date' => 'Дата проверки',
        ];
    }
}