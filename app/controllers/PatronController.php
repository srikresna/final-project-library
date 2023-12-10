<?php

class Patron extends Controller
{
    public function index()
    {
        session_start();
        if ($_SESSION['role'] != 'Patron') {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }

        $data['title'] = 'Patron Dashboard';
        $this->view('templates/headerPatron', $data);
        $this->view('patron/index', $data);
    }

    public function bookshelf()
    {
        session_start();
        if ($_SESSION['role'] != 'Patron') {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }

        if (isset($_POST['keyword'])) {
            $keyword = $_POST['keyword'];
            $type = isset($_POST['type']) ? $_POST['type'] : 'title';
            if ($type == 'title') {
                $data['books'] = $this->model('BookModel')->getBookByTitle($keyword);
            } else if ($type == 'author') {
                $data['books'] = $this->model('BookModel')->getBookByAuthor($keyword);
            } else if ($type == 'isbn') {
                $data['books'] = $this->model('BookModel')->getBookByISBN($keyword);
            }
        } else {
            $data['books'] = $this->model('BookModel')->getAllDataBook();
        }



        $data['title'] = 'Bookshelf';
        $this->view('templates/headerPatron', $data);
        $this->view('patron/bookshelf', $data);
    }

    public function reservation()
    {
        session_start();
        if ($_SESSION['role'] != 'Patron') {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }

        $data['sessionID'] = $this->model('UserModel')->getIDUser($_SESSION['username']);

        if ($_SESSION['role'] == 'Patron') {
            $data['userID'] = $data['sessionID'][0]['PatronId'];
        } else {
            $data['userID'] = $data['sessionID'][0]['LibraryStaffId'];
        }

        $data['reserve'] = $this->model('ReservationModel')->getOlderReservation($data['userID']);

        $data['title'] = 'Reservation';

        $this->view('templates/headerPatron', $data);
        $this->view('patron/reservation', $data);
    }

    public function loan()
    {
        session_start();
        if ($_SESSION['role'] != 'Patron') {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }

        $data['sessionID'] = $this->model('UserModel')->getIDUser($_SESSION['username']);

        if ($_SESSION['role'] == 'Patron') {
            $data['userID'] = $data['sessionID'][0]['PatronId'];
        } else {
            $data['userID'] = $data['sessionID'][0]['LibraryStaffId'];
        }

        if (isset($_POST['isbn'])) {
            $isbn = $_POST['isbn'];
            $data['targetedBook'] = $this->model('BookModel')->getBookByISBN($isbn);
            $data['targetedBook'][0]['PatronId'] = $data['userID'];
            $this->model('LoanModel')->addNewLoan($data['targetedBook'][0]);
        }

        $data['loans'] = $this->model('LoanModel')->getOlderLoan($data['userID']);

        $data['title'] = 'Loan';
        $this->view('templates/headerPatron', $data);
        $this->view('patron/loan', $data);
    }

    public function return()
    {
        session_start();
        if ($_SESSION['role'] != 'Patron') {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }

        $data['title'] = 'Return';
        $this->view('templates/headerPatron', $data);
        $this->view('patron/return', $data);
    }

    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();
        header('Location: ' . BASE_URL . '/login');
        exit;
    }
}
