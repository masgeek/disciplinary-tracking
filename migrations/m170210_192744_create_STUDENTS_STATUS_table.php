<?php

use yii\db\Migration;

/**
 * Handles the creation of table `STUDENTS_STATUS`.
 */
class m170210_192744_create_STUDENTS_STATUS_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        return true;
        $this->createTable('STUDENTS_STATUS', [
            //'ID' => $this->primaryKey(),
            'STATUS_CODE' => $this->string(8),
            'STATUS_NAME' => $this->string()->notNull(),
        ]);

        //$this->createIndex('STATUS_CODE_IDX', 'STUDENTS_STATUS', 'STATUS_CODE', true);
        $this->addPrimaryKey('STATUS_CODE_PK','STUDENTS_STATUS','STATUS_CODE');
        //add data
        $this->insert('STUDENTS_STATUS', [
           // 'ID' => 1,
            'STATUS_CODE' => '001',
            'STATUS_NAME' => 'ACTIVE'
        ]);
        $this->insert('STUDENTS_STATUS', [
            //'ID' => 2,
            'STATUS_CODE' => '002',
            'STATUS_NAME' => 'SUSPENDED'
        ]);
        $this->insert('STUDENTS_STATUS', [
            //'ID' => 3,
            'STATUS_CODE' => '003',
            'STATUS_NAME' => 'EXPELLED'
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        return true;
        $this->dropTable('STUDENTS_STATUS');
    }
}
