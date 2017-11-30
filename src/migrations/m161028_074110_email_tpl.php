<?php
namespace lo\modules\email\migrations;

use lo\core\db\Migration;

class m161028_074110_email_tpl extends Migration
{
    public $tableGroup = "email";

    const TBL = 'tpl';

    public function up()
    {
        $this->createTable($this->tn(self::TBL), [
            'id' => $this->primaryKey(),
            'status' => 'tinyint(1) NOT NULL DEFAULT 0',
            'author_id' => $this->integer()->notNull(),
            'updater_id' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),

            'name' => $this->string()->notNull(),
            'text' => $this->text(),

        ]);

        $this->createIndex('idx_email_tpl_status', $this->tn(self::TBL), 'status');


    }

    public function down()
    {
        $this->dropTable($this->tn(self::TBL));

    }

}