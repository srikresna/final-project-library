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

    public function getIDUser($username) {
        $username = $this->sanitizeInput($username);
        $query = "SELECT * FROM $this->table WHERE username = :username";
        $this->connect->query($query);
        $this->connect->bind('username', $username);
        $this->connect->execute();
        return $this->connect->resultSet();
    }

    public function updateUser($data) {
        $username = $this->sanitizeInput($data['username']);
        $password = $this->sanitizeInput($data['password']);
        $query = "UPDATE $this->table SET password = :password WHERE username = :username";
        $this->connect->query($query);
        $this->connect->bind('username', $username);
        $this->connect->bind('password', $password);
        $this->connect->execute();
        return $this->connect->rowCount();
    }

    public function addNewUserPatron($data) {
        $username = $this->sanitizeInput($data['username']);
        $password = $this->sanitizeInput($data['password']);
        $role = $this->sanitizeInput($data['role']);
        $patronId = $this->sanitizeInput($data['patronId']);
        $query = "INSERT INTO $this->table (Username, Password, Role, PatronId) VALUES (:username, :password, :role, :patronId)";
        $this->connect->query($query);
        $this->connect->bind('username', $username);
        $this->connect->bind('password', $password);
        $this->connect->bind('role', $role);
        $this->connect->bind('patronId', $patronId);
        $this->connect->execute();
        return $this->connect->lastInsertId();
    }
}