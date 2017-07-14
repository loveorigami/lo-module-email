<?php
/**
 * Created by PhpStorm.
 * User: Lukyanov Andrey <loveorigami@mail.ru>
 * Date: 03.11.2016
 * Time: 11:05
 */

namespace lo\modules\email\modules\admin\services;

use lo\modules\email\repositories\EmailItemRepositoryInterface;

class CheckService
{
    private $emailRepository;
    private $mailing;
    private $item;

    public function __construct(
        EmailItemRepositoryInterface $emailRepository,
        MailingInterface $mailing
    )
    {
        $this->emailRepository = $emailRepository;
        $this->mailing = $mailing;
    }

      /**
     */
    public function getBounces()
    {
        /**
         * поля
         * raw_reason - причина отказа
         * raw_rcpt_to - кому отправлял
         * bounce_class - тип отказа числовой
         * error_code - код ошибки
         * type - тип отказа
         * 'transmission_id'
         * 'timestamp'
         */
        return $this->mailing->getBounces();
        //d($bounces['results']);
        //d($bounces['total_count']);
       // d($bounces['links']);
        /*        foreach ($bounces['results'] as $item) {
                    //echo $item['raw_rcpt_to'];
                }*/
    }
}