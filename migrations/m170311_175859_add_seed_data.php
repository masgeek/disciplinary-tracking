<?php

use yii\db\Migration;

class m170311_175859_add_seed_data extends Migration
{

    // Use safeUp/safeDown to run migration code within a transaction
    public function up()
    {

        /**
         * Add sample or ready made data
         */
        $this->insert('DT_RECIPIENT_TYPES', [
            'RECIPIENT_TYPE_ID' => 1,
            'RECIPIENT_TYPE_NAME' => 'SMS',
        ]);

        $this->insert('DT_NOTIFICATION_TYPES', [
            'NOTIFICATION_TYPE_ID' => 1,
            'NOTIFICATION_NAME' => 'SMS',
            'RECIPIENT_TYPE_ID' => '1',
        ]);

        $this->insert('DT_DISCIPLINARY_TYPE', [
            'DISCIPLINARY_TYPE_ID' => 1,
            'DISCIPLINARY_TYPE_NAME' => 'Exam Disciplinary',
        ]);

        $this->insert('DT_DISCIPLINARY_CASE_TYPES', [
            'CASE_TYPE_ID' => 1,
            'DISCIPLINARY_TYPE_ID' => 1,
            'CASE_TYPE_NAME' => 'Exam Cheating',
        ]);
        $this->insert('DT_DISCIPLINARY_CASE_TYPES', [
            'CASE_TYPE_ID' => 2,
            'DISCIPLINARY_TYPE_ID' => 1,
            'CASE_TYPE_NAME' => 'Exam Appeal',
        ]);

        //create incidence types

        return true;
    }

    public function down()
    {
        return true;
    }

}
