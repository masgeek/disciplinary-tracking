<?php

use yii\db\Migration;

/**
 * Handles the creation of table `DT_PROCESS`.
 */
class m170311_172555_create_DT_PROCESS_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {

        $this->createTable('DT_PROCESS', [
            'PROCESS_ID' => $this->primaryKey(11),
            'CASE_TYPE_ID' => $this->integer(11)->notNull(),
            'PROCESS_NAME' => $this->string(200)->notNull(),
            'DESCRIPTION' => $this->string(500),
            'ORDER_NO' => $this->integer(2)->notNull(),
            'DATE_ADDED' => $this->dateTime(),
            'DATE_MODIFIED' => $this->dateTime()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('DT_PROCESS');
    }
}
