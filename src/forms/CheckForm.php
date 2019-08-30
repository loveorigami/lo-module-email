<?php

namespace lo\modules\email\forms;

use yii\base\Model;

class CheckForm extends Model
{
    public $date;

    public function rules(): array
    {
        return [
            [['date'], 'required'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'date' => 'Дата проверки',
        ];
    }
}
