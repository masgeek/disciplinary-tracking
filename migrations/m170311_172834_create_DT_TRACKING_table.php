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
            'INCIDENCE_ID' => $this->integer(11),
            'PROCESS_ID' => $this->integer(11),
            'COMMENTS' => $this->string(500),
            'DATE_RECEIVED' => $this->dateTime(),
            'TRACKING_STATUS' => $this->integer(),
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
