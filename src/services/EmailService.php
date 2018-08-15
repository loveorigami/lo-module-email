<?php
/**
 * Created by PhpStorm.
 * User: Lukyanov Andrey <loveorigami@mail.ru>
 * Date: 03.11.2016
 * Time: 11:05
 */

namespace lo\modules\email\services;

use lo\core\exceptions\FlashErrorException;
use lo\modules\email\repositories\EmailItemRepository;

class EmailService
{
    private $emailRepository;

    public function __construct(
        EmailItemRepository $emailRepository
    ) {
        $this->emailRepository = $emailRepository;
    }

    /**
     * @param $data
     * @throws \Throwable
     */
    public function createEmail($data)
    {
        $this->emailRepository->addEmail($data);
    }

    /**
     * @param $email
     * @throws FlashErrorException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function unsubscribeByEmail($email)
    {
        /** @var \lo\modules\email\models\EmailItem $item */
        $item = $this->emailRepository->findBySubscribeEmail($email);
        if (!$item) {
            throw new FlashErrorException('E-mail отсутсвует в базе данных');
        }
        $this->emailRepository->unsubscribe($item);
    }

    /**
     * @param $hash
     * @throws FlashErrorException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function unsubscribeByHash($hash)
    {
        $item = $this->emailRepository->findByHash($hash);
        if (!$item) {
            throw new FlashErrorException('E-mail отсутсвует в базе данных');
        }
        $this->emailRepository->unsubscribe($item);
    }
}
