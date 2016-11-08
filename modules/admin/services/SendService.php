<?php
/**
 * Created by PhpStorm.
 * User: Lukyanov Andrey <loveorigami@mail.ru>
 * Date: 03.11.2016
 * Time: 11:05
 */

namespace lo\modules\email\modules\admin\services;

use lo\modules\email\repositories\EmailItemRepositoryInterface;

class SendService
{
    private $emailRepository;
    private $mailing;

    public function __construct(
        EmailItemRepositoryInterface $emailRepository,
        MailingInterface $mailing
    )
    {
        $this->emailRepository = $emailRepository;
        $this->mailing = $mailing;
    }

    /**
     * @param $cat_id
     * @param $tpl
     * @param $session
     * @return bool|string
     */
    public function sendEmail($cat_id, $tpl, $session)
    {
        $item = $this->emailRepository->findByGroupSession($cat_id, $session);
        if (!$item) return false;

        $email = $this->emailRepository->getEmail($item);
        $this->mailing->send($tpl, [
            'hash' => $this->emailRepository->getHash($item)
        ], $email);

        return $email;
    }
}