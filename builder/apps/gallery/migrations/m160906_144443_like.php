<?php

use yii\db\Migration;

class m160906_144443_like extends Migration
{
    public function up()
    {
        $this->createTable('like', [
            'id' => $this->primaryKey(),
            'user' => $this->bigInteger(),
            'poster' => $this->integer(),
            'created' => $this->integer(),
        ], 'DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');
    }

    public function down()
    {
        $this->dropTable('like');
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
