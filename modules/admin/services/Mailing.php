<?php

namespace lo\modules\email\modules\admin\services;

use lo\modules\email\components\sparkpost\Mailer;
use Yii;

class Mailing implements MailingInterface
{
    /**
     * @param string $emailTo
     * @param $tpl
     * @param array $data
     * @return bool
     */
    public function send($emailTo, $tpl, $data)
    {
        /** @var Mailer $sparkpost */
        $sparkpost = Yii::$app->sparkpost;
        return $sparkpost->compose(['template' => $tpl], $data)
            ->setTo($emailTo)
            ->send();
    }

} 