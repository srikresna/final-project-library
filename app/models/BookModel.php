<?php

class BookModel
{
    private $table = '[Book]';
    private $connect;

    public function __construct()
    {
        $this->connect = new Database();
    }

    public function sanitizeInput($data)
    {
        $data = htmlspecialchars($data);
        $data = stripslashes($data);
        $data = trim($data);
        return $data;
    }

    public function getAllDataBook()
    {
        $query = "SELECT * FROM $this->table";
        $this->connect->query($query);
        $this->connect->execute();
        return $this->connect->resultSet();
    }

    public function getBookByTitle($data)
    {
        $data = $this->sanitizeInput($data);
        $this->connect->query("SELECT * FROM $this->table WHERE Title LIKE :keyword");
        $this->connect->bind(':keyword', "%$data%");
        $this->connect->execute();
        return $this->connect->resultSet();
    }

    public function getBookByAuthor($data) {
        $data = $this->sanitizeInput($data);
        $this->connect->query("SELECT * FROM $this->table WHERE Author LIKE :keyword");
        $this->connect->bind(':keyword', "%$data%");
        $this->connect->execute();
        return $this->connect->resultSet();
    }

    public function getBookByISBN($data) {
        $data = $this->sanitizeInput($data);
        $this->connect->query("SELECT * FROM $this->table WHERE ISBN LIKE :keyword");
        $this->connect->bind(':keyword', "%$data%");
        $this->connect->execute();
        return $this->connect->resultSet();
    }

    public function addNewBook($data)
    {
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

    public function getQuantity($bookId)
    {
        $bookId = $this->sanitizeInput($bookId);
        $query = "SELECT QuantityAvailable FROM $this->table WHERE BookId = :bookId";
        $this->connect->query($query);
        $this->connect->bind('bookId', $bookId);
        $this->connect->execute();
        $result = $this->connect->single();
        return $result['QuantityAvailable'];
    }

    public function updateQuantity($bookId, $newQuantity)
    {
        $bookId = $this->sanitizeInput($bookId);
        $query = "UPDATE $this->table SET QuantityAvailable = :newQuantity WHERE BookId = :bookId";
        $this->connect->query($query);
        $this->connect->bind('bookId', $bookId);
        $this->connect->bind('newQuantity', $newQuantity);
        $this->connect->execute();
        return $this->connect->rowCount();
    }

    // DB function to check if a book is available
    public function checkBookAvailability($bookID)
    {
        $query = "SELECT QuantityAvailable FROM $this->table WHERE BookID = :bookID";
        $this->connect->query($query);
        $this->connect->bind('bookID', $bookID);
        $this->connect->execute();
        return $this->connect->resultSet();
    }
}
