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
        $query = "SELECT Fine.*, Patron.FirstName FROM $this->table
        JOIN Patron ON Fine.PatronID = Patron.PatronID";
        $this->connect->query($query);
        $this->connect->execute();
        return $this->connect->resultSet();
    }

    public function addNewFine($data) {
        $patronID = $this->sanitizeInput($data['PatronId']);
        $amount = 10000;
        $status = $this->sanitizeInput($data['PaymentStatus']);
        $due = $this->sanitizeInput($data['DueDate']);
        $query = "INSERT INTO $this->table VALUES (:PatronID, :amount, :status, :due)";
        $this->connect->query($query);
        $this->connect->bind('PatronID', $patronID);
        $this->connect->bind('amount', $amount);
        $this->connect->bind('status', $status);
        $this->connect->bind('due', $due);
        $this->connect->execute();
        return $this->connect->lastInsertId();
    }

    public function checkOverdueFine() {
        $query = "SELECT * FROM $this->table WHERE DueDate < GETDATE() AND PaymentStatus = 'Unpaid'";
        $this->connect->query($query);
        $result = $this->connect->resultSet();

        foreach ($result as $fine) {
            $newAmount = $fine['Amount'] + 10000;
            $newDue = date("Y-m-d", strtotime($fine['DueDate'] . '+ 3 days'));

            $query = "UPDATE $this->table SET Amount = :newAmount, DueDate = :newDue WHERE PatronID = :patronID";
            $this->connect->query($query);
            $this->connect->bind('newAmount', $newAmount);
            $this->connect->bind('newDue', $newDue);
            $this->connect->bind('patronID', $fine['PatronID']);
            $this->connect->execute();
        }

        return $result;
    }

    public function paidFine($data) {
        $patronID = $this->sanitizeInput($data['PatronId']);
        $query = "UPDATE $this->table SET PaymentStatus = 'Paid' WHERE PatronID = :patronID";
        $this->connect->query($query);
        $this->connect->bind('patronID', $patronID);
        $this->connect->execute();
    }

    public function getUnpaidFine() {
        $query = "SELECT DISTINCT PatronID FROM $this->table WHERE PaymentStatus = 'Unpaid'";
        $this->connect->query($query);
        $this->connect->execute();
    }

}