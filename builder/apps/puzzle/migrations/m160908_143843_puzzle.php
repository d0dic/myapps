<?php

use yii\db\Migration;

class m160908_143843_puzzle extends Migration
{
    public function up()
    {
        $this->createTable('puzzle', [
            'id' => $this->primaryKey(),
            'name' => $this->string(32),
            'active' => $this->boolean(),
            'created' => $this->integer(),
        ], 'DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');
    }

    public function down()
    {
        $this->dropTable('puzzle');
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
