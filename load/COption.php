<?php
/*
 * Класс подгрузки настроек сервиса
 */
class COption {
    /*
     * настройки сервиса
     */
    private static $_config = NULL;

    /**
     * Получение настроек
     * @static
     * @return null
     */
    public static function getConfig() {
        if (is_null(self::$_config)) {
            self::$_config = require __DIR__ . '/config.php';
        }
        return self::$_config;
    }
}
