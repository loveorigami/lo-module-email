<?php

namespace lo\modules\email\migrations;

use lo\core\db\Migration;

class m170718_124936_email_log extends Migration
{
    public $tableGroup = "email";

    const TBL = 'log';

    public function up()
    {
        $this->createTable($this->tn(self::TBL), [
            'id' => $this->primaryKey(),

            'count_injected' => $this->integer(),
            'count_bounce' => $this->integer(),
            'count_rejected' => $this->integer(),
            'count_delivered' => $this->integer(),
            'count_delivered_first' => $this->integer(),
            'count_delivered_subsequent' => $this->integer(),
            'total_delivery_time_first' => $this->integer(),
            'total_delivery_time_subsequent' => $this->integer(),
            'total_msg_volume' => $this->integer(),
            'count_policy_rejection' => $this->integer(),
            'count_generation_rejection' => $this->integer(),
            'count_generation_failed' => $this->integer(),
            'count_inband_bounce' => $this->integer(),
            'count_outofband_bounce' => $this->integer(),
            'count_soft_bounce' => $this->integer(),
            'count_hard_bounce' => $this->integer(),
            'count_block_bounce' => $this->integer(),
            'count_admin_bounce' => $this->integer(),
            'count_undetermined_bounce' => $this->integer(),
            'count_delayed' => $this->integer(),
            'count_delayed_first' => $this->integer(),
            'count_rendered' => $this->integer(),
            'count_unique_rendered' => $this->integer(),
            'count_unique_confirmed_opened' => $this->integer(),
            'count_clicked' => $this->integer(),
            'count_unique_clicked' => $this->integer(),
            'count_targeted' => $this->integer(),
            'count_sent' => $this->integer(),
            'count_accepted' => $this->integer(),
            'count_spam_complaint' => $this->integer(),

            'date' => $this->date()
        ]);

    }

    public function down()
    {
        $this->dropTable($this->tn(self::TBL));
    }


}