<?php

use yii\db\Migration;

/**
 * Handles the creation of table `DT_CASE_INCIDENCES`.
 */
class m170311_172722_create_DT_CASE_INCIDENCES_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('DT_CASE_INCIDENCES', [
            'INCIDENCE_ID' => $this->primaryKey(11),
            //'DISCIPLINARY_TYPE_ID' => $this->integer(11),
            'STUDENT_REG_NO' => $this->string(20)->notNull(),
            'CASE_DESCRIPTION' => $this->string(500)->notNull(),
            'STATUS_CODE' => $this->string(8)->notNull(),
            'REPORTED_BY' => $this->string(20)->notNull(),
            'FACULTY_CODE' => $this->string(20)->notNull(),
            'COLLEGE_CODE' => $this->string(20)->notNull(),
            'DATE_REPORTED' => $this->dateTime()->notNull(),
            'DATE_ADDED' => $this->dateTime()->notNull()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('DT_CASE_INCIDENCES');
    }
}
