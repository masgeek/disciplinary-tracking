<?php
/**
 * Created by PhpStorm.
 * User: barsa
 * Date: 31-May-17
 * Time: 11:49
 */

namespace app\components;


class TABLES
{
    public static function GET_TABLES()
    {
        $tables = [
            'DT_CASE_INCIDENCES' => 'INCIDENCE_ID',
            'DT_CASE_TRACKING' => 'CASE_TRACKING_ID',
            'DT_DISCIPLINARY_CASE_TYPES' => 'CASE_TYPE_ID',
            'DT_DISCIPLINARY_TYPE' => 'DISCIPLINARY_TYPE_ID',
            'DT_FILE_UPLOAD' => 'FILE_UPLOAD_ID',
            'DT_NOTIFICATIONS' => 'NOTIFICATION_ID',
            'DT_NOTIFICATION_TYPES' => 'NOTIFICATION_TYPE_ID',
            'DT_OFFICE_ACTORS' => 'OFFICE_ACTOR_ID',
            'DT_PROCESS' => 'PROCESS_ID',
            'DT_PROCESS_ACTORS' => 'PROCESS_ACTOR_ID',
            'DT_RECIPIENT_TYPES' => 'RECIPIENT_TYPE_ID',
            'DT_STUDENT_INCIDENCES' => 'STUDENT_INCIDENCE_ID',
            'DT_TRACKING' => 'TRACKING_ID',
            'DT_TRACKING_DATES' => 'TRACKING_DATE_ID',
            'DT_USERS' => 'USER_ID',
            'DT_YII_SESSION' => 'id',
            'DT_audit_data' => 'id',
            'DT_audit_entry' => 'id',
            'DT_audit_error' => 'id',
            'DT_audit_javascript' => 'id',
            'DT_audit_mail' => 'id',
            'DT_audit_trail' => 'id'
        ];

        return $tables;

    }
}