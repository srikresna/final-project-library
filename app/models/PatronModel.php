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
        $query = "SELECT * FROM $this->table";
        $this->connect->query($query);
        $this->connect->execute();
        return $this->connect->resultSet();
    }

    public function addNewPatron($data)
    {
        $fname = $this->sanitizeInput($data['FirstName']);
        $lname = $this->sanitizeInput($data['LastName']);
        $phone = $this->sanitizeInput($data['PhoneNumber']);
        $address = $this->sanitizeInput($data['Address']);
        $query = "INSERT INTO $this->table VALUES (:fname, :lname, :phone, :address)";
        $this->connect->query($query);
        $this->connect->bind('name', $fname);
        $this->connect->bind('name', $lname);
        $this->connect->bind('address', $address);
        $this->connect->bind('phone', $phone);
        $this->connect->execute();
        return $this->connect->resultSet();
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