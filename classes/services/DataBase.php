<?php
/**
 * Класс для работы с базой данных
 */
class DataBase extends PDO
{
    public function __construct()
    {
        $config = COption::getConfig();
        $db = $config['db'];

        $connectionString = "mysql:host={$db['host']};port={$db['port']};dbname={$db['name']}";
        parent::__construct($connectionString, $db['username'], $db['password'], array( PDO::ATTR_PERSISTENT => false));
    }
}