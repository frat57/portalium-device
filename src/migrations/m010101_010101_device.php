<?php

use yii\db\Migration;

class m010101_010101_device extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_turkish_ci ENGINE=InnoDB';
        }

        $this->createTable('app', [
            'id' => $this->primaryKey(),
            'name' => $this->string(20)->notNull(),
            'user_id' => $this->integer(11)->notNull(),
        ], $tableOptions);

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_turkish_ci ENGINE=InnoDB';
        }

        $this->createTable('app_projects', [
            'project_id' => $this->integer(11),
            'app_id' => $this->integer(11),
            'user_id' => $this->integer(11),
        ], $tableOptions);

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_turkish_ci ENGINE=InnoDB';
        }

        $this->createTable('device_tags', [
            'device_id' => $this->integer(11),
            'tag_id' => $this->integer(11),
        ], $tableOptions);

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_turkish_ci ENGINE=InnoDB';
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
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_turkish_ci ENGINE=InnoDB';
        }

        $this->createTable('project', [
            'id' => $this->primaryKey(),
            'name' => $this->string(20)->notNull(),
            'app_config' => $this->text(),
            'user_id' => $this->integer(11)->notNull()
        ], $tableOptions);

        $tableoptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_turkish_ci ENGINE=InnoDB';
        }
        $this->createTable('data', [
            'value' => $this->text(),
            'created_at' => $this->timestamp(),
            'variable_id' => $this->integer(11)
        ], $tableOptions);

        $tableoptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_turkish_ci ENGINE=InnoDB';
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
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_turkish_ci ENGINE=InnoDB';
        }

        $this->createTable('tag', [
            'device_id' => $this->integer(11),
            'name' => $this->string(20)->notNull(),
            'frequency' => $this->string(20),
        ], $tableOptions);

        $tableoptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_turkish_ci ENGINE=InnoDB';
        }
        $this->createTable('type', [
            'id' => $this->primaryKey(),
            'name' => $this->string(20),
            'api' => $this->string(20),
            'description' => $this->text(),
        ], $tableOptions);

        $tableoptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_turkish_ci ENGINE=InnoDB';
        }
        $this->createTable('variable', [
            'id' => $this->primaryKey(),
            'name' => $this->string(20),
            'api' => $this->string(20),
            'description' => $this->text(),
            'range' => $this->integer(11),
            'type' => $this->tinyInteger(1),
            'unit' => $this->text(),
            'device_id' => $this->integer(11)->null()->defaultValue(0),
            'type_id' => $this->integer(11)->null()->defaultValue(0),
        ], $tableOptions);

        $this->createIndex(
            'idx-project-user_id',
            'project',
            'user_id'
        );
        $this->addForeignKey(
            'fk-project-user_id',
            'project',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
        $this->createIndex(
            'idx-data-variable_id',
            'data',
            'variable_id'
        );
        $this->addForeignKey(
            'fk-data-variable_id',
            'data',
            'variable_id',
            'variable',
            'id',
            'CASCADE'
        );
        $this->createIndex(
            'idx-app_projects-user_id',
            'app_projects',
            'user_id'
        );
        $this->addForeignKey(
            'fk-app_projects-user_id',
            'app_projects',
            'user_id',
            'user',
            'id'
        );
        $this->createIndex(
            'idx-app-user_id',
            'app',
            'user_id'
        );
        $this->addForeignKey(
            'fk-app-user_id',
            'app',
            'user_id',
            'user',
            'id'
        );
        $this->createIndex(
            'idx-device_tags-tag_id',
            'device_tags',
            'tag_id'
        );
        $this->addForeignKey(
            'fk-device_tags-tag_id',
            'device_tags',
            'tag_id',
            'tag',
            'id',
            'CASCADE'
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
            'id',
            'CASCADE'
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
            'id',
            'CASCADE'
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
            'id',
            'CASCADE'
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
            'id',
            'CASCADE'
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
            'id',
            'CASCADE'
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
            'id',
            'CASCADE'
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
            'id',

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
        $this->dropIndex('idx-project-device_id');
        $this->dropIndex('idx-device-type_id');
        $this->dropIndex('idx-properties-device_id');
        $this->dropIndex('idx-properties-type_id');
        $this->dropIndex('idx-tag-device_id');
        $this->dropIndex('idx-variable-device_id');
        $this->dropIndex('idx-variable-type_id');
        $this->dropIndex('idx-app_projects-project_id');
        $this->dropIndex('idx-app_projects-app_id');
        $this->dropIndex('idx-project-user_id');
        $this->dropIndex('idx-data-variable_id');
        $this->dropIndex('idx-app_projects-user_id');
        $this->dropIndex('idx-app-user_id');

        $this->dropForeignKey('fk-project-device_id');
        $this->dropForeignKey('fk-device-type_id');
        $this->dropForeignKey('fk-properties-device_id');
        $this->dropForeignKey('fk-properties-type_id');
        $this->dropForeignKey('fk-tag-device_id');
        $this->dropForeignKey('fk-variable-device_id');
        $this->dropForeignKey('fk-variable-type_id');
        $this->dropForeignKey('fk-app_projects-project_id');
        $this->dropForeignKey('fk-app_projects-app_id');
        $this->dropForeignKey('fk-project-user_id');
        $this->dropForeignKey('fk-data-variable_id');
        $this->dropForeignKey('fk-app_projects-user_id');
        $this->dropForeignKey('fk-app-user_id');

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
