<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use yii\console\Controller;
use Yii;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class OracleController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     */
    public function actionIndex($message = 'hello Oracle, this is neo')
    {
        echo $message . "\n";
    }

    /**
     * @inheritdoc
     * @param string $action
     */
    public function actionSequence($action = "create")
    {
        $tables = Yii::$app->db->schema->getTableSchemas();
        foreach ($tables as $table) {
            $pk_col = $table->primaryKey[0];
            $table_name = $table->name;
            //$col = $table;
            if (strpos($table_name, 'DT_') === 0) { //only process tables with the DT_ prefix
                if ($action == 'drop') {
                    echo $this->DropSequences($table_name, $pk_col) . "\n";
                } else {
                    echo $this->BuildSequences($table_name, $pk_col) . "\n";
                }
            }

        }
    }


    /**
     * @inheritdoc
     * @param string $action
     */
    public function actionTrigger($action = "create")
    {
        $tables = Yii::$app->db->schema->getTableSchemas();
        foreach ($tables as $table) {
            $pk_col = $table->primaryKey[0];
            $table_name = $table->name;
            //$col = $table;
            if (strpos($table_name, 'DT_') === 0) {
                if ($action == 'drop') {
                    echo $this->DropTrigger($table_name, $pk_col) . "\n";
                } else {
                    echo $this->BuildTrigger($table_name, $pk_col) . "\n";
                }
            }

        }
    }

    private function DropSequences($table_name, $pk_column, $schema_name = 'MUTHONI')
    {
        $message = 'Failed';
        $sequence_name = strtoupper($table_name . '_SEQ');
        $seq_resp = 1;
        $notification_seq = <<<TRIGGER
   DROP SEQUENCE  "$schema_name"."$sequence_name"
TRIGGER;


        $seq_resp = Yii::$app->db->createCommand($notification_seq)->execute();
        if ($seq_resp == 0) {
            $message = "Successfully dropped sequence for table $table_name";
        } else {
            $message = "Failed to drop sequence for table $table_name";
        }

        return $message;
    }

    private function DropTrigger($table_name, $pk_column, $schema_name = 'MUTHONI')
    {
        $trigger_name = strtoupper($table_name . '_TRG');

        $notification_seq_trigger = <<<SQL
DROP TRIGGER $trigger_name
SQL;
        $trigger_resp = Yii::$app->db->createCommand($notification_seq_trigger)->execute();
        if ($trigger_resp == 0) {
            $message = "Successfully dropped trigger for table $table_name";
        } else {
            $message = "Failed to drop trigger for table $table_name";
        }

        return $message;
    }

    private function BuildSequences($table_name, $pk_column, $schema_name = 'MUTHONI')
    {
        $sequence_name = strtoupper($table_name . '_SEQ');

        $notification_seq = <<<SEQUENCE
   CREATE SEQUENCE  "$schema_name"."$sequence_name"  MINVALUE 1 MAXVALUE 9999999999999999999999999999 INCREMENT BY 1 START WITH 1 CACHE 20 NOORDER  NOCYCLE
SEQUENCE;

        $seq_resp = Yii::$app->db->createCommand($notification_seq)->execute();
        if ($seq_resp == 0) {
            $message = "Successfully created sequence for table $table_name";
        } else {
            $message = "Failed to create sequence for table $table_name";
        }

        return $message;
    }

    private function BuildTrigger($table_name, $pk_column)
    {
        $trigger_name = strtoupper($table_name . '_TRG');
        $sequence_name = strtoupper($table_name . '_SEQ');

        $notification_seq_trigger = <<<SQL
CREATE OR REPLACE TRIGGER $trigger_name
BEFORE INSERT ON $table_name FOR EACH ROW
BEGIN
 SELECT $sequence_name.NEXTVAL INTO :NEW.$pk_column FROM SYS.DUAL;
END;
SQL;


        $message = "Successfully created sequence for table $table_name";
        $trigger_resp = Yii::$app->db->createCommand($notification_seq_trigger)->execute();
        if ($trigger_resp == 0) {
            $message = "Successfully created trigger for table $table_name";
        } else {
            $message = "Failed to create trigger for table $table_name";
        }

        return $message;
    }
}
