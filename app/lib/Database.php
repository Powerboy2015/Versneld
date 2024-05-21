<?php
    class Database {
        private $dbHost = DB_HOST;
        private $dbUser = DB_USER;
        private $dbPass = DB_PASS;
        private $dbName = DB_NAME;
        private $statement;
        private $dbHandler;
        private $error;

        // Database connection construct.
        public function __construct() {
            $connect = 'mysql:host=' . $this->dbHost . 
                       ';dbname=' . $this->dbName;
            $options = array(
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false
            );

            try {
                $this->dbHandler = new PDO($connect, $this->dbUser, $this->dbPass, $options);
            } catch(PDOException $e) {
                $this->error = $e->getMessage();
                echo $this->error;
            }
        }

        // Query commands
        public function query($sql) {
            $this->statement = $this->dbHandler->prepare($sql);
        }

        public function bind($parameter, $value, $type=null) {
            switch (is_null($type)) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
            $this->statement->bindValue($parameter, $value, $type);
        }

        public function execute() {
            return $this->statement->execute();
        }

        // returns a array with objects.
        public function resultSet() {
            $this->execute();
            return $this->statement->fetchALl(PDO::FETCH_OBJ);
        }

        public function single() {
            $this->execute();
            return $this->statement->fetch(PDO::FETCH_OBJ);
        }

        public function rowCount() {
            return $this->statement->rowCount();
        }
    }
?>