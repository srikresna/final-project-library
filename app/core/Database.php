<?php


class Database {
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $name = DB_NAME;

    private $db;
    private $stmt;
    
    public function __construct()
    {
        // data source name
        $dsn = 'sqlsrv:Server=' . $this->host . ';Database=' . $this->name;

        $option = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_AUTOCOMMIT => false
        ];

        try {
            $this->db = new PDO($dsn, $this->user, $this->pass, $option);
        } catch (PDOException $e) {
            echo  $e->getMessage();
            var_dump($e);
        }
    }

    public function query($query) {
        $this->stmt = $this->db->prepare($query);
    }

    public function bind($param, $value, $type = null) {
        if (is_null($type)) {
            switch (true) {
                case is_int($value) :
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value) :
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value) :
                    $type = PDO::PARAM_NULL;
                    break;
                default :
                    $type = PDO::PARAM_STR;
            }
        }

        $this->stmt->bindValue($param, $value, $type);
    }

    public function execute() {
        $this->stmt->execute();
    }

    public function resultSet() {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function commit() {
        $this->db->commit();
    }

    public function beginTransaction() {
        $this->db->beginTransaction();
    }

    public function rollback() {
        $this->db->rollback();
    }
}

