<?php

use yii\db\Migration;

class m160906_111235_poster extends Migration
{
    public function up()
    {
        $this->createTable('poster', [
            'id' => $this->primaryKey(),
            'user' => $this->bigInteger(),
            'name' => $this->string(64),
            'image' => $this->text(),
            'likes' => $this->integer(),
            'shares' => $this->integer(),
            'approved' => $this->boolean(),
            'created' => $this->integer(),
        ], 'DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');
    }

    public function down()
    {
        $this->dropTable('poster');
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
