<?php

use yii\db\Migration;

class m010101_010101_device extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('device', [
            'id' => $this->primaryKey(),
            'name' => $this->string(64)->notNull(),
            'api' => $this->string(64)->notNull(),
            'description' => $this->text(),
            'type' => $this->tinyInteger(5),
            'properties' => $this->string(64),
            'variable' => $this->string(64),
            'tag'=> $this->string(20)
        ], $tableOptions);


    }
    public function down()
    {
        $this->dropTable('device');
    }
}
