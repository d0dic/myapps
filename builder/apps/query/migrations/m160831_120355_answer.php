<?php

use yii\db\Migration;

class m160831_120355_answer extends Migration
{
    public function up()
    {
        $this->createTable('answer', [
            'id' => $this->primaryKey(),
            'correct' => $this->boolean(),
            'question' => $this->integer(),
            'content' => $this->text(),
            'created' => $this->integer(),
        ], 'DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');
    }

    public function down()
    {
        $this->dropTable('answer');
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
