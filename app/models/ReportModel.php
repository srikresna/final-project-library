<?php

class ReportModel
{
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

    public function getReportUser()
    {
        $query = "SELECT
        Patron.PatronId,
        SUM(CASE WHEN Loan.ReturnDate IS NULL THEN 1 ELSE 0 END) AS TotalNotReturned,
        SUM(CASE WHEN Loan.ReturnDate IS NOT NULL THEN 1 ELSE 0 END) AS TotalReturned,
        SUM(CASE WHEN Loan.ReturnDate IS NULL AND Loan.DueDate < CAST(GETDATE() AS DATE) THEN 1 ELSE 0 END) AS TotalOverdue,
        ISNULL(dbo.CalculateTotalFine(Patron.PatronId), 0) AS TotalFine,
        CAST(ISNULL((SELECT SUM(Amount) FROM Fine WHERE Fine.PatronId = Patron.PatronId AND PaymentStatus = 'Unpaid'), 0) AS INT) AS UnpaidFine,
        Patron.FirstName, Patron.PhoneNumber
        FROM Loan
        JOIN Patron ON Loan.PatronId = Patron.PatronId
        GROUP BY Patron.PatronId, Patron.FirstName, Patron.PhoneNumber;";
        $this->connect->query($query);
        $this->connect->execute();
        return $this->connect->resultSet();
    }
    
    public function getReportSpecificUser($keyword)
    {
        $query = "SELECT
        Patron.PatronId,
        SUM(CASE WHEN Loan.ReturnDate IS NULL THEN 1 ELSE 0 END) AS TotalNotReturned,
        SUM(CASE WHEN Loan.ReturnDate IS NOT NULL THEN 1 ELSE 0 END) AS TotalReturned,
        SUM(CASE WHEN Loan.ReturnDate IS NULL AND Loan.DueDate < CAST(GETDATE() AS DATE) THEN 1 ELSE 0 END) AS TotalOverdue,
        ISNULL(dbo.CalculateTotalFine(Patron.PatronId), 0) AS TotalFine,
        ISNULL((SELECT SUM(Amount) FROM Fine WHERE Fine.PatronId = Patron.PatronId AND PaymentStatus = 'Unpaid'), 0) AS UnpaidFine,
        Patron.FirstName, Patron.PhoneNumber
        FROM Loan
        JOIN Patron ON Loan.PatronId = Patron.PatronId
        WHERE Patron.FirstName LIKE :keyword
        GROUP BY Patron.PatronId, Patron.FirstName, Patron.PhoneNumber;";
        $this->connect->query($query);
        $this->connect->bind(':keyword', "%$keyword%");
        $this->connect->execute();
        return $this->connect->resultSet();
    }

    public function getReportBook()
    {
        $query = "SELECT
        Book.Title,
        Book.ISBN,
        SUM(CASE WHEN Loan.BookId IS NOT NULL THEN 1 ELSE 0 END) AS TotalLoaned,
        SUM(CASE WHEN Loan.ReturnDate IS NOT NULL THEN 1 ELSE 0 END) AS TotalNotReturned,
        SUM(CASE WHEN Loan.ReturnDate IS NOT NULL AND Loan.DueDate < CAST(GETDATE() AS DATE) THEN 1 ELSE 0 END) AS TotalOverdue
        FROM Book
        INNER JOIN Loan ON Book.BookId = Loan.BookId
        GROUP BY Book.Title, Book.ISBN;";
        $this->connect->query($query);
        $this->connect->execute();
        return $this->connect->resultSet();
    }
}
