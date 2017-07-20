<?php

namespace lo\modules\email\repositories;

/**
 * Created by PhpStorm.
 * User: Lukyanov Andrey <loveorigami@mail.ru>
 * Date: 09.01.2017
 * Time: 13:07
 */
class EmailLogRepositoryMap
{
    //public $id;
    public $date;
    public $count_injected;
    public $count_bounce;
    public $count_rejected;
    public $count_delivered;
    public $count_delivered_first;
    public $count_delivered_subsequent;
    // public $total_delivery_time_first;
    // public $total_delivery_time_subsequent;
    // public $total_msg_volume;
    public $count_policy_rejection;
    public $count_generation_rejection;
    public $count_generation_failed;
    public $count_inband_bounce;
    public $count_outofband_bounce;
    public $count_soft_bounce;
    public $count_hard_bounce;
    public $count_block_bounce;
    public $count_admin_bounce;
    public $count_undetermined_bounce;
    public $count_delayed;
    public $count_delayed_first;
    public $count_rendered;
    public $count_unique_rendered;
    public $count_unique_confirmed_opened;
    public $count_clicked;
    public $count_unique_clicked;
    public $count_targeted;
    public $count_sent;
    public $count_accepted;
    public $count_spam_complaint;

    /**
     * EmailLogRepositoryMap constructor.
     * @param array $data
     */
    public function __construct($data = [])
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }
}