<?php
namespace lo\modules\email\migrations;
use lo\core\db\Migration;

class m170714_074950_slug_field extends Migration
{
    public $tableGroup = "email";
    const TBL = 'cat';

    public function up()
    {
        $this->addColumn(
            $this->tn(self::TBL),
            'slug',
            $this->string()
        );
    }

    public function down()
    {
        $this->dropColumn($this->tn(self::TBL), 'slug');
    }


}