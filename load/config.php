<?php
/**
 * Базовые настройки
 */

return array(
    'max_size_file' => 21474836480,
    'max_files_in_dir' => 100,
    'db' => array(
        'host' => '127.0.0.1',
        'port' => '3306',
        'name' => 'picturedb',
        'username' => 'root',
        'password' => 'root',
        'charset' => 'utf8',
    ),
    'redis' => array(
        'host' => array(
            'tcp://127.0.0.1:6379',
        ),
        'db' => '1',
    ),
);
