<?php

use yii\db\Migration;

class m160530_092024_user extends Migration
{
    public function up()
    {
        $this->createTable('user', [
            'id' => $this->bigPrimaryKey(),
            'role' => $this->string(5),
            'link' => $this->string(128),
            'name' => $this->string(32),
            'email' => $this->string(64),
            'gender' => $this->string(6),
            'username' => $this->string(32),
            'password' => $this->string(60),
            'user_agent' => $this->text(),
            'ip_addr' => $this->string(16),
            'created' => $this->integer(),
        ], 'DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');
    }

    public function down()
    {
        $this->dropTable('user');
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
