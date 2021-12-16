<?php

#require __DIR__.'/vendor/autoload.php';

#use PDO;
#use Exception;

class Database
{
	private $CONFIGS = null;
	protected $option;
	private $dbh;
	private $error;
	private $stmt;
	private $db_config;
	private static $_instance = null;
	private static $_backupInstance = null;


	///Prevent any object or instance of that class to be cloned
	private function __clone()
	{
	} //Prevent any copy of this object

	public function __construct($db_config)
	{

		$this->CONFIGS = $db_config;

		$dsn = $db_config["driver"] . ':host=' . $db_config["server"] . ';port=' . $db_config["port"] . ';dbname=' . $db_config["database"] . ";charset=UTF8";
		#$dsn = $db_config["driver"].':Server=' . $db_config["server"] .',' . $db_config["port"] . ';Database=' . $db_config["database"].",charset=UTF8";
		#echo $dsn;
		#new PDO("sqlsrv:Server=foo-sql,1433;Database=mydb", $user , $pass);


		try {

			$options = array(
				PDO::ATTR_PERSISTENT => true,
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
				PDO::ATTR_EMULATE_PREPARES => false
			);

			$this->dbh = new PDO($dsn, $db_config["username"], $db_config["password"], $options);
		} catch (Exception $e) {
			$this->error = $e->getMessage();
			#echo $this->error;
			throw new Exception($this->error, 1);

			//Colocar um throw!
		}
	}


	///Have a single globally accessible static method
	public static function getInstance($new_db_conn_env = null)
	{
		if (self::$_instance == null || $new_db_conn_env != null) {
			self::$_instance = new Database($new_db_conn_env);
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

	public function bind($param, $value, $type = null)
	{
		if (is_null($type)) {
			switch (true) {
				case is_int($value):
					$type = PDO::PARAM_INT;
					$tipo = "INT";
					break;
				case is_bool($value):
					$type = PDO::PARAM_BOOL;
					$tipo = "BOOL";
					break;
				case is_null($value):
					$type = PDO::PARAM_NULL;
					$tipo = "NULL";
					break;
				default:
					$type = PDO::PARAM_STR;
					$tipo = "STRING";
			}
		}
		if ($type == PDO::PARAM_NULL) {
			//$this->stmt->bindValue($param, $n = null, PDO::PARAM_INT);
			$this->stmt->bindValue($param, null, PDO::PARAM_INT);
		} else {
			$this->stmt->bindValue($param, $value, $type);
		}

		#echo "\n BIND : " . $param . " como " . $value . " do tipo " . $tipo;
	}

	public function execute()
	{
		return $this->stmt->execute();
	}

	public function resultset()
	{
		$this->execute();
		#echo "Fiz execute";
		#return Encoding::toUTF8($this->stmt->fetchAll(PDO::FETCH_ASSOC));
		return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
	}


	public function single()
	{
		$this->execute();
		#return Encoding::toUTF8($this->stmt->fetch(PDO::FETCH_ASSOC));
		return $this->stmt->fetch(PDO::FETCH_ASSOC);
	}


	public function rowCount()
	{
		return $this->stmt->rowCount();
	}

	public function lastInsertId()
	{
		return $this->dbh->lastInsertId();
	}

	public function beginTransaction()
	{
		return $this->dbh->beginTransaction();
	}

	public function endTransaction()
	{
		return $this->dbh->commit();
	}

	public function cancelTransaction()
	{
		return $this->dbh->rollBack();
	}

	public function truncateTableNoConstraints($sgdb_table)
	{
		if (!empty($this->error)) {
			throw new Exception($this->error, 1);
		} else {

			$this->stmt = $this->dbh->prepare("SET FOREIGN_KEY_CHECKS = 0");
			//TODO escape variable sgdb_table
			$this->stmt = $this->dbh->prepare("TRUNCATE TABLE " . $sgdb_table);
			$this->stmt = $this->dbh->prepare("SET FOREIGN_KEY_CHECKS = 1");
			return $this->stmt->execute();
		}
	}

	public function debugDumpParams()
	{
		return $this->stmt->debugDumpParams();
	}
}
