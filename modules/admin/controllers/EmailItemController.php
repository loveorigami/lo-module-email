<?php

namespace lo\modules\email\modules\admin\controllers;

use lo\core\modules\settings\actions\Settings;
use lo\core\modules\settings\models\FormModel;
use lo\modules\email\models\EmailItem;
use Yii;
use yii\web\Controller;
use lo\core\actions\crud;

/**
 * PageController implements the CRUD actions for Country model.
 */
class EmailItemController extends Controller
{
    /**
     * Действия
     * @return array
     */

    public function actions()
    {
        $class = EmailItem::class;
        return [
            'index'=>[
                'class'=> crud\Index::class,
                'modelClass'=>$class,
            ],
            'view'=>[
                'class'=> crud\View::class,
                'modelClass'=>$class,
            ],
            'create'=>[
                'class'=> crud\Create::class,
                'modelClass'=>$class,
            ],
            'update'=>[
                'class'=> crud\Update::class,
                'modelClass'=>$class,
            ],
            'delete'=>[
                'class'=> crud\Delete::class,
                'modelClass'=>$class,
            ],
            'groupdelete'=>[
                'class'=>crud\GroupDelete::class,
                'modelClass'=>$class,
            ],

            'editable'=>[
                'class'=>crud\XEditable::class,
                'modelClass'=>$class,
            ],

            'settings'=>[
                'class'=>Settings::class,
                'keys' => [
                    'backend.email.send_session' => [
                        'label' => Yii::t('backend', 'Send session'),
                        'type' => FormModel::TYPE_TEXTINPUT,
                    ],
                ]
            ],
        ];
    }

}
