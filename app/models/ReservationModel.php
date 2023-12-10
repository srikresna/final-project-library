<?php

class ReservationModel {
    private $table = '[Reservation]';
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

    public function getAllDataReservation() {
        $query = "SELECT * FROM $this->table";
        $this->connect->query($query);
        $this->connect->execute();
        return $this->connect->resultSet();
    }

    public function addNewReservation($data) {
        $bookID = $this->sanitizeInput($data['BookID']);
        $patronID = $this->sanitizeInput($data['PatronID']);
        $reservationDate = $this->sanitizeInput($data['ReservationDate']);
        $query = "INSERT INTO $this->table VALUES (:BookID, :patronID, :reservationDate)";
        $this->connect->query($query);
        $this->connect->bind('BookID', $bookID);
        $this->connect->bind('patronID', $patronID);
        $this->connect->bind('reservationDate', $reservationDate);
        $this->connect->execute();
        return $this->connect->resultSet();
    }

    public function getOlderReservation($patronID) {
        $query = "SELECT Reservation.*, Book.Title FROM $this->table 
        JOIN Book ON Reservation.BookId = Book.BookId 
        WHERE Reservation.PatronID = :patronID";
        $this->connect->query($query);
        $this->connect->bind('patronID', $patronID);
        $this->connect->execute();
        return $this->connect->resultSet();
    }
}

