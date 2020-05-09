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
            'type_id' => $this->integer(11),
        ], $tableOptions);

        $tableoptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('data', [
            'device_id' => $this->primaryKey(),
            'value' => $this->text(),
            'created_at' => $this->timestamp(),
            'type' => $this->tinyInteger(1),
        ], $tableOptions);

        $tableoptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('properties', [
            'id' => $this->primaryKey(),
            'name' => $this->string(20),
            'key' => $this->text(),
            'description' => $this->text(),
            'format' => $this->tinyInteger(5),
            'value' => $this->text(),
            'device_id' => $this->integer(11)->null()->defaultValue(0),
            'type_id' => $this->integer(11)->null()->defaultValue(0),
            'type_name' => $this->string(20)->null(),
            'type_key' => $this->text(),
            'type_description' => $this->text(),
            'type_format' => $this->tinyInteger(5),
            'type_value' => $this->text(),
        ], $tableOptions);

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('tag', [
            'device_id' => $this->integer(11),
            'name' => $this->string(20)->notNull(),
        ], $tableOptions);

        $tableoptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('type', [
            'id' => $this->primaryKey(),
            'name' => $this->string(20),
            'api' => $this->string(20),
            'description' => $this->text(),
            'device_id' => $this->integer(11)->null()->defaultValue(0),
        ], $tableOptions);

        $tableoptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('variable', [
            'id' => $this->primaryKey(),
            'name' => $this->string(20),
            'api' => $this->string(20),
            'description' => $this->text(),
            'range' => $this->integer(11),
            'unit' => $this->text(),
            'device_id' => $this->integer(11)->null()->defaultValue(0),
            'type_id' => $this->integer(11)->null()->defaultValue(0),
            'type_name' => $this->string(20),
            'type_api' => $this->string(20),
            'type_description' => $this->text(),
            'type_range' => $this->integer(11),
            'type_unit' => $this->text(),
        ], $tableOptions);

        $this->createIndex(
            'idx-data-device_id',
            'data',
            'device_id'
        );
        $this->addForeignKey(
            'fk-data-device_id',
            'data',
            'device_id',
            'device',
            'id'
        );
        $this->createIndex(
            'idx-device-type_id',
            'device',
            'type_id'
        );
        $this->addForeignKey(
            'fk-device-type_id',
            'device',
            'type_id',
            'type',
            'id'
        );
        $this->createIndex(
            'idx-properties-device_id',
            'properties',
            'device_id'
        );
        $this->addForeignKey(
            'fk-properties-device_id',
            'properties',
            'device_id',
            'device',
            'id'
        );
        $this->createIndex(
            'idx-properties-type_id',
            'properties',
            'type_id'
        );
        $this->addForeignKey(
            'fk-properties-type_id',
            'properties',
            'type_id',
            'type',
            'id'
        );
        $this->createIndex(
            'idx-tag-device_id',
            'tag',
            'device_id'
        );
        $this->addForeignKey(
            'fk-tag-device_id',
            'tag',
            'device_id',
            'device',
            'id'
        );
        $this->createIndex(
            'idx-type-device_id',
            'type',
            'device_id'
        );
        $this->addForeignKey(
            'fk-type-device_id',
            'type',
            'device_id',
            'device',
            'id'
        );
        $this->createIndex(
            'idx-variable-device_id',
            'variable',
            'device_id'
        );
        $this->addForeignKey(
            'fk-variable-device_id',
            'variable',
            'device_id',
            'device',
            'id'
        );
        $this->createIndex(
            'idx-variable-type_id',
            'variable',
            'type_id'
        );
        $this->addForeignKey(
            'fk-variable-type_id',
            'variable',
            'type_id',
            'type',
            'id'
        );

    }
    public function down()
    {
        $this->dropIndex('fk-data-device_id');
        $this->dropIndex('fk-device-type_id');
        $this->dropIndex('fk-properties-device_id');
        $this->dropIndex('fk-properties-type_id');
        $this->dropIndex('fk-tag-device_id');
        $this->dropIndex('fk-type-device_id');
        $this->dropIndex('fk-variable-device_id');
        $this->dropIndex('fk-variable-type_id');

        $this->dropForeignKey('fk-data-device_id');
        $this->dropForeignKey('fk-device-type_id');
        $this->dropForeignKey('fk-properties-device_id');
        $this->dropForeignKey('fk-properties-type_id');
        $this->dropForeignKey('fk-tag-device_id');
        $this->dropForeignKey('fk-type-device_id');
        $this->dropForeignKey('fk-variable-device_id');
        $this->dropForeignKey('fk-variable-type_id');

        $this->dropTable('data');
        $this->dropTable('device');
        $this->dropTable('tag');
        $this->dropTable('type');
        $this->dropTable('properties');
        $this->dropTable('variable');

    }
}
