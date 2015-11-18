<?php

class DataBase
{
    private static $connection = null;
    private static $_CONNECTED = false;

    private function connect()
    {
        $config = COption::getConfig();
        $db = $config['db'];
        self::$connection = mysql_connect($db['host'], $db['username'], $db['password']);

        if (!self::$connection) {
            die('Access denied!');
        }

        mysql_select_db($db['username'], self::$connection);
        self::$_CONNECTED = true;
    }

    public static function query($query)
    {
        if (!self::$_CONNECTED) {
            self::connect();
        }

        mysql_query("set names 'utf8'");
        $result = mysql_query($query, self::$connection);

        if (!$result) {
            die(mysql_error());
        }

        return mysql_fetch_array($result);
    }
}