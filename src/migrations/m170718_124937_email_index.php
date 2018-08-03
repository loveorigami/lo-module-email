<?php

namespace lo\modules\email\migrations;

use lo\core\db\Migration;

class m170718_124937_email_index extends Migration
{
    public $tableGroup = 'email';

    const TBL = 'item';

    public function up()
    {
        $this->createIndex('idx_email_item_email', $this->tn(self::TBL), 'email', true);
        $this->createIndex('idx_email_item_hash', $this->tn(self::TBL), 'hash');
    }

    public function down()
    {
        $this->dropIndex('idx_email_item_email', $this->tn(self::TBL));
        $this->dropIndex('idx_email_item_hash', $this->tn(self::TBL));
    }


}
