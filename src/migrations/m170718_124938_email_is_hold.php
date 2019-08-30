<?php

namespace lo\modules\email\migrations;

use lo\core\db\Migration;

class m170718_124938_email_is_hold extends Migration
{
    public $tableGroup = 'email';

    const TBL = 'cat';

    public function up()
    {
        $this->addColumn(
            $this->tn(self::TBL),
            'is_hold',
            $this->tinyInteger()->defaultValue(1)
        );
    }

    public function down()
    {
        $this->dropColumn($this->tn(self::TBL), 'is_hold');
    }
}
