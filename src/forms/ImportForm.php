<?php

namespace lo\modules\email\forms;

use yii\base\Model;

class ImportForm extends Model
{
    public $list;
    public $is_move;

    public function rules(): array
    {
        return [
            ['list', 'required'],
            ['is_move', 'safe'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'list' => 'Список',
            'is_move' => 'Переносить?',
        ];
    }
}
