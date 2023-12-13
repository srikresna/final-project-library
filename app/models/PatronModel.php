<?php

class PatronModel
{
    private $table = '[Patron]';
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

    public function getAllDataPatron()
    {   

        // $query = "SELECT * FROM $this->table";
        $query = "SELECT Patron.*, [User].Username, [User].Password FROM $this->table
        JOIN [User] ON Patron.PatronId = [User].PatronId";
        $this->connect->query($query);
        $this->connect->execute();
        return $this->connect->resultSet();
    }

    public function addNewPatron($data)
    {
        $fname = $this->sanitizeInput($data['firstname']);
        $lname = $this->sanitizeInput($data['lastname']);
        $phone = $this->sanitizeInput($data['phone']);
        $address = $this->sanitizeInput($data['address']);
        $mail = $this->sanitizeInput($data['email']);
        $query = "INSERT INTO Patron (FirstName, LastName, PhoneNumber, Address, Email) VALUES (:fname, :lname, :phone, :address, :mail)";
        $this->connect->query($query);
        $this->connect->bind('fname', $fname);
        $this->connect->bind('lname', $lname);
        $this->connect->bind('phone', $phone);
        $this->connect->bind('address', $address);
        $this->connect->bind('mail', $mail);
        $this->connect->execute();
        
    }

    public function updatePatron($data)
    {
        $fname = $this->sanitizeInput($data['firstname']);
        $lname = $this->sanitizeInput($data['lastname']);
        $mail = $this->sanitizeInput($data['email']);
        $phone = $this->sanitizeInput($data['phonenumber']);
        $address = $this->sanitizeInput($data['address']);
        $query = "UPDATE $this->table SET FirstName = :fname, LastName = :lname, Email = :mail, PhoneNumber = :phone, Address = :address WHERE PatronId = :id";
        $this->connect->query($query);
        $this->connect->bind('fname', $fname);
        $this->connect->bind('lname', $lname);
        $this->connect->bind('mail', $mail);
        $this->connect->bind('phone', $phone);
        $this->connect->bind('address', $address);
        $this->connect->bind('id', $data['patronId']);
        $this->connect->execute();
        return $this->connect->rowCount();
    }

    public function deletePatron($patronId)
    {
        $query = "DELETE FROM $this->table WHERE PatronId = :id";
        $this->connect->query($query);
        $this->connect->bind('id', $patronId);
        $this->connect->execute();
        $this->connect->rowCount();
    }

    public function getPatronByFirstName($data)
    {
        $data = $this->sanitizeInput($data);
        $this->connect->query("SELECT * FROM $this->table WHERE FirstName LIKE :keyword");
        $this->connect->bind(':keyword', "%$data%");
        $this->connect->execute();
        return $this->connect->resultSet();
    }

    public function getPatronByAddress($data)
    {
        $data = $this->sanitizeInput($data);
        $this->connect->query("SELECT * FROM $this->table WHERE Address LIKE :keyword");
        $this->connect->bind(':keyword', "%$data$");
        $this->connect->execute();
        return $this->connect->resultSet();
    }

    public function getPatronByPhone($data)
    {
        $data = $this->sanitizeInput($data);
        $this->connect->query("SELECT * FROM $this->table WHERE PhoneNumber LIKE :keyword");
        $this->connect->bind(':keyword', "%$data%");
        $this->connect->execute();
        return $this->connect->resultSet();
    }
}

?>