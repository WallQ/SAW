<?php

/* PHP.INI CONFIGS **/
ini_set('display_errors', 1);
error_reporting(E_ALL | E_STRICT);
ini_set('error_log', 'Log/script_errors.log');
ini_set('log_errors', 'On');
ini_set('date.timezone', 'Europe/Lisbon');

try {
	// session_start inicia a sessão
	session_start();

	require_once("classes/autoload.php");

	//Load database configs
	$db_configs = include_once("configs/db_config.php");

	//Connect database		
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
