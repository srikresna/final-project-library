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

    public function getReservationByPatron($keyword) {
        $query = "SELECT Reservation.*, Book.Title, Book.ISBN, Patron.FirstName FROM $this->table
        JOIN Book ON Reservation.BookId = Book.BookId
        JOIN Patron ON Reservation.PatronId = Patron.PatronId
        WHERE Patron.FirstName LIKE :keyword";
        $this->connect->query($query);
        $this->connect->bind('keyword', "%$keyword%");
        $this->connect->execute();
        return $this->connect->resultSet();
    }

    public function getReservationByTitle($keyword) {
        $query = "SELECT Reservation.*, Book.Title, Book.ISBN, Patron.FirstName FROM $this->table
        JOIN Book ON Reservation.BookId = Book.BookId
        JOIN Patron ON Reservation.PatronId = Patron.PatronId
        WHERE Book.Title LIKE :keyword";
        $this->connect->query($query);
        $this->connect->bind('keyword', "%$keyword%");
        $this->connect->execute();
        return $this->connect->resultSet();
    }

    public function getReservationByISBN($keyword) {
        $query = "SELECT Reservation.*, Book.Title, Book.ISBN, Patron.FirstName FROM $this->table
        JOIN Book ON Reservation.BookId = Book.BookId
        JOIN Patron ON Reservation.PatronId = Patron.PatronId
        WHERE Book.ISBN LIKE :keyword";
        $this->connect->query($query);
        $this->connect->bind('keyword', "%$keyword%");
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


    public function updateReservation($data) {
        $query = "UPDATE Reservation SET BookId = :bookId, PatronId = :patronId, ReservationDate = :date WHERE ReservationId = :reservationId";
        $this->connect->query($query);
        $this->connect->bind(':bookId', $data['bookId']);
        $this->connect->bind(':patronId', $data['patronId']);
        $this->connect->bind(':date', $data['date']);
        $this->connect->bind(':reservationId', $data['reserveId']);
        $this->connect->execute();
    }

    public function deleteReservation($reservationId) {
        $query = "DELETE FROM Reservation WHERE ReservationId = :reservationId";
        $this->connect->query($query);
        $this->connect->bind(':reservationId', $reservationId);
        $this->connect->execute();
    }

    public function getActiveReservation() {
        $query = "SELECT Reservation.*, Book.Title, Patron.FirstName FROM $this->table
        JOIN Book ON Reservation.BookId = Book.BookId
        JOIN Patron ON Reservation.PatronId = Patron.PatronId
        WHERE Reservation.ReservationDate > GETDATE()";
        $this->connect->query($query);
        $this->connect->execute();
        return $this->connect->resultSet();
    }

    public function getReadyReservation() {
        $query = "SELECT DISTINCT PatronId FROM $this->table WHERE ReservationDate <= GETDATE()";
        $this->connect->query($query);
        $this->connect->execute();
        return $this->connect->resultSet();
    }
}

