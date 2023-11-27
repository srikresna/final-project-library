<?php

class Patron extends Controller {
    public function index() {
        session_start();
        if ($_SESSION['role'] != 'Patron') {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }

        $data['title'] = 'Patron Dashboard';
        $this->view('templates/header', $data);
        $this->view('patron/index', $data);
        echo "Patron Dashboard";
        echo "<br>";
        echo "Hello, " . $_SESSION['username'];
    }
}