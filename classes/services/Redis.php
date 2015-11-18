<?php
/**
 * Класс для работы с редисом
 * @method bool set($key, $value)
 *
 * @method bool sadd($key, $member)
 * @method array smembers($key)
 *
 * @method int lpush($key, $value)
 * @method int rpush($key, $value)
 * @method mixed lpop($key)
 * @method mixed rpop($key)
 * @method int llen($key)
 *
 * @method null flushAll()
 * @method null flushDb()
 */
class Redis extends Predis\Client
{
    public function __construct()
    {
        $config = COption::getConfig();
        $redis = $config['redis'];

        parent::__construct(
            $redis['host'], array('database' => $redis['db'])
        );
    }
}