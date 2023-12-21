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
        $data['active_reserve'] = $this->model('ReservationModel')->getActiveReservation();
        $data['loaned'] = $this->model('LoanModel')->getNotReturned();
        $data['books'] = $this->model('BookModel')->getAllDataBook();
        $data['title'] = 'Reservation';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['isbn']) && isset($_POST['reservationDate'])) {
                $isbn = $_POST['isbn'];
                $date = $_POST['reservationDate'];
                $data['targetedBook'] = $this->model('BookModel')->getBookByISBN($isbn);
                $data['targetedBook'][0]['PatronId'] = $data['userID'];
                $data['targetedBook'][0]['ReservationDate'] = $date;
                if ($this->model('ReservationModel')->addNewReservation($data['targetedBook'][0])) {
                    header('Location: ' . BASE_URL . '/patron/reservation&status=reserve_success');
                } else {
                    header('Location: ' . BASE_URL . '/patron/reservation&status=date_taken');
                }
                exit;
            } else {
                header('Location: ' . BASE_URL . '/patron/reservation&status=failed');
                exit;
            }
        }

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

    public function markReturn()
    {
        session_start();
        if ($_SESSION['role'] != 'Patron') {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['bookId']) && isset($_POST['patronId'])) {
                $data = [
                    'bookId' => $_POST['bookId'],
                    'patronId' => $_POST['patronId']
                ];

                $this->model('LoanModel')->returnBook($data);
                header('Location: ' . BASE_URL . '/patron/loan');
                exit;
            }
        }
    }

    public function information()
    {
        session_start();
        if ($_SESSION['role'] != 'Patron') {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }

        $data['mail'] = $this->model('MailModel')->getMailById($_SESSION['PatronId']);
        $data['batchMail'] = $this->model('MailModel')->getAllBatchMail();
        $data['title'] = 'Information';
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['deleteButton'])) {
                var_dump($_POST['deleteButton']);
                
                $this->model('MailModel')->deleteMail($_POST['deleteButton']);
                header('Location: ' . BASE_URL . '/patron/information');
                exit;
            }
        }
        $this->view('templates/headerPatron', $data);
        $this->view('patron/information', $data);
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
