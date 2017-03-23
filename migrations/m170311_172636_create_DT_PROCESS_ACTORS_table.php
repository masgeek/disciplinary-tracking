<?php

use yii\db\Migration;

/**
 * Handles the creation of table `DT_PROCESS_ACTORS`.
 */
class m170311_172636_create_DT_PROCESS_ACTORS_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('DT_PROCESS_ACTORS', [
            'PROCESS_ACTOR_ID' => $this->primaryKey(11),
            'OFFICE_ACTOR_ID' => $this->integer(11),
            'PROCESS_ID' => $this->integer(11)
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('DT_PROCESS_ACTORS');
    }
}
