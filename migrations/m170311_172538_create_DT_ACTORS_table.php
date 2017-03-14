<?php

use yii\db\Migration;

/**
 * Handles the creation of table `DT_ACTORS`.
 */
class m170311_172538_create_DT_ACTORS_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('DT_ACTORS', [
            'ACTOR_ID' => $this->primaryKey(11),
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
        $this->dropTable('DT_ACTORS');
    }
}
