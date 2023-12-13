<?php

class FineModel {
    private $table = '[Fine]';
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

    public function getAllDataFine() {
        $query = "SELECT * FROM $this->table";
        $this->connect->query($query);
        $this->connect->execute();
        return $this->connect->resultSet();
    }

    public function addNewFine($data) {
        $patronID = $this->sanitizeInput($data['PatronID']);
        $amount = $this->sanitizeInput($data['Amount']);
        $status = $this->sanitizeInput($data['PaymentStatus']);
        $due = $this->sanitizeInput($data['DueDate']);
        $query = "INSERT INTO $this->table VALUES (:PatronID, :amount, :status, :due)";
        $this->connect->query($query);
        $this->connect->bind('PatronID', $patronID);
        $this->connect->bind('amount', $amount);
        $this->connect->bind('status', $status);
        $this->connect->bind('due', $due);
        $this->connect->execute();
        return $this->connect->resultSet();
    }

    // DB function to calculate total fine of a patron
    public function getTotalFine($patronID) {
        $query = "SELECT SUM(Amount) AS TotalFine FROM $this->table WHERE PatronID = :patronID";
        $this->connect->query($query);
        $this->connect->bind('patronID', $patronID);
        $this->connect->execute();
        return $this->connect->resultSet();
    }
}