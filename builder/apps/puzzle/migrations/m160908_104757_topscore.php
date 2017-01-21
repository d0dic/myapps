<?php

use yii\db\Migration;

class m160908_104757_topscore extends Migration
{
    public function up()
    {
        $this->createTable('topscore', [
            'id' => $this->primaryKey(),
            'user' => $this->bigInteger(),
            'game' => $this->integer(),
            'created' => $this->integer(),
        ], 'DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');
    }

    public function down()
    {
        $this->dropTable('topscore');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
