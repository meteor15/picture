<?php

require_once __DIR__.'/classes/manual/main.php';

$gallery = new Main();
$result = $gallery->getPictures();
$gallery->showAll($result);
