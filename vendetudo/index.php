<?php

/* PHP.INI CONFIGS **/
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 1);
ini_set('log_errors', TRUE);
ini_set('error_log', '../logs/error.log');
ini_set('date.timezone', 'Europe/Lisbon');

try {
	session_start();

	spl_autoload_register(function ($class_name) {
		include_once($class_name . '.php');
	});

	$db_configs = array(
		"driver" => "mysql",
		"server" => "127.0.0.1",
		"port" => "3306",
		"database" => "vendetudo",
		"username" => "root",
		"password" => ""
	);
	
	$db = Database::getInstance($db_configs);

	$sql = "SELECT * FROM app_configs";
	$db->query($sql);
	$pre_app_configs = $db->resultset();
	$app_configs = array();
	foreach ($pre_app_configs as $config_it) {
		$app_configs[$config_it["config_id"]] = $config_it["config_value"];
	}
	$url_parts = array();
	if (isset($_GET["qs"])) {
		$url_parts = explode("/", $_GET["qs"]);
	}

	define("APP_URL_PARTS", $url_parts);
	define("HOME_URL_PREFIX", "/vendetudo");

	$myApp = new App($app_configs);
	$myApp->renderApplication();
	
} catch (Exception $e) {
	echo "Internal error: " . $e->getMessage();
}
