<?php

namespace lo\modules\email\handlers;

use lo\modules\email\repositories\EmailItemRepository;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * Class EmailHandler
 * @package lo\modules\email\handlers
 * @author Lukyanov Andrey <loveorigami@mail.ru>
 */
class EmailHandler
{
    const HANDLER_SUBSCRIBE_CONTACT = 'subscribeEmailFromContact';
    const HANDLER_SUBSCRIBE_ORDER = 'subscribeEmailFromOrder';

    /**
     * ```php
     *  $event = Yii::createObject(['class' => FormEvent::class, 'form' => $form]);
     *  $this->trigger(self::EVENT_AFTER_CONTACT, $event);
     * ```
     * @param $event
     * @param $catId
     */
    protected static function subscribeEmail($event, $catId)
    {
        $email = $event->form->email;
        $name = $event->form->name;

        $emailRepository = new EmailItemRepository();
        $item = $emailRepository->findByEmail($email);

        if (!$item) {
            $emailRepository->addEmail([
                'cat_id' => $catId,
                'email' => $email,
                'name' => $name,
                'author_id' => Yii::$app->user->id
            ]);
        }
    }

    /**
     * @param $event
     */
    public static function subscribeEmailFromContact($event)
    {
        self::subscribeEmail($event, EmailItemRepository::CATEGORY_CONTACT);
    }

    /**
     * @param $event
     */
    public static function subscribeEmailFromOrder($event)
    {
        self::subscribeEmail($event, EmailItemRepository::CATEGORY_ORDER);
    }
}