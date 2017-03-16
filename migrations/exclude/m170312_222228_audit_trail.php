<?php

use yii\db\Schema;
use yii\db\Migration;

class m170312_222228_audit_trail extends Migration
{
    public $table = 'DT_AUDIT_TRAIL';

    public function safeUp()
    {

        //Create our first version of the audittrail table
        //Please note that this matches the original creation of the
        //table from version 1 of the extension. Other migrations will
        //upgrade it from here if we ever need to. This was done so
        //that older versions can still use migrate functionality to upgrade.
        $this->createTable(
            $this->table,
            [
                //'id' => $this->integer(),
                'old_value' => $this->text(),
                'new_value' => $this->text(),
                'action' => $this->string()->notNull(),
                'model' => $this->string()->notNull(),
                'field' => $this->string()->defaultValue('NA'),
                'stamp' => $this->string(20)->notNull(),
                'user_id' => $this->integer(11),
                'model_id' => $this->string()->notNull(),
            ]
        );

        $this->addForeignKey('fk_trail_id', $this->table, 'user_id', 'DT_USERS', 'USER_ID');

        //Index these bad boys for speedy lookups
        $this->createIndex('idx_audit_trail_user_id', $this->table, 'user_id');
        $this->createIndex('idx_audit_trail_model_id', $this->table, 'model_id');
        $this->createIndex('idx_audit_trail_model', $this->table, 'model');
        $this->createIndex('idx_audit_trail_field', $this->table, 'field');
        $this->createIndex('idx_audit_trail_action', $this->table, 'action');
    }

    public function safeDown()
    {
        $this->dropTable($this->table);
    }

    // Use safeUp/safeDown to run migration code within a transaction
    /*public function safeUp()
    {
        $this->up();
    }

    public function safeDown()
    {
        $this->down();
    }*/
}
