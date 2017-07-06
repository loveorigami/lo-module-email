<?php

namespace lo\modules\email\modules\admin\services;
use yii\base\Component;
use Yii;

class Mailing implements MailingInterface
{
    /**
     * @param $tpl
     * @param $data
     * @param string $emailTo send email to user
     */
    public function send($tpl, $data, $emailTo)
    {
        $sparkpost = Yii::$app->sparkpost;
        $sparkpost->compose()
            ->setTemplateId($tpl)
            ->setSubstitutionData($data)
            ->setTo($emailTo)
            ->send();
    }
} 