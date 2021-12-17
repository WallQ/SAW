<?php

class Database
{
    private $driver;
    private $host;
    private $port;
    private $name;
    private $username;
    private $password;
    private $charset;

    private $configs;
    private $options;
    private $dbh;
    private $error;
    private $stmt;
    private static $_instance = null;
    private static $_backupInstance = null;

    private function __clone()
    {
    }

    public function __construct($config)
    {
        $this->driver = $config['db.driver'];
        $this->host = $config['db.host'];
        $this->port = $config['db.port'];
        $this->name = $config['db.name'];
        $this->username = $config['db.username'];
        $this->password = $config['db.password'];
        $this->charset = $config['db.charset'];
        $this->configs = $config;

        try {
            $dsn =  $config['db.driver']
                . ':host=' . $config['db.host']
                . ';port=' . $config['db.port']
                . ';dbname=' . $config['db.name']
                . ';charset=' . $config['db.charset']
                . ';connect_timeout=15';
            $this->options = $options = array(
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false
            );
            $this->dbh = new PDO($dsn, $config['db.username'], $config['db.password'], $options);
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            throw new Exception($e->getMessage(), 1);
        }
    }

    public static function getInstance($config = null)
    {
        if (self::$_instance == null || $config != null) {
            self::$_instance = new Database($config);
        }
        return self::$_instance;
    }

    public static function shadowInstance($new_db_conn_env = null)
    {
        self::$_backupInstance = self::$_instance;
        if (self::$_instance == null || $new_db_conn_env != null) {
            self::$_instance = new Database($new_db_conn_env);
        }
        return self::$_instance;
    }

    public static function restoreInstance()
    {
        self::$_instance = self::$_backupInstance;
        return self::$_instance;
    }

    public function query($query)
    {
        if (!empty($this->error)) {
            throw new Exception($this->error, 1);
        } else {
            $this->stmt = $this->dbh->prepare($query);
        }
    }

    public function execute()
    {
        return $this->stmt->execute();
    }

    public function fetchAll()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function fetch()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function rowCount()
    {
        return $this->stmt->rowCount();
    }
}
