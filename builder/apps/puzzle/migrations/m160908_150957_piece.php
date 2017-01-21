<?php

use yii\db\Migration;

class m160908_150957_piece extends Migration
{
    public function up()
    {
        $this->createTable('piece', [
            'id' => $this->primaryKey(),
            'image' => $this->string(32),
            'number' => $this->integer(),
            'puzzle' => $this->integer(),
            'created' => $this->integer(),
        ], 'DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');
    }

    public function down()
    {
        $this->dropTable('piece');
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
