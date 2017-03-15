<?php

use yii\db\Migration;

/**
 * Handles the creation of table `DT_NOTIFICATIONS`.
 */
class m170311_172905_create_DT_NOTIFICATIONS_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        /* NOTIFICATION TABLE */
        $this->createTable('DT_NOTIFICATIONS', [
            'NOTIFICATION_ID' => $this->primaryKey(11),
            'NOTIFICATION_TYPE_ID' => $this->integer(11)->notNull(),
            'RECIPIENT' => $this->string('30')->notNull(),
            'MESSAGE_TYPE' => $this->string(10)->notNull()->comment('COULD BE SMS , EMAIL OR WHATEVER'),
            'STATUS' => $this->integer(1)->defaultValue(0)->comment('SENT 1 NOT SENT 0 2 DELETED'),
            'DATE_ADDED' => $this->dateTime(),
            'DATE_SENT' => $this->dateTime()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('DT_NOTIFICATIONS');
    }
}
