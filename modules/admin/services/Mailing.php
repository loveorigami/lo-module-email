<?php

namespace lo\modules\email\modules\admin\services;

use lo\modules\email\components\sparkpost\Mailer;
use Yii;
use yii\base\ErrorException;

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
     * @return array
     */
    public function getBounces()
    {
        /** @var Mailer $sparkpost */
        $sparkpost = Yii::$app->sparkpost;
        $sparky = $sparkpost->getSparky();
        $promise = $sparky->request('GET', 'message-events', [
            'events' => 'bounce,delay,policy_rejection,out_of_band,generation_failure,generation_rejection,spam_complaint,list_unsubscribe,link_unsubscribe',
            'from' => '2017-07-09T08:00',
        ]);

        try {
            $response = $promise->wait();
            return $response->getBody();
        } catch (ErrorException $e) {
            echo "Exception:\n";
            echo $e->getCode() . "\n";
            echo $e->getMessage() . "\n";
        }

    }

} 