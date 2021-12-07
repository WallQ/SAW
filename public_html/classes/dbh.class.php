<?php
    class Dbh {
        private $host;
        private $port;
        private $name;
        private $username;
        private $password;
        private $charset;

        protected function connect() {
            $this->host = Config::read('db.host');
            $this->port = Config::read('db.port');
            $this->name = Config::read('db.name');
            $this->username = Config::read('db.username');
            $this->password = Config::read('db.password');
            $this->charset = Config::read('db.charset');

            try {
                $dsn = 'mysql:host='.$this->host.';port='.$this->port.';dbname='.$this->name.';charset='.$this->charset.';connect_timeout=15';
                $dbh = new PDO($dsn, $this->username, $this->password);
                $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $dbh;
            } catch(PDOException $e) {
                print('Oops, something wen\'t wrong! '.$e->getMessage());
                die();
            }
        }
    }
?>