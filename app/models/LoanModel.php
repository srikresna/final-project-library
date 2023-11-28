<?php

class LoanModel{
    private $table = '[Loan]';
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

    public function getAllDataLoan() {
        $query = "SELECT * FROM $this->table";
        $this->connect->query($query);
        $this->connect->execute();
        return $this->connect->resultSet();
    }

    public function addNewLoan($data) {
        $bookID = $this->sanitizeInput($data['BookID']);
        $patronID = $this->sanitizeInput($data['PatronID']);

        // Lock the book record to prevent concurrent updates
        $this->connect->beginTransaction();

        // Check if the book is available
        $bookModel = new BookModel();
        $currentQuantity = $bookModel->getQuantity($bookID);

        if ($currentQuantity > 0) {
            // Update the book quantity and add the loan record
            $newQuantity = $currentQuantity - 1;
            $bookModel->updateQuantity($bookID, $newQuantity);

            $loanDate = date("Y-m-d");
            $dueDate = date("Y-m-d", strtotime($loanDate . '+ 7 days'));
            $query = "INSERT INTO $this->table VALUES (:BookID, :patronID, :loanDate, :dueDate)";
            $this->connect->query($query);
            $this->connect->bind('BookID', $bookID);
            $this->connect->bind('patronID', $patronID);
            $this->connect->bind('loanDate', $loanDate);
            $this->connect->bind('dueDate', $dueDate);
            $this->connect->execute();
            $this->connect->commit();

            return $this->connect->resultSet();
        } else {
            // Book is not available, rollback the transaction
            $this->connect->rollback();
            return false;
        }
    }

    public function returnBook($data) {
        $bookID = $this->sanitizeInput($data['BookID']);
        $patronID = $this->sanitizeInput($data['PatronID']);
        $return = $this->sanitizeInput($data['ReturnDate']);
        $query = "UPDATE $this->table SET ReturnDate = :return WHERE BookID = :bookID AND PatronID = :patronID";
        $this->connect->query($query);
        $this->connect->bind('bookID', $bookID);
        $this->connect->bind('patronID', $patronID);
        $this->connect->bind('return', $return);
        $this->connect->execute();
        return $this->connect->resultSet();

        $bookModel = new BookModel();
        $currentQuantity = $bookModel->getQuantity($bookID);

        $newQuantity = $currentQuantity + 1;

        $bookModel->updateQuantity($bookID, $newQuantity);
    }

    public function checkOverdueLoans() {
        $query = "SELECT * FROM $this->table WHERE DueDate < CURDATE() AND ReturnDate IS NULL";
        $this->connect->query($query);
        $this->connect->execute();
        $overdueLoans = $this->connect->resultSet();
    
        $fineModel = new FineModel();
    
        foreach ($overdueLoans as $loan) {
            $patronID = $loan['PatronID'];
            $amount = 10000;
            $status = "Unpaid";
            $due = date("Y-m-d", strtotime($loan['DueDate'] . '+ 7 days'));
    
            $fineModel->addNewFine($patronID, $amount, $status, $due);
        }
    
        $query = "UPDATE $this->table SET ReturnDate = CURDATE() WHERE DueDate < CURDATE() AND ReturnDate IS NULL";
        $this->connect->query($query);
        $this->connect->execute();
    
        return $this->connect->resultSet();
    }
}