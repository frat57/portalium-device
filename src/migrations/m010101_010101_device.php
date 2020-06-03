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

        $this->createTable('app', [
            'id' => $this->primaryKey(),
            'name' => $this->string(20)->notNull(),
        ], $tableOptions);

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('app_projects', [
            'project_id' => $this->integer(11),
            'app_id' => $this->integer(11),
        ], $tableOptions);

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('device_tags', [
            'device_id' => $this->integer(11),
            'tag_id' => $this->integer(11),
        ], $tableOptions);

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
            'project_id' => $this->integer(11),
        ], $tableOptions);

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('project', [
            'id' => $this->primaryKey(),
            'name' => $this->string(20)->notNull(),
            'device_name' => $this->integer(11),
            'conn_type' => $this->string(20),
            'app_config' => $this->text(),
        ], $tableOptions);

        $tableoptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('data', [
            'device_id' => $this->integer(11),
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
        ], $tableOptions);

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('tag', [
            'device_id' => $this->integer(11),
            'name' => $this->string(20)->notNull(),
            'frequency' => $this->string(20),
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
        ], $tableOptions);

        $this->createIndex(
            'idx-device_tags-tag_id',
            'device_tags',
            'tag_id'
        );
        $this->addForeignKey(
            'fk-device_tags-device_id',
            'device_tags',
            'tag_id',
            'tag',
            'id'
        );
        $this->createIndex(
            'idx-device_tags-device_id',
            'device_tags',
            'device_id'
        );
        $this->addForeignKey(
            'fk-device_tags-device_id',
            'device_tags',
            'device_id',
            'device',
            'id'
        );
        $this->createIndex(
            'idx-app_projects-project_id',
            'app_projects',
            'project_id'
        );
        $this->addForeignKey(
            'fk-app_projects-project_id',
            'app_projects',
            'project_id',
            'project',
            'id'
        );
        $this->createIndex(
            'idx-app_projects-app_id',
            'app_projects',
            'app_id'
        );
        $this->addForeignKey(
            'fk-app_projects-app_id',
            'app_projects',
            'app_id',
            'app',
            'id'
        );
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
            'idx-project-device_id',
            'project',
            'device_id'
        );
        $this->addForeignKey(
            'fk-project-device_id',
            'project',
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
        $this->dropIndex('idx-data-device_id');
        $this->dropIndex('idx-project-device_id');
        $this->dropIndex('idx-device-type_id');
        $this->dropIndex('idx-properties-device_id');
        $this->dropIndex('idx-properties-type_id');
        $this->dropIndex('idx-tag-device_id');
        $this->dropIndex('idx-variable-device_id');
        $this->dropIndex('idx-variable-type_id');
        $this->dropIndex('idx-app_projects-project_id');
        $this->dropIndex('idx-app_projects-app_id');

        $this->dropForeignKey('fk-data-device_id');
        $this->dropForeignKey('fk-project-device_id');
        $this->dropForeignKey('fk-device-type_id');
        $this->dropForeignKey('fk-properties-device_id');
        $this->dropForeignKey('fk-properties-type_id');
        $this->dropForeignKey('fk-tag-device_id');
        $this->dropForeignKey('fk-variable-device_id');
        $this->dropForeignKey('fk-variable-type_id');
        $this->dropForeignKey('fk-app_projects-project_id');
        $this->dropForeignKey('fk-app_projects-app_id');

        $this->dropTable('data');
        $this->dropTable('device');
        $this->dropTable('tag');
        $this->dropTable('type');
        $this->dropTable('properties');
        $this->dropTable('variable');
        $this->dropTable('app');
        $this->dropTable('project');
        $this->dropTable('app_projects');
        $this->dropTable('device_tags');

    }
}
