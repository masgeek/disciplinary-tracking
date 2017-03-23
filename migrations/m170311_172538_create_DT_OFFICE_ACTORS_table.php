<?php

use yii\db\Migration;

/**
 * Handles the creation of table `DT_ACTORS`.
 */
class m170311_172538_create_DT_OFFICE_ACTORS_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('DT_OFFICE_ACTORS', [
            'OFFICE_ACTOR_ID' => $this->primaryKey(11),
            'ACTOR_NAME' => $this->string(50)->notNull(),
            'EMAIL_ADDRESS' => $this->string(50)->notNull(),
            'ACTIVE' => $this->integer(1)->defaultValue(1)
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('DT_OFFICE_ACTORS');
    }
}
