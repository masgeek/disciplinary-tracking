<?php

use yii\db\Migration;

class m170311_173047_create_foreign_keys extends Migration
{
    public function up()
    {
        //foreign keys
        /* Actors table*/
        $this->addForeignKey('FK_OFFICE_ACTOR_ID', 'DT_USERS', 'OFFICE_ACTOR_ID', 'DT_OFFICE_ACTORS', 'OFFICE_ACTOR_ID');

        /* Porcess actors table */
        $this->addForeignKey('FK_PROCESS_ACTOR_ID', 'DT_PROCESS_ACTORS', 'OFFICE_ACTOR_ID', 'DT_OFFICE_ACTORS', 'OFFICE_ACTOR_ID');
        $this->addForeignKey('FK_PROCESS_ID', 'DT_PROCESS_ACTORS', 'PROCESS_ID', 'DT_PROCESS', 'PROCESS_ID');

        /* discplinary types */
        $this->addForeignKey('FK_DISCIPLINARY_TYPE_ID', 'DT_DISCIPLINARY_CASE_TYPES', 'DISCIPLINARY_TYPE_ID', 'DT_DISCIPLINARY_TYPE', 'DISCIPLINARY_TYPE_ID');
        //$this->addForeignKey('FK_CASE_INCIDENCES_DISC', 'DT_CASE_INCIDENCES', 'DISCIPLINARY_TYPE_ID', 'DT_DISCIPLINARY_TYPE', 'DISCIPLINARY_TYPE_ID');
        //$this->addForeignKey('FK_STUDENT_REG_NO', 'DT_CASE_INCIDENCES', 'STUDENT_REG_NO', 'UON_STUDENTS', 'STUDENT_REG_NO');
        $this->addForeignKey('FK_STATUS_CODE_INC', 'DT_CASE_INCIDENCES', 'STATUS_CODE', 'STUDENTS_STATUS', 'STATUS_CODE');

        $this->addForeignKey('FK_PROCESS_CASE_TYPE_ID', 'DT_PROCESS', 'CASE_TYPE_ID', 'DT_DISCIPLINARY_CASE_TYPES', 'CASE_TYPE_ID');

        /* Incidences */
        $this->addForeignKey('FK_STUDENT_INCIDENCE', 'DT_STUDENT_INCIDENCES', 'CASE_TYPE_ID', 'DT_DISCIPLINARY_CASE_TYPES', 'CASE_TYPE_ID');
        $this->addForeignKey('FK_STUD_CASE_TYPE', 'DT_STUDENT_INCIDENCES', 'INCIDENCE_ID', 'DT_CASE_INCIDENCES', 'INCIDENCE_ID');


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

        $this->addCommentOnTable('DT_OFFICE_ACTORS', 'Hold the actors/offices that will be performing the various functions');
        $this->addCommentOnTable('DT_USERS', 'Hold the individual users');
        $this->addCommentOnTable('DT_PROCESS', 'Hold teh processes involved in each case, lookup table');
        $this->addCommentOnTable('DT_DISCIPLINARY_TYPE', 'Hold the types of disciplinary types i.e exam, staff');
        $this->addCommentOnTable('DT_DISCIPLINARY_CASE_TYPES', 'Hold the case types, subsets of the disciplinary types');
        $this->addCommentOnTable('DT_FILE_UPLOAD', 'For storing the uploaded files');
        $this->addCommentOnTable('DT_CASE_INCIDENCES', 'Individual case reports for each student');
        $this->addCommentOnTable('DT_PROCESS_ACTORS', 'Actors tasked with each process');
        $this->addCommentOnTable('DT_TRACKING_DATES', 'Holds the tracking dates and helps inscheduling');
        $this->addCommentOnTable('DT_NOTIFICATIONS', 'Hold the notifications i.e messages');
        $this->addCommentOnTable('DT_NOTIFICATION_TYPES', 'Holds the types of notifications');
        $this->addCommentOnTable('DT_RECIPIENT_TYPES', 'Hold the type of recipients');
        $this->addCommentOnTable('DT_STUDENT_INCIDENCES', 'Hold the incidences per student');

        return true;
    }

    public function down()
    {
        /* drop foreign key references first before dropping the table*/
        $this->dropForeignKey('FK_OFFICE_ACTOR_ID', 'DT_USERS');
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

        return true;
    }
}
