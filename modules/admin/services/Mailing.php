<?php

namespace lo\modules\email\modules\admin\services;

use lo\modules\email\components\sparkpost\Mailer;
use Yii;

class Mailing implements MailingInterface
{
    /**
     * @param string $emailTo send email to user
     * @param $tpl
     * @param $data
     */
    public function send($emailTo, $tpl, $data)
    {
        /** @var Mailer $sparkpost */
        $sparkpost = Yii::$app->sparkpost;
        $sparkpost->compose(['template' => $tpl], $data)
            ->setTo($emailTo)
            ->send();
    }

} 