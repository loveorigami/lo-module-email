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

}