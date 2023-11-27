<?php

class Staff extends Controller
{
    public function index()
    {
        session_start();
        if ($_SESSION['role'] != 'LibraryStaff') {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }

        $data['title'] = 'Staff Dashboard';
        $this->view('templates/header', $data);
        $this->view('staff/index', $data);
        echo "Staff Dashboard";
        echo "<br>";
        echo "Hello, " . $_SESSION['username'];
    }

}

?>