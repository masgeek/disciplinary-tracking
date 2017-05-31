<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use app\components\TABLES;
use DoctrineTest\InstantiatorTestAsset\ExceptionAsset;
use yii\console\Controller;
use Yii;
use yii\db\Exception;

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
     * @param string $action the action to be performed
     */
    public function actionIndex($action = "none")
    {
        echo "Running command for $action \n";
        $tables = $this->GetTables('DT_');

        if (count($tables) <= 0) {
            echo count($tables) . " tables found \n";
        } else {
            foreach ($tables as $table => $PK) {
                $pk = $PK[0];
                if ($action == 'drop') {
                    $this->DropTrigger($table, $pk);
                    $this->DropSequences($table, $pk);

                } elseif ($action == 'create') {
                    $this->BuildSequences($table, $pk);

                    $this->BuildTrigger($table, $pk);
                } else {
                    echo "Invalid action '$action' please try 'create' or 'drop' \n";
                    //echo "'$table'=>'$pk', \n";
                    break;
                }
            }
        }
        echo "Finished Running command for $action \n";
    }

    public function actionBatch($action)
    {
        $tables = TABLES::GET_TABLES();

        foreach ($tables as $table_name => $pk_column) {

            if ($action == 'drop') {
                $this->DropTrigger($table_name, $pk_column);
                $this->DropSequences($table_name, $pk_column);

            } elseif ($action == 'create') {
                $this->BuildSequences($table_name, $pk_column);

                $this->BuildTrigger($table_name, $pk_column);
            } else {
                echo "Invalid action '$action' please try 'create' or 'drop' \n";
                break;
            }
        }
        echo "Finished Running command for $action \n";
    }

    public function actionSingle($table_name_raw, $pk_column_raw, $action)
    {
        $table_name = strtoupper($table_name_raw);
        $pk_column = strtoupper($pk_column_raw);

        if ($action == 'drop') {
            $this->DropTrigger($table_name, $pk_column);
            $this->DropSequences($table_name, $pk_column);

        } elseif ($action == 'create') {
            $this->BuildSequences($table_name, $pk_column);

            $this->BuildTrigger($table_name, $pk_column);
        } else {
            echo "Invalid action '$action' please try 'create' or 'drop' \n";
        }
        echo "Finished Running command for $action \n";
    }

    /**
     * @param null $table_prefix
     * @return array
     */
    private function GetTables($table_prefix = null)
    {
        echo "----------------------------------------------------------- $table_prefix\n";
        $tables = Yii::$app->db->schema->getTableSchemas();
        $table_info = [];
        foreach ($tables as $table) {
            $table_name = $table->name;
            if (count($table->primaryKey) > 0) {

                $pk_col = $table->primaryKey[0];
                if ($table_prefix == null) {
                    //fetch all tables and ignore the prefix directive
                    //$table_info[$table_name] = [$pk_col];
                    echo "Table $table_name with primary key $pk_col, added to info array prefix ignored" . "\n";
                } else {
                    if (preg_match('#^' . $table_prefix . '#', $table_name) === 1) {
                        $table_info[$table_name] = [$pk_col];

                        //echo "Table $table_name with primary key $pk_col, added to info array prefix $table_prefix" . "\n";
                    }
                }
            } else {
                echo "--------------------------NOT A TABLE---------------------------------\n";
                echo "$table_name has no primary key defined, skipping generation" . "\n";
                echo "--------------------------NOT A TABLE---------------------------------\n";
            }

        }
        echo "-----------------------------------------------------------\n";
        return $table_info;
    }

    private function BuildSequences($table_name, $pk_column, $schema_name = 'MUTHONI')
    {
        $sequence_name = strtoupper($table_name . '_SEQ');

        $notification_seq = <<<SEQUENCE
   CREATE SEQUENCE  "$schema_name"."$sequence_name"  MINVALUE 1 MAXVALUE 9999999999999999999999999999 INCREMENT BY 1 START WITH 1 CACHE 20 NOORDER  NOCYCLE
SEQUENCE;

        $seq_resp = $this->ExecuteSqCommand($notification_seq);
        if ($seq_resp == 0) {
            echo "Successfully created sequence for table $table_name sequence name $sequence_name \n";
        } else {
            echo "Failed to create sequence for table $table_name sequence name $sequence_name \n";
        }

        return $seq_resp;
    }

    private function BuildTrigger($table_name, $pk_column, $schema_name = 'MUTHONI')
    {
        $trigger_name = strtoupper($table_name . '_TRG');
        $sequence_name = strtoupper($table_name . '_SEQ');

        $notification_seq_trigger = <<<SQL
CREATE OR REPLACE TRIGGER "$trigger_name"
BEFORE INSERT ON "$table_name" FOR EACH ROW
BEGIN
 SELECT "$sequence_name".NEXTVAL INTO :NEW."$pk_column" FROM SYS.DUAL;
END;
SQL;


        $trigger_resp = $this->ExecuteSqCommand($notification_seq_trigger);
        if ($trigger_resp == 0) {
            echo "Successfully created trigger for table $table_name trigger name $trigger_name \n";
        } else {
            echo "Failed to create trigger for table $table_name trigger name $trigger_name \n";
        }

        return $trigger_resp;
    }

    private function DropSequences($table_name, $pk_column, $schema_name = 'MUTHONI')
    {
        $sequence_name = strtoupper($table_name . '_SEQ');

        $table_sequence_ddl = <<<TRIGGER
   DROP SEQUENCE  "$schema_name"."$sequence_name"
TRIGGER;

        $seq_resp = $this->ExecuteSqCommand($table_sequence_ddl);;
        if ($seq_resp == 0) {
            echo "Successfully dropped sequence for table $table_name sequence name $sequence_name \n";
        } else {
            echo "Failed to drop sequence for table $table_name sequence name $sequence_name \n";
        }

        return $seq_resp;
    }

    private function DropTrigger($table_name, $pk_column, $schema_name = 'MUTHONI')
    {
        $trigger_name = strtoupper($table_name . '_TRG');

        $table_trigger_ddl = <<<SQL
DROP TRIGGER "$trigger_name"
SQL;
        $trigger_resp = $this->ExecuteSqCommand($table_trigger_ddl);
        if ($trigger_resp == 0) {
            echo "Successfully dropped trigger for table $table_name trigger name $trigger_name \n";
        } else {
            echo "Failed to drop trigger for table $table_name trigger name $trigger_name \n";
        }

        return $trigger_resp;
    }

    protected
    function ExecuteSqCommand($query)
    {
        $resp = 1;
        try {
            $resp = Yii::$app->db->createCommand($query)->execute();
        } catch (Exception $e) {
            echo "A database error occurred, pleas check logs \n";

        }

        return $resp;
    }
}