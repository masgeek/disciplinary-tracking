<?php

use yii\db\Migration;
use yii\db\Schema;

class m170311_175862_create_audit_error extends Migration
{
    const TABLE = '{{%audit_error}}';

    public function up()
    {
        $driver = $this->db->driverName;
        $this->createTable(self::TABLE, [
            'id' => Schema::TYPE_PK,
            'entry_id' => $this->integer()->notNull(),
            'created' => $this->dateTime()->notNull(),
            'message' => $this->string(1000),
            'code' => $this->integer()->defaultValue(0),
            'file' => $this->string(512),
            'line' => $this->integer()->notNull(),
            'trace' => $this->binary(),
            'hash' => $this->string(32),
            'emailed' => $this->integer(1)->defaultValue(0)
        ], ($driver === 'mysql' ? 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB' : null));

        if ($driver != 'sqlite') {
            $this->addForeignKey('fk_audit_error_entry_id', self::TABLE, ['entry_id'], '{{%audit_entry}}', 'id');
        }

        // Issue #122: Specified key was too long; max key length is 767 bytes - http://stackoverflow.com/q/1814532/50158
        $this->createIndex('idx_file', self::TABLE, ['file' . ($driver === 'mysql' ? '(180)' : '')]);
        //$this->createIndex('idx_emailed', self::TABLE, ['emailed']);
    }

    public function down()
    {
        if ($this->db->driverName != 'sqlite') {
            $this->dropForeignKey('fk_audit_error_entry_id', self::TABLE);
        }
        $this->dropTable(self::TABLE);
    }
}
