<?php
namespace lo\modules\email\migrations;
use lo\core\db\Migration;

class m170714_074915_sparkpost_fields extends Migration
{
    public $tableGroup = "email";
    const TBL = 'item';

    public function up()
    {
        // причина отказа
        $this->addColumn($this->tn(self::TBL), 'sp_raw_reason', $this->text());
        // raw_rcpt_to - кому отправлял
        // тип отказа числовой
        $this->addColumn($this->tn(self::TBL), 'sp_bounce_class', $this->integer());
        $this->addColumn($this->tn(self::TBL), 'sp_error_code', $this->integer(3));
        $this->addColumn($this->tn(self::TBL), 'sp_transmission_id', $this->string(25));
        $this->addColumn($this->tn(self::TBL), 'sp_timestamp', $this->string(35));
        $this->addColumn($this->tn(self::TBL), 'sp_type', $this->string(50));
    }

    public function down()
    {
        $this->dropColumn($this->tn(self::TBL), 'sp_raw_reason');
        $this->dropColumn($this->tn(self::TBL), 'sp_bounce_class');
        $this->dropColumn($this->tn(self::TBL), 'sp_error_code');
        $this->dropColumn($this->tn(self::TBL), 'sp_transmission_id');
        $this->dropColumn($this->tn(self::TBL), 'sp_timestamp');
        $this->dropColumn($this->tn(self::TBL), 'sp_type');
    }


}