<?php

use yii\db\Migration;

/**
 * Handles the creation of table `DT_YII_SESSION`.
 */
class m170412_111200_create_DT_YIISESSION_table extends Migration
{
    public $table_name = 'DT_YII_SESSION';

    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable($this->table_name, [
            'id' => $this->string(70)->notNull(),//$this->primaryKey(),
            'user_id' => $this->string(15),
            'expire' => $this->integer(30),
            'data' => $this->text(),
            'ip' => $this->string(15),
            'is_trusted' => $this->integer(1)
        ]);

        $this->addPrimaryKey('id_pk', $this->table_name, 'id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable($this->table_name);
    }
}
