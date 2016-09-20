<?php

use yii\db\Migration;

class m160831_120347_question extends Migration
{
    public function up()
    {
        $this->createTable('question', [
            'id' => $this->primaryKey(),
            'image' => $this->string(32),
            'content' => $this->text(),
            'points' => $this->integer(),
            'created' => $this->integer(),
        ], 'DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');
    }

    public function down()
    {
        $this->dropTable('question');
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
