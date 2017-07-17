<?php
/**
 * Created by PhpStorm.
 * User: Lukyanov Andrey <loveorigami@mail.ru>
 * Date: 03.11.2016
 * Time: 11:05
 */

namespace lo\modules\email\modules\admin\services;

use lo\core\helpers\DateHelper;
use lo\modules\email\modules\admin\dto\MessageEventDto;
use lo\modules\email\repositories\EmailItemRepositoryInterface;

class CheckService
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
     * @param $date
     */
    public function messageEventsList($date)
    {
        $date_from = $date;
        $date_to = DateHelper::rangeDateByDays(1, $date);
        $data1 = $this->mailing->getBouncesList($date_from, $date_to);

        foreach ($data1 as $result) {
            $msg = MessageEventDto::init($result);
            $item = $this->emailRepository->findByEmail($msg->email);
            $this->emailRepository->unsubscribeBounce($item, $msg);
        }

        $data2 = $this->mailing->getOpenList($date_from, $date_to);
        foreach ($data2 as $result) {
            $msg = MessageEventDto::init($result);
            $item = $this->emailRepository->findByEmail($msg->email);
            $this->emailRepository->subscribeOpen($item, $msg);
        }
    }
}