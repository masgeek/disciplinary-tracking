<?php
/**
 * Created by PhpStorm.
 * User: barsa
 * Date: 3/2/2017
 * Time: 11:57 AM
 */

return [
    //'class' => 'yii\db\Connection',
    'class' => '\sfedosimov\oci8pdo\Oci8PDO_Connection',
    //'dsn' => 'mysql:host=localhost;dbname=ayes', // MySQL, MariaDB
    //'dsn' => 'sqlite:/path/to/database/file', // SQLite
    //'dsn' => 'pgsql:host=localhost;port=5432;dbname=mydatabase', // PostgreSQL
    //'dsn' => 'cubrid:dbname=demodb;host=localhost;port=33000', // CUBRID
    //'dsn' => 'sqlsrv:Server=localhost;Database=mydatabase', // MS SQL Server, sqlsrv driver
    //'dsn' => 'dblib:host=localhost;dbname=mydatabase', // MS SQL Server, dblib driver
    //'dsn' => 'mssql:host=localhost;dbname=mydatabase', // MS SQL Server, mssql driver
    'dsn' => 'oci:dbname=//localhost:1521/XE', // Oracle
    'username' => 'muthoni',
    'password' => 'muthoni_2015_schema',
    //'charset' => 'utf8',
    'tablePrefix' => 'DT_'
];
