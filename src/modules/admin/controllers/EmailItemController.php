<?php

namespace lo\modules\email\modules\admin\controllers;

use lo\modules\email\models\query\EmailItemQuery;
use lo\modules\email\modules\admin\models\BackEmailItem;
use Yii;
use yii\web\Controller;
use lo\core\actions\crud;

/**
 * Class EmailItemController
 *
 * @package lo\modules\email\modules\admin\controllers
 * @author  Lukyanov Andrey <loveorigami@mail.ru>
 */
class EmailItemController extends Controller
{
    /**
     * Действия
     *
     * @return array
     */

    public function actions(): array
    {
        $class = BackEmailItem::class;

        return [
            'index' => [
                'class' => crud\Index::class,
                'condition' => function ($query) {
                    if (Yii::$app->request->get('not-sended')) {
                        /** @var EmailItemQuery $query */
                        $query->notSended();
                    }
                },
                'modelClass' => $class,
            ],
            'view' => [
                'class' => crud\View::class,
                'modelClass' => $class,
            ],
            'create' => [
                'class' => crud\Create::class,
                'modelClass' => $class,
            ],
            'update' => [
                'class' => crud\Update::class,
                'modelClass' => $class,
            ],
            'delete' => [
                'class' => crud\Delete::class,
                'modelClass' => $class,
            ],
            'groupdelete' => [
                'class' => crud\GroupDelete::class,
                'modelClass' => $class,
            ],

            'editable' => [
                'class' => crud\XEditable::class,
                'modelClass' => $class,
            ],

        ];
    }

}
