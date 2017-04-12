<?php

use yii\db\Migration;

/**
 * Handles the creation of table `DT_YII_SESSION`.
 */
class m170412_111200_create_DT_YIISESSION_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('DT_YII_SESSION', [
            'id' => $this->string(70)->notNull(),//$this->primaryKey(),
            'expire'=>$this->integer(30),
            'data'=>$this->text()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('DT_YII_SESSION');
    }
}
