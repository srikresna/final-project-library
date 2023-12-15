<?php

class MailModel {
    private $table = '[Mail]';
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

    public function addNewMail($data) {
        $patronID = $this->sanitizeInput($data['PatronId']);
        $subject = $this->sanitizeInput($data['Subject']);
        $body = $this->sanitizeInput($data['Body']);
        $date = date("Y-m-d");
        $query = "INSERT INTO $this->table (PatronId, Subject, Body, MailDate) VALUES (:PatronID, :subject, :body, :date)";
        $this->connect->query($query);
        $this->connect->bind('PatronID', $patronID);
        $this->connect->bind('subject', $subject);
        $this->connect->bind('body', $body);
        $this->connect->bind('date', $date);
        $this->connect->execute();
        return $this->connect->lastInsertId();
    }

    public function batchMail($data) {
        // mail to all patron
        $subject = $this->sanitizeInput($data['Subject']);
        $body = $this->sanitizeInput($data['Body']);
        $date = date("Y-m-d");
        $query = "INSERT INTO $this->table (PatronId, Subject, Body, MailDate) VALUES (:PatronID, :subject, :body, :date)";
        $this->connect->query($query);
        $this->connect->bind('PatronID', null);
        $this->connect->bind('subject', $subject);
        $this->connect->bind('body', $body);
        $this->connect->bind('date', $date);
        $this->connect->execute();
        return $this->connect->lastInsertId();
    }

    public function getAllBatchMail() {
        $query = "SELECT * FROM $this->table WHERE PatronId IS NULL";
        $this->connect->query($query);
        $this->connect->execute();
        return $this->connect->resultSet();
    }

    public function getMailById($id) {
        $query = "SELECT * FROM $this->table WHERE PatronId = :id";
        $this->connect->query($query);
        $this->connect->bind('id', $id);
        $this->connect->execute();
        return $this->connect->resultSet();
    }

    public function deleteMail($id) {
        $query = "DELETE FROM $this->table WHERE PatronId = :id";
        $this->connect->query($query);
        $this->connect->bind('id', $id);
        $this->connect->execute();
        return $this->connect->rowCount();
    }
}