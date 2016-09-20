<?php

use yii\db\Migration;

class m160902_112903_reply extends Migration
{
    public function up()
    {
        $this->createTable('reply', [
            'id' => $this->primaryKey(),
            'form' => $this->integer(),
            'answers' => $this->text(),
            'created' => $this->integer(),
        ], 'DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');
    }

    public function down()
    {
        $this->dropTable('reply');
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
