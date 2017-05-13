<?php

namespace Mustache;

use PDO;

class Database
{
    public static $instance;

    public static function getInstance()
    {
        $hostname = DB_HOSTNAME;
        $dbPort   = DB_PORT;
        $username = DB_USERNAME;
        $password = DB_PASSWORD;
        $database = DB_DATABASE;

        if (!isset(self::$instance)) {
            if (DB_INSTANCE == 'mysql') {
                self::$instance = new PDO('mysql:host=' . $hostname . ';dbname=' . $database, $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            } else if(DB_INSTANCE == 'mssql') {
                self::$instance = new PDO("dblib:version=7.4;charset=UTF-8;host=$hostname:$dbPort;dbname=$database", $username, $password);
            }
            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$instance->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);
        }

        return self::$instance;
    }


}