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

    /**
     * @param $date_from
     * @param $date_to
     * @return array|bool
     */
    public function getBouncesList($date_from, $date_to)
    {
        /** @var Mailer $sparkpost */
        $sparkpost = Yii::$app->sparkpost;
        return $sparkpost->getBouncesList($date_from, $date_to);
    }

    /**
     * @param $date_from
     * @param $date_to
     * @return array|bool
     */
    public function getOpenList($date_from, $date_to)
    {
        /** @var Mailer $sparkpost */
        $sparkpost = Yii::$app->sparkpost;
        return $sparkpost->getOpenList($date_from, $date_to);
    }

    /**
     * @param $date_from
     * @param $date_to
     * @return array|bool
     */
    public function getMetricsList($date_from, $date_to)
    {
        /** @var Mailer $sparkpost */
        $sparkpost = Yii::$app->sparkpost;
        return $sparkpost->getMetricsList($date_from, $date_to);
    }

} 