<?php

use yii\db\Migration;

/**
 * Handles the creation of table `DT_USERS`.
 */
class m170311_172546_create_DT_USERS_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('DT_USERS', [
            'USER_ID' => $this->primaryKey(11),
            'ACTOR_ID' => $this->integer(11)->notNull(),
            'PF_NO' => $this->string(10)->notNull(),
            'ROLE' => $this->string(50)->notNull(),
            'EMAIL_ADDRESS' => $this->string(50)
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('DT_USERS');
    }
}
