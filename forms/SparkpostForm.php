<?php

namespace lo\modules\email\forms;

use yii\base\Model;

class SparkpostForm extends Model
{
    public $cat_id;
    public $tpl_id;
    public $start_send;
    public $end_send;

    public function rules()
    {
        return [
            [['cat_id', 'tpl_id'], 'required'],
            [['start_send', 'end_send'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'cat_id' => 'Категория',
            'tpl_id' => 'Шаблон',
            'start_send' => 'Начать с',
            'end_send' => 'Закончить',
        ];
    }
}