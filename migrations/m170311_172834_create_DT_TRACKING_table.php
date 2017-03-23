<?php

use yii\db\Migration;

/**
 * Handles the creation of table `DT_TRACKING`.
 */
class m170311_172834_create_DT_TRACKING_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('DT_TRACKING', [
            'TRACKING_ID' => $this->primaryKey(11),
            'INCIDENCE_ID' => $this->integer(11)->notNull(),
            'PROCESS_ID' => $this->integer(11)->notNull(),
            'COMMENTS' => $this->string(500),
            'TRACKING_STATUS' => $this->integer()->notNull(),
            'ADDED_BY' => $this->string(20)->notNull(),
            'ACTED_ON_BY' => $this->string(20),
            'DATE_RECEIVED' => $this->dateTime(),
            'DATE_UPDATED' => $this->dateTime(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('DT_TRACKING');
    }
}
