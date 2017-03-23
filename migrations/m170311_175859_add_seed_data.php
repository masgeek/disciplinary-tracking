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
            'DISCIPLINARY_TYPE_NAME' => 'EXAMINATION',
        ]);

        $this->insert('DT_DISCIPLINARY_CASE_TYPES', [
            'CASE_TYPE_ID' => 1,
            'DISCIPLINARY_TYPE_ID' => 1,
            'CASE_TYPE_NAME' => 'EXAM CHEATING',
        ]);
        $this->insert('DT_DISCIPLINARY_CASE_TYPES', [
            'CASE_TYPE_ID' => 2,
            'DISCIPLINARY_TYPE_ID' => 1,
            'CASE_TYPE_NAME' => 'EXAM APPEAL',
        ]);

        $this->insert('DT_OFFICE_ACTORS', [
            'OFFICE_ACTOR_ID' => 1,
            'ACTOR_NAME' => 'Exam Office',
            'EMAIL_ADDRESS' => 'smbarasa@uonbi.ac.ke',
            'ACTIVE' => 1,
        ]);

        $this->insert('DT_USERS', [
            'USER_ID' => 100,
            'OFFICE_ACTOR_ID' => 1,
            'PF_NO' => '219350',
            'ROLE' => 'APPROVE',
            'EMAIL_ADDRESS' => 'smbarasa@uonbi.ac.ke',
        ]);
        //create incidence types

        return true;
    }

    public function down()
    {
        return true;
    }

}
