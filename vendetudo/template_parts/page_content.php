<?php

$menu = isset(APP_URL_PARTS[0]) ? APP_URL_PARTS[0] : null;

switch ($menu) {
	case "login":
		include_once("pages/login.php");
		break;
	case "logout":
		include_once("pages/logout.php");
		break;
	case "myaccount":
		include_once("pages/myaccount.php");
		break;
	case "register":
		include_once("pages/register.php");
		break;
	case "users":
		break;
	case "show-category":
		break;
	default:
		include_once("pages/homepage.php");
		break;
}
