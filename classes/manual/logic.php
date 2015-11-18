<?php
/**
 * класс для работы с хранилищами
 */
class Clogic {
    /**
     * счетчик картинок
     */
    const COUNTER_KEY = 'counter_3';

    /**
     * коннектор бД
     * @var
     */
    private static $_db;

    /**
     * коннектор редиса
     * @var
     */
    private static $_redis;

    /**
     * загрузка данных
     * @static
     */
    public static function load()
    {
        self::$_db = new DataBase();
        self::$_redis = new Redis();
    }

    /**
     * получение счетчика картинок
     * @static
     * @return int
     */
    public static function getCounter()
    {
        return intval(self::$_redis->get(self::COUNTER_KEY));
    }

    /**
     * запись картинки
     * @static
     * @param $counter
     * @param $path
     */
    public static function addPicture($counter, $path)
    {
        self::$_redis->incr(self::COUNTER_KEY);

        $sql = "INSERT INTO `gallery` (`id`, `path`) VALUES (:counter, :path)";
        $dbResult = self::$_db->prepare($sql);
        $dbResult->execute(
            array(
                ':counter' => $counter,
                ':path' => $path,
            )
        );
    }

    /**
     * Получение всех картинок из БД
     * @static
     * @return mixed
     */
    public static function getPicturesFromDB()
    {
        $sql = "SELECT
                    *
                FROM
                    `gallery`";
        $dbResult = self::$_db->prepare($sql);
        $dbResult->execute(array());
        return $dbResult->fetchAll(PDO::FETCH_ASSOC);
    }
}