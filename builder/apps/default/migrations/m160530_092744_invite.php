<?php

use yii\db\Migration;

class m160530_092744_invite extends Migration
{
    public function up()
    {
        $this->createTable('invite', [
            'id' => $this->primaryKey(),
            'user' => $this->bigInteger(),
            'friend' => $this->bigInteger(),
            'created' => $this->integer(),
        ], 'DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');
    }

    public function down()
    {
        $this->dropTable('invite');
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
