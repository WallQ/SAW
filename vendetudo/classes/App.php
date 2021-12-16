<?php

class App
{
	private $CONFIGS = null;


	private function __clone()
	{
	} //Prevent any copy of this object

	public function __construct($app_configs)
	{
		$this->CONFIGS = $app_configs;
	}

	public function renderApplication()
	{
		include_once("template_parts/template.php");
	}

	public function is_user_logged_in()
	{
		if (isset($_SESSION['logged_user']) && $_SESSION['logged_user'] != "") {
			return true;
		} else {
			return false;
		}
	}

	public function doLogin($username, $password)
	{
		//Select username password, etc...
		$login_com_sucesso = true;


		//Se validado, aplicar:
		//$this->logged_user = apinto;
		if ($login_com_sucesso == true) {
			$_SESSION['logged_user'] = $username;
			return true;
		} else {
			return false;
		}
	}

	public function logoutUser()
	{
		//Remove sessions
		unset($_SESSION['logged_user']);
	}

	public function getConfig($config_id)
	{
		if (isset($this->CONFIGS[$config_id])) {
			return $this->CONFIGS[$config_id];
		} else {
			throw new Exception("CONFIG ID NOT EXISTS!");
		}
	}
}
