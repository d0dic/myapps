<?php

use yii\db\Migration;

class m160927_150642_share extends Migration
{
    public function up()
    {
        $this->createTable('share', [
            'id' => $this->primaryKey(),
            'user' => $this->bigInteger(),
            'post' => $this->string(64),
            'created' => $this->integer(),
        ], 'DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');
    }

    public function down()
    {
        $this->dropTable('share');
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
