<?php
    Config::write('db.host', '127.0.0.1');
    Config::write('db.port', '3306');
    Config::write('db.name', 'saw');
    Config::write('db.username', 'root');
    Config::write('db.password', 'passwordSAW');
    Config::write('db.charset', 'utf8');

    class Config {
        static $confArray;

        public static function read($name) {
            return self::$confArray[$name];
        }

        public static function write($name, $value) {
            self::$confArray[$name] = $value;
        }
    }
?>