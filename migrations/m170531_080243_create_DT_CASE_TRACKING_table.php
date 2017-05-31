<?php

use yii\db\Migration;

/**
 * Handles the creation of table `DT_CASE_TRACKING`.
 */
class m170531_080243_create_DT_CASE_TRACKING_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('DT_CASE_TRACKING', [
            'CASE_TRACKING_ID' => $this->primaryKey(11),
            'INCIDENCE_ID' => $this->integer(11)->notNull(),
            'CASE_IN_COURT' => $this->integer(1)->notNull()->defaultValue(0),
            'CASE_VERDICT'=>$this->string(20)->notNull()->defaultValue('IN PROGRESS'),
            'ACTION_BY'=>$this->string(10)->notNull(),
            'DATE_ADDED'=>$this->dateTime()
        ]);

        //table comments
        $this->addCommentOnTable('DT_CASE_TRACKING', 'Hold the tracking changes of a case and verdicts');
        //next create the foreign keys
        $this->addForeignKey('FK_CASE_TRACKING_INCIDENCE', 'DT_CASE_TRACKING', 'INCIDENCE_ID', 'DT_CASE_INCIDENCES', 'INCIDENCE_ID');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('FK_CASE_TRACKING_INCIDENCE', 'DT_CASE_TRACKING');

        $this->dropTable('DT_CASE_TRACKING');
    }
}
