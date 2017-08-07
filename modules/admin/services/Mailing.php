<?php

namespace lo\modules\email\modules\admin\services;

use lo\modules\email\components\sparkpost\Mailer;
use Yii;

class Mailing implements MailingInterface
{
    /**
     * @param array $emails
     * @param $tpl
     * @param array $data
     * @return bool
     */
    public function send($emails, $tpl, $data)
    {
        /** @var Mailer $sparkpost */
        $sparkpost = Yii::$app->sparkpost;
        return $sparkpost
            ->compose([
                'template' => $tpl
            ])
            ->setSubstitutionDataKeys($data)
            ->setTo($emails)
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