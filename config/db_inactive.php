<?php
//session_start();
$userID = isset($_SESSION['UserID']) ? $_SESSION['UserID'] :'MUTHONI';
$cred = isset($_SESSION['PassWord']) ? $_SESSION['PassWord'] :'muthoni_2015_schema';
//$dsn = 'oci:dbname=//proddb.uonbi.ac.ke:1521/proddb';
$dsn = 'oci:dbname=//localhost:1521/XE';
/*
'class'=>'\sfedosimov\oci8pdo\Oci8PDO_Connection',
              /*
               * Note: Normally you use the Easy Connect string, but your server has
               * to be correctly set-up for that.
               *
               * ** Easy Connect String **
               * If you get the following error: `ORA-12154: TNS:could not resolve the connect identifier specified`,
               * go to /opt/oracle/instantclient/sqlnet.ora and change the following line:
               *    NAMES.DIRECTORY_PATH= (TNSNAMES)
               * Change this to:
               *    NAMES.DIRECTORY_PATH= (TNSNAMES, EZCONNECT)
               */
//    'dsn' => 'oci:dbname=//myOracleHost.com:1526/ccq',
/*
 * ** Full Connection String **
 * Use this method incase your Easy Connect gives you errors and you can't edit the sqlnet.ora file.
 * You can set the charset in this string as well, add `;charset=AL32UTF8;` at the end for UTF-8.
 */
/*
              'dsn' => 'oci:dbname=(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=myOracleHost.com)
                                                 (PORT=1526))(CONNECT_DATA=(SERVICE_NAME=myService.intern)));charset=AL32UTF8;',
              'username' => '',
              'password' => '',
        ),
    */
return [
     'class' => 'yii\db\Connection',
    //'class' => '\sfedosimov\oci8pdo\Oci8PDO_Connection',
    'dsn' => $dsn,
    'username' => $userID,
    'password' => $cred,
    'charset' => 'utf8',
    'schemaMap' => [
        'oci'=> [
            'class'=>'yii\db\oci\Schema',
            'defaultSchema' => 'MUTHONI' //specify your schema here
        ]
    ], // oracle
];