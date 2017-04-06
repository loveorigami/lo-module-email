<?php
namespace lo\modules\email\modules\admin\services;

interface MailingInterface
{
    /**
     * @param $tpl
     * @param $substitutionData
     * @param string $emailTo send to user
     */
    public function send($tpl, $substitutionData, $emailTo);

}