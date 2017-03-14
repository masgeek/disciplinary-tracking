<?php

use yii\db\Migration;

/**
 * Handles the creation of table `DT_FILE_UPLOAD`.
 */
class m170311_172844_create_DT_FILE_UPLOAD_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('DT_FILE_UPLOAD', [
            'FILE_UPLOAD_ID' => $this->primaryKey(11),
            'INCIDENCE_ID' => $this->integer(11),
            'FILE_NAME' => $this->string(100)->notNull(),
            'FILE_PATH' => $this->string(200)->notNull(),
            'DATE_UPLOADED' => $this->dateTime()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('DT_FILE_UPLOAD');
    }
}
