<?php
class Database
{
    private $driver = 'mysql';
    private $host = '127.0.0.1';
    private $port = '3306';
    private $name = 'saw';
    private $username = 'root';
    private $password = 'passwordSAW';
    private $charset = 'utf8';
    private $connectTimeout = '15';

    private function __clone()
    {
    }

    public function connect()
    {
        $dsn =  $this->driver . ':host=' . $this->host . ';port=' . $this->port . ';dbname=' . $this->name . ';charset=' . $this->charset . ';connect_timeout=' . $this->connectTimeout;
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        );
        try {
            return new PDO($dsn, $this->username, $this->password, $options);
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }
}
