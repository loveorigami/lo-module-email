<?php
namespace lo\modules\email\migrations;

use lo\core\db\Migration;

class m161028_071146_email_item extends Migration
{
    public $tableGroup = "email";

    const TBL = 'item';
    const TBL_PARENT = 'cat';

    public function up()
    {
        $this->createTable($this->tn(self::TBL), [
            'id' => $this->primaryKey(),
            'status' => 'tinyint(1) NOT NULL DEFAULT 0',
            'author_id' => $this->integer()->notNull(),
            'updater_id' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),

            'cat_id' => $this->integer()->notNull(),
            'session_id' => $this->string(),

            'name' => $this->string(),
            'email' => $this->string()->notNull(),

            'date_send' => $this->date(),
            'date_subscribe' => $this->date(),
            'date_unsubscribe' => $this->date(),
            'hash' => $this->string(32),

        ]);

        $this->createIndex('idx_email_item_status', $this->tn(self::TBL), 'status');
        $this->createIndex('idx_email_item_session', $this->tn(self::TBL), 'session_id');


        $this->addForeignKey(
            $this->fk(self::TBL, self::TBL_PARENT),
            $this->tn(self::TBL), 'cat_id',
            $this->tn(self::TBL_PARENT), 'id',
            'CASCADE', 'CASCADE'
        );

    }

    public function down()
    {
        $this->dropTable($this->tn(self::TBL));

        $this->dropForeignKey(
            $this->fk(self::TBL, self::TBL_PARENT),
            $this->tn(self::TBL)
        );

    }
}