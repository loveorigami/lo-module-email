<?php

namespace lo\modules\email\modules\admin\controllers;

use lo\modules\email\models\EmailTpl;
use yii\web\Controller;
use lo\core\actions\crud;

/**
 * Class EmailTplController
 * @package lo\modules\email\modules\admin\controllers
 * @author Lukyanov Andrey <loveorigami@mail.ru>
 */
class EmailTplController extends Controller
{
    /**
     * Действия
     * @return array
     */

    public function actions()
    {
        $class = EmailTpl::class;
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

        ];
    }

}
