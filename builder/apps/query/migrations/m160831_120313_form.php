<?php

use yii\db\Migration;

class m160831_120313_form extends Migration
{
    public function up()
    {
        $this->createTable('form', [
            'id' => $this->primaryKey(),
            'user' => $this->bigInteger(),
            'score' => $this->float(),
            'questions' => $this->text(),
            'created' => $this->integer(),
        ], 'DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');
    }

    public function down()
    {
        $this->dropTable('form');
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
