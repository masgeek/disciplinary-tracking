<?php

use yii\db\Migration;
use yii\db\Schema;

class m170311_175860_create_audit_entry extends Migration
{
    const TABLE = '{{%audit_entry}}';

    public function up()
    {
        $this->createTable(self::TABLE, [
            'id'                => Schema::TYPE_PK,
            'created'           => $this->dateTime()->notNull(),
            'user_id'           => Schema::TYPE_INTEGER . ' DEFAULT 0',
            'duration'          => Schema::TYPE_FLOAT . ' NULL',
            'ip'                => Schema::TYPE_STRING . '(45) NULL',
            'request_method'    => Schema::TYPE_STRING . '(16) NULL',
            'ajax'              => Schema::TYPE_INTEGER . '(1) DEFAULT 0 NOT NULL',
            'route'             => Schema::TYPE_STRING . '(255) NULL',
            'memory_max'        => Schema::TYPE_INTEGER . ' NULL',
        ], ($this->db->driverName === 'mysql' ? 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB' : null));

        $this->createIndex('idx_user_id', self::TABLE, ['user_id']);
        $this->createIndex('idx_route', self::TABLE, ['route']);
    }

    public function down()
    {
        $this->dropTable(self::TABLE);
    }
}
