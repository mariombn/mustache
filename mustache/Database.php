<?php

namespace Mustache;

use PDO;

class Database
{
    public static $instance;

    public static function getInstance()
    {
        $hostname = DB_HOSTNAME;
        $username = DB_USERNAME;
        $password = DB_PASSWORD;
        $database = DB_DATABASE;

        if (!isset(self::$instance)) {
            // TODO: Studying the possibility of using other databases that support the PDO
            self::$instance = new PDO('mysql:host=' . $hostname . ';dbname=' . $database, $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$instance->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);
        }

        return self::$instance;
    }


}