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
    private $item;

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
     * @param $session
     * @return bool|string
     */
    public function getEmail($cat_id, $session)
    {
        $this->item = $this->emailRepository->findByGroupSession($cat_id, $session);
        return $this->emailRepository->getEmail($this->item);
    }

    /**
     * @param $emailTo
     * @param $tpl
     */
    public function sendEmail($emailTo, $tpl)
    {
        $status = $this->mailing->send($emailTo, $tpl, [
            'hash' => $this->emailRepository->getHash($this->item)
        ]);

        if (!$status) {
            // blocked
        }
    }
}