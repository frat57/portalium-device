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
        ], $tableOptions);

        $this->insert('device', [
            'name' => 'Hüseyin Fırat Albayrak',
        ]);
    }
    public function down()
    {
        $this->dropTable('device');
    }
}
