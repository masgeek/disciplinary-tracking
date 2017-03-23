<?php

use yii\db\Migration;

/**
 * Handles the creation of table `DT_TRACKING_DATES`.
 */
class m170311_172854_create_DT_TRACKING_DATES_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('DT_TRACKING_DATES', [
            'TRACKING_DATE_ID' => $this->primaryKey(11),
            'TRACKING_ID' => $this->integer(11),
            'EVENT_DATE' => $this->dateTime()->notNull(),
            'COMMENTS' => $this->string(500)->notNull(),
            'STATUS' => $this->integer(2)->defaultValue(1)->notNull(),
            'DATE_ADDED' => $this->dateTime(),
            'DATE_MODIFIED' => $this->dateTime()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('DT_TRACKING_DATES');
    }
}
