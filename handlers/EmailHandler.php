<?php

namespace lo\modules\email\handlers;

use lo\modules\email\repositories\EmailItemRepository;
use Yii;

/**
 * Class EmailHandler
 * @package lo\modules\email\handlers
 * @author Lukyanov Andrey <loveorigami@mail.ru>
 */
class EmailHandler
{
    const HANDLER_ADD_EMAIL = 'addEmail';

    /**
     * ```php
     *  $event = Yii::createObject(['class' => FormEvent::class, 'form' => $form]);
     *  $this->trigger(self::EVENT_AFTER_CONTACT, $event);
     * ```
     * @param $event
     */
    public static function addEmail($event)
    {
        $email = $event->form->email;
        $name = $event->form->name;

        $emailRepository = new EmailItemRepository();
        $item = $emailRepository->findByEmail($email);

        if (!$item) {
            $emailRepository->addEmailToCategoryContact([
                'email' => $email,
                'name' => $name,
                'author_id' => Yii::$app->user->id
            ]);
        }
    }
}