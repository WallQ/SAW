<?php
class Application
{
    private function __clone()
    {
    }

    public function __construct()
    {
        $urlParts = array();
        if (isset($_GET['url'])) {
            $urlParts = explode('/', $_GET['url']);
        }
        define('APP_URL_PARTS', $urlParts);
        define('HOME_URL_PREFIX', '/SAW');
    }

    public function startApp()
    {
        require_once('./components/Layout/layout.php');
    }
}
