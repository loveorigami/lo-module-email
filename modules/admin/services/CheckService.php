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
    public function unsubscribeBouncesList($date)
    {
        /**
         * поля
         * raw_reason - причина отказа
         * raw_rcpt_to - кому отправлял
         * bounce_class - тип отказа числовой
         * error_code - код ошибки
         * type - тип отказа
         * 'transmission_id'
         * 'timestamp'
         */
        $date_from = $date . 'T08:00';
        $date_to = DateHelper::rangeDateByDays(1, $date) . 'T08:00';
        $data = $this->mailing->getBouncesList($date_from, $date_to);

        foreach ($data as $bounce) {
            $msg = MessageEventDto::init($bounce);
            $item = $this->emailRepository->findByEmail($msg->email);
            $this->emailRepository->unsubscribeBounce($item, $msg);
        }

    }
}