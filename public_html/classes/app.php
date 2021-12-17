<?php

class App
{
    private $CONFIGS = null;

    private function __clone()
    {
    }

    public function __construct($app_configs)
    {
        $this->CONFIGS = $app_configs;
    }

    public function startApp()
    {
        include_once('./components/Layout/layout.php');
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
