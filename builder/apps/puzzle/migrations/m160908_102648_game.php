<?php

use yii\db\Migration;

class m160908_102648_game extends Migration
{
    public function up()
    {
        $this->createTable('game', [
            'id' => $this->primaryKey(),
            'user' => $this->bigInteger(),
            'token' => $this->string(32),
            'puzzle' => $this->integer(),
            'data' => $this->text(),
            'score' => $this->float(),
            'finished' => $this->integer(),
            'created' => $this->integer(),
        ], 'DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');
    }

    public function down()
    {
        $this->dropTable('game');
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
