<?php

use yii\db\Migration;

/**
 * Handles the creation of table `DT_STUDENT_INCIDENCES`.
 */
class m170311_172710_create_DT_STUDENT_INCIDENCES_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('DT_STUDENT_INCIDENCES', [
            'STUDENT_INCIDENCE_ID' => $this->primaryKey(11),
            'CASE_TYPE_ID' => $this->integer(11)->notNull(),
            'INCIDENCE_ID' => $this->integer(11)->notNull(),
            'DATE_ADDED'=>$this->dateTime()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('DT_STUDENT_INCIDENCES');
    }
}
