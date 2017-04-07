<?php
/**
 * Created by PhpStorm.
 * User: Lukyanov Andrey <loveorigami@mail.ru>
 * Date: 03.11.2016
 * Time: 11:05
 */

namespace lo\modules\email\services;

use lo\core\exceptions\FlashErrorException;
use lo\modules\email\repositories\EmailItemRepositoryInterface;

class EmailService
{
    private $emailRepository;

    public function __construct(
        EmailItemRepositoryInterface $emailRepository
    )
    {
        $this->emailRepository = $emailRepository;
    }

    /**
     * @param $data
     */
    public function createEmail($data)
    {
        $this->emailRepository->addEmail($data);
    }

    /**
     * @param $email
     * @throws FlashErrorException
     */
    public function unsubscribeByEmail($email)
    {
        $item = $this->emailRepository->findBySubscribeEmail($email);
        if (!$item) {
            throw new FlashErrorException('E-mail отсутсвует в базе данных');
        }
        $this->emailRepository->unsubscribe($item);
    }

    /**
     * @param $hash
     * @throws FlashErrorException
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