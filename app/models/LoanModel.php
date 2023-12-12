<?php

class LoanModel
{
    private $table = '[Loan]';
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

    public function getAllDataLoan()
    {
        $query = "SELECT Loan.*, Book.Title, Book.ISBN, Patron.FirstName FROM $this->table
        JOIN Book ON Loan.BookId = Book.BookId
        JOIN Patron ON Loan.PatronId = Patron.PatronId";
        $this->connect->query($query);
        $this->connect->execute();
        return $this->connect->resultSet();
    }

    public function addNewLoan($data)
    {
        $bookId = $this->sanitizeInput($data['BookId']);
        $patronId = $this->sanitizeInput($data['PatronId']);

        // Lock the book record to prevent concurrent updates
        $this->connect->beginTransaction();

        // Check if the book is available
        $bookModel = new BookModel();
        $currentQuantity = $bookModel->getQuantity($bookId);

        if ($currentQuantity > 0) {
            // Update the book quantity and add the loan record
            $newQuantity = $currentQuantity - 1;
            $bookModel->updateQuantity($bookId, $newQuantity);

            $loanDate = date("Y-m-d");
            $dueDate = date("Y-m-d", strtotime($loanDate . '+ 7 days'));
            $query = "INSERT INTO $this->table (BookId, PatronId, LoanDate, DueDate) VALUES (:bookId, :patronId, :loanDate, :dueDate)";
            $this->connect->query($query);
            $this->connect->bind('bookId', $bookId);
            $this->connect->bind('patronId', $patronId);
            $this->connect->bind('loanDate', $loanDate);
            $this->connect->bind('dueDate', $dueDate);
            $this->connect->execute();
            $this->connect->commit();

            return $this->connect->lastInsertId();
        } else {
            // Book is not available, rollback the transaction
            $this->connect->rollback();
            return false;
        }
    }

    public function returnBook($data)
    {
        $bookId = $this->sanitizeInput($data['BookId']);
        $patronId = $this->sanitizeInput($data['PatronId']);
        $return = $this->sanitizeInput($data['ReturnDate']);
        $query = "UPDATE $this->table SET ReturnDate = :return WHERE bookId = :bookId AND patronId = :patronId";
        $this->connect->query($query);
        $this->connect->bind('bookId', $bookId);
        $this->connect->bind('patronId', $patronId);
        $this->connect->bind('return', $return);
        $this->connect->execute();
        return $this->connect->resultSet();

        $bookModel = new BookModel();
        $currentQuantity = $bookModel->getQuantity($bookId);

        $newQuantity = $currentQuantity + 1;

        $bookModel->updateQuantity($bookId, $newQuantity);
    }

    public function checkOverdueLoans()
    {
        $query = "SELECT * FROM $this->table WHERE DueDate < CURDATE() AND ReturnDate IS NULL";
        $this->connect->query($query);
        $this->connect->execute();
        $overdueLoans = $this->connect->resultSet();

        $fineModel = new FineModel();

        foreach ($overdueLoans as $loan) {
            $patronId = $loan['PatronId'];
            $amount = 10000;
            $status = "Unpaid";
            $due = date("Y-m-d", strtotime($loan['DueDate'] . '+ 7 days'));

            $fineModel->addNewFine($patronId, $amount, $status, $due);
        }

        $query = "UPDATE $this->table SET ReturnDate = CURDATE() WHERE DueDate < CURDATE() AND ReturnDate IS NULL";
        $this->connect->query($query);
        $this->connect->execute();

        return $this->connect->resultSet();
    }

    public function getOlderLoan($patronId)
    {
        $query = "SELECT Loan.*, Book.Title, Book.ISBN FROM $this->table 
        JOIN Book ON Loan.BookId = Book.BookId 
        WHERE Loan.PatronId = :patronId 
        ORDER BY Loan.LoanDate DESC";
        $this->connect->query($query);
        $this->connect->bind('patronId', $patronId);
        $this->connect->execute();
        return $this->connect->resultSet();
    }

    public function getNotReturned()
    {
        // dapatkan judul buku, nama peminjam, dan tanggal peminjaman
        $query = "SELECT Loan.*, Book.Title, Patron.FirstName FROM $this->table
        JOIN Book ON Loan.BookId = Book.BookId
        JOIN Patron ON Loan.PatronId = Patron.PatronId
        WHERE Loan.ReturnDate IS NULL";
        $this->connect->query($query);
        $this->connect->execute();
        return $this->connect->resultSet();
    }

    public function getLoanByTitle($data)
    {
        $query = "SELECT Loan.*, Book.Title, Book.ISBN, Patron.FirstName FROM $this->table
        JOIN Book ON Loan.BookId = Book.BookId
        JOIN Patron ON Loan.PatronId = Patron.PatronId
        WHERE Title LIKE :keyword";
        $this->connect->query($query);
        $this->connect->bind(':keyword', "%$data%");
        $this->connect->execute();
        return $this->connect->resultSet();
    }

    public function getLoanByISBN($data)
    {
        $query = "SELECT Loan.*, Book.Title, Book.ISBN, Patron.FirstName FROM $this->table
        JOIN Book ON Loan.BookId = Book.BookId
        JOIN Patron ON Loan.PatronId = Patron.PatronId
        WHERE ISBN LIKE :keyword";
        $this->connect->query($query);
        $this->connect->bind(':keyword', "%$data%");
        $this->connect->execute();
        return $this->connect->resultSet();
    }

    public function getLoanByPatron($data)
    {
        $query = "SELECT Loan.*, Book.Title, Book.ISBN, Patron.FirstName FROM $this->table
        JOIN Book ON Loan.BookId = Book.BookId
        JOIN Patron ON Loan.PatronId = Patron.PatronId
        WHERE FirstName LIKE :keyword";
        $this->connect->query($query);
        $this->connect->bind(':keyword', "%$data%");
        $this->connect->execute();
        return $this->connect->resultSet();
    }
}
