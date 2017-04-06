<?php

namespace lo\modules\email\modules\admin\services;

use Yii;

class Mailing implements MailingInterface
{
    private $fromEmail;

    public function __construct($fromEmail)
    {
        $this->fromEmail = $fromEmail;
    }

    /**
     * @param $tpl
     * @param $data
     * @param string $emailTo send email to user
     */
    public function send($tpl, $data, $emailTo)
    {
        Yii::$app->sparkpost->compose()
            ->setTemplateId($tpl)
            ->setSubstitutionData($data)
            ->setFrom($this->fromEmail)
            ->setTo($emailTo)
            ->send();
    }

} 