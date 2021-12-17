<?php
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 1);
ini_set('log_errors', TRUE);
ini_set('error_log', '../logs/errors.log');
ini_set('date.timezone', 'Europe/Lisbon');

try {
    session_start();

    spl_autoload_register(function ($class_name) {
        include_once($class_name . '.php');
    });

    $databaseConfig = include_once('./configs/database.php');
    include_once('./classes/config.php');
    Config::write($databaseConfig);

    include_once('./classes/database.php');
    $database = Database::getInstance(Config::read());

    $urlParts = array();
    if (isset($_GET["qs"])) {
        $urlParts = explode("/", $_GET["qs"]);
    }

    define("APP_URL_PARTS", $urlParts);

    include_once('./components/Layout/layout.php');
} catch (Exception $e) {
    throw new Exception($e, 1);
    print('Oops, something wen\'t wrong! ' . $e->getMessage());
}
