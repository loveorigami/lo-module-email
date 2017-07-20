<?php
namespace lo\modules\email\modules\admin\services;

interface MailingInterface
{
    /**
     * @param string $emailTo send to user
     * @param $tpl
     * @param array $substitutionData
     */
    public function send($emailTo, $tpl, $substitutionData);

    /**
     * @param $date_from
     * @param $date_to
     * @return array
     */
    public function getBouncesList($date_from, $date_to);

    /**
     * @param $date_from
     * @param $date_to
     * @return array
     */
    public function getOpenList($date_from, $date_to);

    /**
     * @param $date_from
     * @param $date_to
     * @return array
     */
    public function getMetricsList($date_from, $date_to);

}