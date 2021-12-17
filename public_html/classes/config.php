<?php

class Config
{
    static $confArray;

    public static function read()
    {
        return self::$confArray;
    }

    public static function write(array $configs)
    {
        self::$confArray = $configs;
    }
}
