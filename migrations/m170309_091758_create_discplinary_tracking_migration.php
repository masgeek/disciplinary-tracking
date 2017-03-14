<?php

use yii\db\Migration;

class m170309_091758_create_discplinary_tracking_migration extends Migration
{
    public function up()
    {

        return true;
        $this->createTable('DT_ACTORS', [
            'ACTOR_ID' => $this->primaryKey(11),
            'ACTOR_NAME' => $this->string(50)->notNull(),
            'EMAIL_ADDRESS' => $this->string(50)->notNull(),
            'ACTIVE' => $this->integer(1)->defaultValue(1)
        ]);

        $this->createTable('DT_USERS', [
            'USER_ID' => $this->primaryKey(11),
            'ACTOR_ID' => $this->integer(11),
            'PF_NO' => $this->string(10)->notNull(),
            'ROLE' => $this->string(50)->notNull(),
            'EMAIL_ADDRESS' => $this->string(50)
        ]);


        $this->createTable('DT_PROCESS', [
            'PROCESS_ID' => $this->primaryKey(11),
            'CASE_TYPE_ID' => $this->integer(11)->notNull(),
            'PROCESS_NAME' => $this->string(200)->notNull(),
            'DESCRIPTION' => $this->string(500),
            'ORDER_NO' => $this->integer(2)->notNull()
        ]);

        $this->createTable('DT_PROCESS_ACTORS', [
            'PROCESS_ACTOR_ID' => $this->primaryKey(11),
            'ACTOR_ID' => $this->integer(11),
            'PROCESS_ID' => $this->integer(11)
        ]);

        $this->createTable('DT_DISCIPLINARY_TYPE', [
            'DISCIPLINARY_TYPE_ID' => $this->primaryKey(11),
            'DISCIPLINARY_TYPE_NAME' => $this->string(200)->notNull()]);

        $this->createTable('DT_DISCIPLINARY_CASE_TYPES', [
            'CASE_TYPE_ID' => $this->primaryKey(11),
            'DISCIPLINARY_TYPE_ID' => $this->integer(11),
            'CASE_TYPE_NAME' => $this->string(200)->notNull()
        ]);

        $this->createTable('DT_STUDENT_INCIDENCES', [
            'STUDENT_INCIDENCE_ID' => $this->primaryKey(11),
            'CASE_TYPE_ID' => $this->integer(11),
            'INCIDENCE_ID' => $this->integer(11),
        ]);

        $this->createTable('DT_CASE_INCIDENCES', [
            'INCIDENCE_ID' => $this->primaryKey(11),
            //'DISCIPLINARY_TYPE_ID' => $this->integer(11),
            'STUDENT_REG_NO' => $this->string(20)->notNull(),
            'DATE_REPORTED' => $this->dateTime()->notNull(),
            'CASE_DESCRIPTION' => $this->string(500)->notNull(),
            'STATUS_CODE' => $this->string(8)->notNull(),
            'REPORTED_BY' => $this->string(20)->notNull()
        ]);

        $this->createTable('DT_TRACKING', [
            'TRACKING_ID' => $this->primaryKey(11),
            'INCIDENCE_ID' => $this->integer(11),
            'PROCESS_ID' => $this->integer(11),
            'COMMENTS' => $this->string(500),
            'DATE_RECEIVED' => $this->dateTime(),
            'TRACKING_STATUS' => $this->integer(),
        ]);

        $this->createTable('DT_FILE_UPLOAD', [
            'FILE_UPLOAD_ID' => $this->primaryKey(11),
            'INCIDENCE_ID' => $this->integer(11),
            'FILE_NAME' => $this->string(100)->notNull(),
            'FILE_PATH' => $this->string(200)->notNull(),
            'DATE_UPLOADED' => $this->dateTime()
        ]);

        $this->createTable('DT_TRACKING_DATES', [
            'TRACKING_DATE_ID' => $this->primaryKey(11),
            'TRACKING_ID' => $this->integer(11),
            'EVENT_DATE' => $this->dateTime()->notNull(),
            'COMMENTS' => $this->string(500)->notNull(),
            'STATUS' => $this->string(10)->defaultValue('ACTIVE')->notNull(),
            'DATE_ADDED' => $this->dateTime(),
            'DATE_MODIFIED' => $this->dateTime()
        ]);

        /* NOTIFICATION TABLE */
        $this->createTable('DT_NOTIFICATIONS', [
            'NOTIFICATION_ID' => $this->primaryKey(11),
            'NOTIFICATION_TYPE_ID' => $this->integer(11),
            'RECIPIENT' => $this->string('30')->notNull(),
            'MESSAGE_TYPE' => $this->string(10)->notNull()->comment('COULD BE SMS , EMAIL OR WHATEVER'),
            'STATUS' => $this->integer(1)->defaultValue(0)->comment('SENT 1 NOT SENT 0 2 DELETED'),
            'DATE_SENT' => $this->dateTime()
        ]);

        $this->createTable('DT_NOTIFICATION_TYPES', [
            'NOTIFICATION_TYPE_ID' => $this->primaryKey(11),
            'RECIPIENT_TYPE_ID' => $this->integer(11),
            'NOTIFICATION_NAME' => $this->string(8)->notNull(),
        ]);

        $this->createTable('DT_RECIPIENT_TYPES', [
            'RECIPIENT_TYPE_ID' => $this->primaryKey(11),
            'RECIPIENT_TYPE_NAME' => $this->string(15)->notNull(),
        ]);


        //foreign keys
        /* Actors table*/
        $this->addForeignKey('FK_ACTOR_ID', 'DT_USERS', 'ACTOR_ID', 'DT_ACTORS', 'ACTOR_ID');

        /* Porcess actors table */
        $this->addForeignKey('FK_PROCESS_ACTOR_ID', 'DT_PROCESS_ACTORS', 'ACTOR_ID', 'DT_ACTORS', 'ACTOR_ID');
        $this->addForeignKey('FK_PROCESS_ID', 'DT_PROCESS_ACTORS', 'PROCESS_ID', 'DT_PROCESS', 'PROCESS_ID');

        /* discplinary types */
        $this->addForeignKey('FK_DISCIPLINARY_TYPE_ID', 'DT_DISCIPLINARY_CASE_TYPES', 'DISCIPLINARY_TYPE_ID', 'DT_DISCIPLINARY_TYPE', 'DISCIPLINARY_TYPE_ID');
        //$this->addForeignKey('FK_CASE_INCIDENCES_DISC', 'DT_CASE_INCIDENCES', 'DISCIPLINARY_TYPE_ID', 'DT_DISCIPLINARY_TYPE', 'DISCIPLINARY_TYPE_ID');
        //$this->addForeignKey('FK_STUDENT_REG_NO', 'DT_CASE_INCIDENCES', 'STUDENT_REG_NO', 'UON_STUDENTS', 'STUDENT_REG_NO');
        $this->addForeignKey('FK_STATUS_CODE_INC', 'DT_CASE_INCIDENCES', 'STATUS_CODE', 'STUDENTS_STATUS', 'STATUS_CODE');

        $this->addForeignKey('FK_PROCESS_CASE_TYPE_ID', 'DT_PROCESS', 'CASE_TYPE_ID', 'DT_DISCIPLINARY_CASE_TYPES', 'CASE_TYPE_ID');

        /* Incidences */
        $this->addForeignKey('FK_STUD_CASE_TYPE', 'DT_STUDENT_INCIDENCES', 'CASE_TYPE_ID', 'DT_DISCIPLINARY_CASE_TYPES', 'CASE_TYPE_ID');
        $this->addForeignKey('FK_STUDENT_INCIDENCE_ID', 'DT_STUDENT_INCIDENCES', 'INCIDENCE_ID', 'DT_CASE_INCIDENCES', 'INCIDENCE_ID');


        /* individual incedences */
        $this->addForeignKey('FK_TRACKING_INCIDENCE', 'DT_TRACKING', 'INCIDENCE_ID', 'DT_CASE_INCIDENCES', 'INCIDENCE_ID');
        $this->addForeignKey('FK_TRACKING_PROCESS', 'DT_TRACKING', 'PROCESS_ID', 'DT_PROCESS', 'PROCESS_ID');

        /* Notifications */
        $this->addForeignKey('FK_RECIPIENT_TYPE', 'DT_NOTIFICATION_TYPES', 'RECIPIENT_TYPE_ID', 'DT_RECIPIENT_TYPES', 'RECIPIENT_TYPE_ID');
        $this->addForeignKey('FK_NOTIFICATION_TYPE', 'DT_NOTIFICATIONS', 'NOTIFICATION_TYPE_ID', 'DT_NOTIFICATION_TYPES', 'NOTIFICATION_TYPE_ID');

        /* Tracking dates*/
        $this->addForeignKey('FK_TRACKING_DATES', 'DT_TRACKING_DATES', 'TRACKING_ID', 'DT_TRACKING', 'TRACKING_ID');

        /* File Upload*/
        $this->addForeignKey('FK_FILE_UPLOAD', 'DT_FILE_UPLOAD', 'INCIDENCE_ID', 'DT_CASE_INCIDENCES', 'INCIDENCE_ID');


        /**
         * Add the table comments
         */

        $this->addCommentOnTable('DT_ACTORS', 'Hold the actors/offices that will be performing the various functions');
        $this->addCommentOnTable('DT_USERS', 'Hold the individual users');
        $this->addCommentOnTable('DT_PROCESS', 'Hold teh processes involved in each case, lookup table');
        $this->addCommentOnTable('DT_DISCIPLINARY_TYPE', 'Hold the types of disciplinary types i.e exam, staff');
        $this->addCommentOnTable('DT_DISCIPLINARY_CASE_TYPES', 'Hold the case types, subsets of the disciplinary types');
        $this->addCommentOnTable('DT_FILE_UPLOAD', 'For storing the uploaded files');
        $this->addCommentOnTable('DT_CASE_INCIDENCES', 'Individual case reports for each student');
        $this->addCommentOnTable('DT_PROCESS_ACTORS', 'Actors tasked with each process');
        $this->addCommentOnTable('DT_TRACKING_DATES', 'Holds the tracking dates and helps in scheduling');
        $this->addCommentOnTable('DT_NOTIFICATIONS', 'Hold the notifications i.e messages');
        $this->addCommentOnTable('DT_NOTIFICATION_TYPES', 'Holds the types of notifications');
        $this->addCommentOnTable('DT_RECIPIENT_TYPES', 'Hold the type of recipients');
        $this->addCommentOnTable('DT_STUDENT_INCIDENCES', 'Hold the incidences per student');
    }

