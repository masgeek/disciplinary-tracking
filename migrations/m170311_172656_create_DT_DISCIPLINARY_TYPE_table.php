<?php

use yii\db\Migration;

/**
 * Handles the creation of table `DT_DISCIPLINARY_TYPE`.
 */
class m170311_172656_create_DT_DISCIPLINARY_TYPE_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('DT_DISCIPLINARY_TYPE', [
            'DISCIPLINARY_TYPE_ID' => $this->primaryKey(11),
            'DISCIPLINARY_TYPE_NAME' => $this->string(200)->notNull()]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('DT_DISCIPLINARY_TYPE');
    }
}
