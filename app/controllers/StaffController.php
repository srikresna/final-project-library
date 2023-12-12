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
        $this->view('templates/headerStaff', $data);
        $this->view('staff/index', $data);
    }

    public function bookshelf()
    {
        session_start();
        if ($_SESSION['role'] != 'LibraryStaff') {
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
        $this->view('templates/headerStaff', $data);
        $this->view('staff/bookshelf', $data);
    }

    public function patron()
    {
        session_start();
        if ($_SESSION['role'] != 'LibraryStaff') {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }

        if (isset($_POST['keyword'])) {
            $keyword = $_POST['keyword'];
            $type = isset($_POST['type']) ? $_POST['type'] : 'firstname';
            if ($type == 'firstname') {
                $data['patron'] = $this->model('PatronModel')->getPatronByFirstName($keyword);
            } else if ($type == 'address') {
                $data['patron'] = $this->model('PatronModel')->getPatronByAddress($keyword);
            } else if ($type == 'phone') {
                $data['patron'] = $this->model('PatronModel')->getPatronByPhone($keyword);
            }
        } else {
            $data['patron'] = $this->model('PatronModel')->getAllDataPatron();
        }

        $data['title'] = 'Patron';
        $this->view('templates/headerStaff', $data);
        $this->view('staff/patron', $data);
    }

    public function loan()
    {
        session_start();
        if ($_SESSION['role'] != 'LibraryStaff') {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }

        if (isset($_POST['keyword'])) {
            $keyword = $_POST['keyword'];
            $type = isset($_POST['type']) ? $_POST['type'] : 'title';
            if ($type == 'title') {
                $data['loans'] = $this->model('LoanModel')->getLoanByTitle($keyword);
            } else if ($type == 'isbn') {
                $data['loans'] = $this->model('LoanModel')->getLoanByISBN($keyword);
            } else if ($type == 'patron') {
                $data['loans'] = $this->model('LoanModel')->getLoanByPatron($keyword);
            }
        } else {
            $data['loans'] = $this->model('LoanModel')->getAllDataLoan();
        }


        $data['title'] = 'Loan';
        $this->view('templates/headerStaff', $data);
        $this->view('staff/loan', $data);
    }

    public function reservation()
    {
        session_start();
        if ($_SESSION['role'] != 'LibraryStaff') {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }

        if (isset($_POST['keyword'])) {
            $keyword = $_POST['keyword'];
            $type = isset($_POST['type']) ? $_POST['type'] : 'firstname';
            if ($type == 'firstname') {
                $data['reserve'] = $this->model('ReservationModel')->getReservationByPatron($keyword);
            } else if ($type == 'title') {
                $data['reserve'] = $this->model('ReservationModel')->getReservationByTitle($keyword);
            } else if ($type == 'isbn') {
                $data['reserve'] = $this->model('ReservationModel')->getReservationByISBN($keyword);
            }
        } else {
            $data['reserve'] = $this->model('ReservationModel')->getAllDataReservation();
        }

        $data['title'] = 'Reservation';
        $this->view('templates/headerStaff', $data);
        $this->view('staff/reservation', $data);
    }

    public function report()
    {
        session_start();
        if ($_SESSION['role'] != 'LibraryStaff') {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }

        $data['title'] = 'Report';
        $this->view('templates/headerStaff', $data);
        $this->view('staff/report', $data);
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
