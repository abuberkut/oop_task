<?php
/*function __autoload($class_name)
{
    $array_paths = array(
        '/AbstractClasses/',
        '/Implementations/',
        '/SimpleClasses/',
    );

    foreach ($array_paths as $path) {
        $path = ROOT . $path . $class_name . '.php';
        if (is_file($path)) {
            include $path;
        }
    }
}*/
include_once 'AbstractClasses/ANotificationSender.php';
include_once 'Implementations/EmailNotificationSender.php';
include_once 'Implementations/SMSNotificationSender.php';
include_once 'SimpleClasses/Getter.php';
include_once 'SimpleClasses/Crud.php';
include_once 'SimpleClasses/NotifyClient.php';
include_once 'SimpleClasses/Logger.php';
include_once 'SimpleClasses/Main.php';