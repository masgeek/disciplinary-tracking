<?php

use yii\db\Migration;

/**
 * Handles the creation of table `DT_RECIPIENT_TYPES`.
 */
class m170311_172930_create_DT_RECIPIENT_TYPES_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('DT_RECIPIENT_TYPES', [
            'RECIPIENT_TYPE_ID' => $this->primaryKey(11),
            'RECIPIENT_TYPE_NAME' => $this->string(15)->notNull(),
        ]);

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('DT_RECIPIENT_TYPES');
    }
}
