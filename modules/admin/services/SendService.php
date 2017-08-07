<?php
/**
 * Created by PhpStorm.
 * User: Lukyanov Andrey <loveorigami@mail.ru>
 * Date: 03.11.2016
 * Time: 11:05
 */

namespace lo\modules\email\modules\admin\services;

use lo\modules\email\repositories\EmailItemRepository;

class SendService
{
    private $emailRepository;
    private $mailing;

    public function __construct(
        EmailItemRepository $emailRepository,
        MailingInterface $mailing
    )
    {
        $this->emailRepository = $emailRepository;
        $this->mailing = $mailing;
    }

    /**
     * @param $cat_id
     * @param $session
     * @param int $limit
     * @return array
     */
    public function getEmails($cat_id, $session, $limit = 10)
    {
        return $this->emailRepository->findEmailsByGroupSession($cat_id, $session, $limit);
    }

    /**
     * @param $emails
     * @param $tpl
     * @param $session
     */
    public function sendEmails($emails, $tpl, $session)
    {
        $this->emailRepository->sendEmails($emails, $session);
        $this->mailing->send($emails, $tpl, $this->emailRepository->getSubstitutionDataKeys());
    }
}