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
        $isbn = $this->sanitizeInput($data['isbn']);
        $title = $this->sanitizeInput($data['title']);
        $author = $this->sanitizeInput($data['author']);
        $genre = $this->sanitizeInput($data['genre']);
        $pubyear = $this->sanitizeInput($data['publication_year']);
        $qtyAvail = intval($this->sanitizeInput($data['quantity_available']));
        $qtyTotal = intval($this->sanitizeInput($data['quantity_total']));
        $query = "EXEC AddNewBook @isbn = :isbn, @title = :title, @author = :author, @genre = :genre, @pubyear = :pubyear, @qtyAvail = :qtyAvail, @qtyTotal = :qtyTotal";
        $this->connect->query($query);
        $this->connect->bind('isbn', $isbn);
        $this->connect->bind('title', $title);
        $this->connect->bind('author', $author);
        $this->connect->bind('genre', $genre);
        $this->connect->bind('pubyear', $pubyear);
        $this->connect->bind('qtyAvail', $qtyAvail);
        $this->connect->bind('qtyTotal', $qtyTotal);
        $this->connect->execute();
        return $this->connect->rowCount();
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

    public function updateBook($data)
    {
        $isbn = $this->sanitizeInput($data['isbn']);
        $title = $this->sanitizeInput($data['title']);
        $author = $this->sanitizeInput($data['author']);
        $genre = $this->sanitizeInput($data['genre']);
        $pubyear = $this->sanitizeInput($data['publication_year']);
        $qtyAvail = $this->sanitizeInput($data['quantity_available']);
        $qtyTotal = $this->sanitizeInput($data['quantity_total']);
        $query = "UPDATE $this->table SET Title = :title, Author = :author, Genre = :genre, PublicationYear = :pubyear, QuantityAvailable = :qtyAvail, QuantityTotal = :qtyTotal WHERE ISBN = :isbn";
        $this->connect->query($query);
        $this->connect->bind('isbn', $isbn);
        $this->connect->bind('title', $title);
        $this->connect->bind('author', $author);
        $this->connect->bind('genre', $genre);
        $this->connect->bind('pubyear', $pubyear);
        $this->connect->bind('qtyAvail', $qtyAvail);
        $this->connect->bind('qtyTotal', $qtyTotal);
        $this->connect->execute();
        return $this->connect->rowCount();
    }

    public function deleteBook($isbn)
    {
        $isbn = $this->sanitizeInput($isbn);
        $query = "DELETE FROM $this->table WHERE ISBN = :isbn";
        $this->connect->query($query);
        $this->connect->bind('isbn', $isbn);
        $this->connect->execute();
        return $this->connect->rowCount();
    }

    //get book with quantity available > 0
    public function getBookAvailable()
    {
        $query = "SELECT * FROM $this->table WHERE QuantityAvailable > 0";
        $this->connect->query($query);
        $this->connect->execute();
        return $this->connect->resultSet();
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
