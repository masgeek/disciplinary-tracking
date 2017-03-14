<?php

use yii\db\Migration;

/**
 * Handles the creation of table `DT_NOTIFICATION_TYPES`.
 */
class m170311_172919_create_DT_NOTIFICATION_TYPES_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {

        $this->createTable('DT_NOTIFICATION_TYPES', [
            'NOTIFICATION_TYPE_ID' => $this->primaryKey(11),
            'RECIPIENT_TYPE_ID' => $this->integer(11),
            'NOTIFICATION_NAME' => $this->string(8)->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('DT_NOTIFICATION_TYPES');
    }
}
