<?php
require_once __DIR__ . '/COption.php';

require_once __DIR__ . '/../classes/vendors/predis/Autoloader.php';
Predis\Autoloader::register();
require_once __DIR__ . '/../classes/services/Redis.php';

require_once __DIR__ . '/../classes/services/DataBase.php';

require_once __DIR__ . '/../classes/manual/logic.php';
require_once __DIR__ . '/../classes/exceptions/MainException.php';
require_once __DIR__ . '/../classes/manual/client.php';