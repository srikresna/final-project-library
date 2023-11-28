<?php

class BookModel {
    private $table = '[Book]';
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

    public function getAllDataBook() {
        $query = "SELECT * FROM $this->table";
        $this->connect->query($query);
        $this->connect->execute();
        return $this->connect->resultSet();
    }

    public function getBookByTitle($data) {
        $title = $this->sanitizeInput($data['Title']);
        $query = "SELECT * FROM $this->table WHERE Title = :title";
        $this->connect->query($query);
        $this->connect->bind('title', $title);
        $this->connect->execute();
        return $this->connect->resultSet();
    }

    public function getBookByAuthor($data) {
        $author = $this->sanitizeInput($data['Author']);
        $query = "SELECT * FROM $this->table WHERE Author = :author";
        $this->connect->query($query);
        $this->connect->bind('author', $author);
        $this->connect->execute();
        return $this->connect->resultSet();
    }

    public function getBookByISBN($data) {
        $isbn = $this->sanitizeInput($data['ISBN']);
        $query = "SELECT * FROM $this->table WHERE ISBN = :isbn";
        $this->connect->query($query);
        $this->connect->bind('isbn', $isbn);
        $this->connect->execute();
        return $this->connect->resultSet();
    }

    public function addNewBook($data) {
        $isbn = $this->sanitizeInput($data['ISBN']);
        $title = $this->sanitizeInput($data['Title']);
        $author = $this->sanitizeInput($data['Author']);
        $genre = $this->sanitizeInput($data['Genre']);
        $pubyear = $this->sanitizeInput($data['PublicationYear']);
        $qtyAvail = $this->sanitizeInput($data['QuantityAvailable']);
        $qtyTotal = $this->sanitizeInput($data['QuantityTotal']);
        $query = "INSERT INTO $this->table VALUES (:isbn, :title, :author, :genre, :pubyear, :qtyAvail, :qtyTotal)";
        $this->connect->query($query);
        $this->connect->bind('isbn', $isbn);
        $this->connect->bind('title', $title);
        $this->connect->bind('author', $author);
        $this->connect->bind('genre', $genre);
        $this->connect->bind('pubyear', $pubyear);
        $this->connect->bind('qtyAvail', $qtyAvail);
        $this->connect->bind('qtyTotal', $qtyTotal);
        $this->connect->execute();
        return $this->connect->resultSet();
    }

    public function getQuantity($data) {
        $bookID = $this->sanitizeInput($data['BookID']);
        $query = "SELECT QuantityAvailable FROM $this->table WHERE BookID = :bookID";
        $this->connect->query($query);
        $this->connect->bind('bookID', $bookID);
        $this->connect->execute();
        return $this->connect->resultSet();
    }

    public function updateQuantity($data, $newQuantity) {
        $bookID = $this->sanitizeInput($data['BookID']);
        $query = "UPDATE $this->table SET QuantityAvailable = :newQuantity WHERE BookID = :bookID";
        $this->connect->query($query);
        $this->connect->bind('bookID', $bookID);
        $this->connect->bind('newQuantity', $newQuantity);
        $this->connect->execute();
        return $this->connect->resultSet();
    }

    // DB function to check if a book is available
    public function checkBookAvailability($bookID) {
        $query = "SELECT QuantityAvailable FROM $this->table WHERE BookID = :bookID";
        $this->connect->query($query);
        $this->connect->bind('bookID', $bookID);
        $this->connect->execute();
        return $this->connect->resultSet();
    }

    public function getBookReserved($patronID) {
        $query = "SELECT * FROM $this->table WHERE BookID IN (SELECT BookID FROM [Reservation] WHERE PatronID = :patronID)";
        $this->connect->query($query);
        $this->connect->bind('patronID', $patronID);
        $this->connect->execute();
        return $this->connect->resultSet();
    }
    
}

?>