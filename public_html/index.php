<?php
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 1);
ini_set('log_errors', TRUE);
ini_set('error_log', '../logs/errors.log');
ini_set('date.timezone', 'Europe/Lisbon');

try {
    session_start();

    spl_autoload_register(function ($class_name) {
        include_once($class_name . '.php');
    });

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

    $dbConfig = array(
        'db.driver' => 'mysql',
        'db.host' => '127.0.0.1',
        'db.port' => '3306',
        'db.name' => 'saw',
        'db.username' => 'root',
        'db.password' => 'passwordSAW',
        'db.charset' => 'utf8'
    );

    print "<pre>";
    print_r($dbConfig);
    print "</pre>";

    Config::write($dbConfig);

    print "<pre>";
    print_r(Config::read());
    print "</pre>";

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

    $db = Database::getInstance(Config::read());

    print "<pre>";
    print_r($db);
    print "</pre>";

    $sql = "SELECT * FROM app";
    $db->query($sql);
    $result = $db->fetchAll();
    $appConfig = array();
    foreach ($result as $config) {
        $appConfig[$config['configId']] = $config['configValue'];
    }
    $urlParts = array();
    if (isset($_GET["qs"])) {
        $urlParts = explode("/", $_GET["qs"]);
    }
    define("APP_URL_PARTS", $urlParts);
    define("HOME_URL_PREFIX", "/saw");

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

    $myApp = new App($appConfig);
    $myApp->startApp();
} catch (Exception $e) {
    throw new Exception($e, 1);
    print('Oops, something wen\'t wrong! ' . $e->getMessage());
}
