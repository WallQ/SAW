<?php
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 1);
ini_set('log_errors', TRUE);
ini_set('error_log', '../logs/errors.log');
ini_set('date.timezone', 'Europe/Lisbon');
try {
    session_start();
    spl_autoload_register(function ($className) {
        require_once('./classes/' . $className . '.php');
    });
    $app = new Application();
    $app->startApp();
} catch (Exception $e) {
    throw new Exception($e->getMessage());
}
