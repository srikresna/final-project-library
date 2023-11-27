<?php

class UserModel extends Database{
    private $table = '[User]';
    private $connect;

    public function __construct()
    {
        $this->connect = new Database();
    }

    public function sanitizeInput($data) {
        $data = htmlspecialchars($data);
        $data = stripslashes($data);
        $data = trim($data);
        return $data;
    }

    public function getDataUser($username, $password) {
        $username = $this->sanitizeInput($username);
        $password = $this->sanitizeInput($password);
        $query = "SELECT * FROM $this->table WHERE username = :username AND password = :password";
        $this->connect->query($query);
        $this->connect->bind('username', $username);
        $this->connect->bind('password', $password);
        $this->connect->execute();
        return $this->connect->resultSet();
    }
}