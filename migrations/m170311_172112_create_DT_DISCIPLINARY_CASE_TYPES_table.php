<?php

use yii\db\Migration;

/**
 * Handles the creation of table `DT_DISCIPLINARY_CASE_TYPES`.
 */
class m170311_172112_create_DT_DISCIPLINARY_CASE_TYPES_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('DT_DISCIPLINARY_CASE_TYPES', [
            'CASE_TYPE_ID' => $this->primaryKey(11),
            'DISCIPLINARY_TYPE_ID' => $this->integer(11)->notNull(),
            'CASE_TYPE_NAME' => $this->string(200)->notNull()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('DT_DISCIPLINARY_CASE_TYPES');
    }
}
