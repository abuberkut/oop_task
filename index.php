<?php

use Task\SimpleClasses\Main;
/**
 * Autoload does not work in console mode
 *
 * define('ROOT', __DIR__);
 * */
date_default_timezone_set("Asia/Dushanbe");
include_once 'Autoload.php';

(new Main)->run();