    public function down()
    {
        return true;
        /* drop foreign key references first before dropping the table*/
        $this->dropForeignKey('FK_ACTOR_ID', 'DT_USERS');
        $this->dropForeignKey('FK_PROCESS_ACTOR_ID', 'DT_PROCESS_ACTORS');
        $this->dropForeignKey('FK_PROCESS_ID', 'DT_PROCESS_ACTORS');
        $this->dropForeignKey('FK_DISCIPLINARY_TYPE_ID', 'DT_DISCIPLINARY_CASE_TYPES');
        //$this->dropForeignKey('FK_CASE_INCIDENCES_DISC', 'DT_CASE_INCIDENCES');
        //$this->dropForeignKey('FK_STUDENT_REG_NO', 'DT_CASE_INCIDENCES'); /* throws invalid identifier error*/
        $this->dropForeignKey('FK_STATUS_CODE_INC', 'DT_CASE_INCIDENCES');
        $this->dropForeignKey('FK_PROCESS_CASE_TYPE_ID', 'DT_PROCESS');

        $this->dropForeignKey('FK_STUDENT_INCIDENCE', 'DT_STUDENT_INCIDENCES');
        $this->dropForeignKey('FK_STUD_CASE_TYPE', 'DT_STUDENT_INCIDENCES');

        $this->dropForeignKey('FK_TRACKING_INCIDENCE', 'DT_TRACKING');
        $this->dropForeignKey('FK_TRACKING_PROCESS', 'DT_TRACKING');

        $this->dropForeignKey('FK_RECIPIENT_TYPE', 'DT_NOTIFICATION_TYPES');
        $this->dropForeignKey('FK_NOTIFICATION_TYPE', 'DT_NOTIFICATIONS');

        $this->dropForeignKey('FK_TRACKING_DATES', 'DT_TRACKING_DATES');

        $this->dropForeignKey('FK_FILE_UPLOAD', 'DT_FILE_UPLOAD');

        /* Drop table after dropping references*/
        $this->dropTable('DT_ACTORS');
        $this->dropTable('DT_USERS');


        $this->dropTable('DT_PROCESS');
        $this->dropTable('DT_DISCIPLINARY_TYPE');
        $this->dropTable('DT_DISCIPLINARY_CASE_TYPES');
        $this->dropTable('DT_TRACKING');
        $this->dropTable('DT_FILE_UPLOAD');
        $this->dropTable('DT_STUDENT_INCIDENCES');
        $this->dropTable('DT_CASE_INCIDENCES');
        $this->dropTable('DT_PROCESS_ACTORS');
        $this->dropTable('DT_TRACKING_DATES');

        /* NOTIFICATION TABLE */
        $this->dropTable('DT_NOTIFICATIONS');
        $this->dropTable('DT_NOTIFICATION_TYPES');
        $this->dropTable('DT_RECIPIENT_TYPES');
    }
}
