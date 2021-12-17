<?php
    Config::write('db.host', '127.0.0.1');
    Config::write('db.port', '3306');
    Config::write('db.name', 'saw');
    Config::write('db.username', 'root');
    Config::write('db.password', '');
    Config::write('db.charset', 'utf8');
    Config::write('rp.secret', 'YQUaTz9-4W4xyurv');
    Config::write('rp.cipher', 'AES-128-CBC');
    Config::write('rp.algorithm', 'sha256');

    class Config {
        static $confArray;

        public static function read() {
            return self::$confArray;
        }

        public static function write($name, $value) {
            self::$confArray[$name] = $value;
        }
    }
