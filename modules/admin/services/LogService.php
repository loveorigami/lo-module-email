<?php
/**
 * Created by PhpStorm.
 * User: Lukyanov Andrey <loveorigami@mail.ru>
 * Date: 03.11.2016
 * Time: 11:05
 */

namespace lo\modules\email\modules\admin\services;

use lo\core\helpers\DateHelper;
use lo\modules\email\repositories\EmailLogRepository;

class LogService
{
    private $logRepository;
    private $mailing;

    public function __construct(
        EmailLogRepository $logRepository,
        MailingInterface $mailing
    )
    {
        $this->logRepository = $logRepository;
        $this->mailing = $mailing;
    }

    /**
     * @param $date
     */
    public function getMetricsList($date)
    {
        $date_from = $date;
        $date_to = DateHelper::rangeDateByDays(1, $date);
        $data = $this->mailing->getMetricsList($date_from, $date_to);
        $data['date'] = $date;
        /** @var \lo\modules\email\models\EmailLog $item */
        $item = $this->logRepository->findByDate($date);
        $this->logRepository->saveLog($item, $data);
    }
}