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
        $query = "SELECT Reservation.*, Book.Title, Book.ISBN, Patron.FirstName FROM $this->table
        JOIN Book ON Reservation.BookId = Book.BookId
        JOIN Patron ON Reservation.PatronId = Patron.PatronId";
        $this->connect->query($query);
        $this->connect->execute();
        return $this->connect->resultSet();
    }

    public function addNewReservation($data) {
        $bookID = $this->sanitizeInput($data['BookId']);
        $patronID = $this->sanitizeInput($data['PatronId']);
        $reservationDate = $this->sanitizeInput($data['ReservationDate']);
    
        // Check if there is another reservation with the same date
        $query = "SELECT * FROM $this->table WHERE ReservationDate = :reservationDate";
        $this->connect->query($query);
        $this->connect->bind('reservationDate', $reservationDate);
        $existingReservation = $this->connect->single();
    
        // If there is another reservation with the same date, return false
        if ($existingReservation) {
            return false;
        }
    
        // If there is no other reservation with the same date, add the new reservation
        $query = "INSERT INTO $this->table VALUES (:BookID, :patronID, :reservationDate)";
        $this->connect->query($query);
        $this->connect->bind('BookID', $bookID);
        $this->connect->bind('patronID', $patronID);
        $this->connect->bind('reservationDate', $reservationDate);
        $this->connect->execute();
        return $this->connect->lastInsertId();
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

    //method untuk mendapatkan reservation yang lebih dari tanggal saat ini, dapatkan nama patron juga
    public function getActiveReservation() {
        $query = "SELECT Reservation.*, Book.Title, Patron.FirstName FROM $this->table
        JOIN Book ON Reservation.BookId = Book.BookId
        JOIN Patron ON Reservation.PatronId = Patron.PatronId
        WHERE Reservation.ReservationDate > GETDATE()";
        $this->connect->query($query);
        $this->connect->execute();
        return $this->connect->resultSet();
    }
}

