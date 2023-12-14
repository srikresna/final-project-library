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

    public function editBook() {
        session_start();
        if ($_SESSION['role'] != 'LibraryStaff') {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['isbn'])) {
                $data = [
                    'isbn' => $_POST['isbn'],
                    'title' => $_POST['title'],
                    'author' => $_POST['author'],
                    'genre' => $_POST['genre'],
                    'publication_year' => $_POST['publication_year'],
                    'quantity_available' => $_POST['quantity_available'],
                    'quantity_total' => $_POST['quantity_total']
                ];
                $this->model('BookModel')->updateBook($data);

                header('Location: ' . BASE_URL . '/staff/bookshelf');
                exit;
            }
        }

        // DEV NOTE: the ISBN value in this version is cannot edited
    }

    public function deleteBook()
    {
        session_start();
        if ($_SESSION['role'] != 'LibraryStaff') {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }
    
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['isbn'])) {
                $this->model('BookModel')->deleteBook($_POST['isbn']);
                header('Location: ' . BASE_URL . '/staff/bookshelf');
                exit;
            }
        }
    }

    public function addBook()
    {
        session_start();
        if ($_SESSION['role'] != 'LibraryStaff') {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['isbn'])) {
                $data = [
                    'isbn' => $_POST['isbn'],
                    'title' => $_POST['title'],
                    'author' => $_POST['author'],
                    'genre' => $_POST['genre'],
                    'publication_year' => $_POST['publication_year'],
                    'quantity_available' => $_POST['quantity_available'],
                    'quantity_total' => $_POST['quantity_total']
                ];
                $this->model('BookModel')->addNewBook($data);

                header('Location: ' . BASE_URL . '/staff/bookshelf');
                exit;
            }
        }   
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
        $data['user'] = $this->model('UserModel')->getAllDataUser();

        $data['title'] = 'Patron';
        $this->view('templates/headerStaff', $data);
        $this->view('staff/patron', $data);
    }

    public function editPatron() {
        session_start();
        if ($_SESSION['role'] != 'LibraryStaff') {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }
    
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['patronId'])) {
                $dataPatron = [
                    'patronId' => $_POST['patronId'],
                    'firstname' => $_POST['firstname'],
                    'lastname' => $_POST['lastname'],
                    'email' => $_POST['email'],
                    'phonenumber' => $_POST['phonenumber'],
                    'address' => $_POST['address']
                ];
                $dataUser = [
                    'username' => $_POST['username'],
                    'password' => $_POST['password']
                ];
                $this->model('PatronModel')->updatePatron($dataPatron);
                $this->model('UserModel')->updateUser($dataUser);
    
                header('Location: ' . BASE_URL . '/staff/patron');
                exit;
            }
        }
    }

    public function deletePatron()
    {
        session_start();
        if ($_SESSION['role'] != 'LibraryStaff') {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }
    
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['patronId'])) {
                $this->model('PatronModel')->deletePatron($_POST['patronId']);
                header('Location: ' . BASE_URL . '/staff/patron');
                exit;
            }
        }
    }

    public function addPatron()
    {
        session_start();
        if ($_SESSION['role'] != 'LibraryStaff') {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }
    
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['firstname'])) {
                $dataPatron = [
                    'firstname' => $_POST['firstname'],
                    'lastname' => $_POST['lastname'],
                    'address' => $_POST['address'],
                    'phone' => $_POST['phonenumber'],
                    'email' => $_POST['email']
                ]; 
                $this->model('PatronModel')->addNewPatron($dataPatron);
                $data['patron'] = $this->model('PatronModel')->getPatronByFirstName($_POST['firstname']);
                $dataUser = [
                    'username' => $_POST['username'],
                    'password' => $_POST['password'],
                    'role' => 'Patron',
                    'patronId' => $data['patron'][0]['PatronId']
                ];
                $this->model('UserModel')->addNewUserPatron($dataUser);

                header('Location: ' . BASE_URL . '/staff/patron');
                exit;
            }
        }
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

        $data['isbn'] = $this->model('BookModel')->getAllDataBook();
        $data['available'] = $this->model('BookModel')->getBookAvailable();
        $data['firstname'] = $this->model('PatronModel')->getAllDataPatron();

        $data['title'] = 'Loan';
        $this->view('templates/headerStaff', $data);
        $this->view('staff/loan', $data);
    }

    public function addLoan() {
        session_start();
        if ($_SESSION['role'] != 'LibraryStaff') {
            header('Location: ' . BASE_URL . '/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if (isset($_POST['patron']) && isset($_POST['isbn'])) {

                $data = [
                    'BookId' => $_POST['isbn'],
                    'PatronId' => $_POST['patron']
                ];

                $this->model('LoanModel')->addNewLoan($data);

                header('Location: ' . BASE_URL . '/staff/loan');
                exit;
            }
        }
    }

    public function markReturn() {
        session_start();
        if ($_SESSION['role'] != 'LibraryStaff') {
            header('Location: ' . BASE_URL . '/login');
        } 

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['patronId']) && isset($_POST['bookId'])) {
                $data = [
                    'BookId' => $_POST['bookId'],
                    'PatronId' => $_POST['patronId'],
                    'ReturnDate' => $_POST['returnDate']
                ];
                
                $this->model('LoanModel')->returnBook($data);

                header('Location: ' . BASE_URL . '/staff/loan');
                exit;
            }
        }
    }

    public function assessFine() {
        session_start();
        if ($_SESSION['role'] != 'LibraryStaff') {
            header('Location: ' . BASE_URL . '/login');
        } 

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['patronId']) && isset($_POST['amount']) && isset($_POST['due'])) {
                $data = [
                    'PatronId' => $_POST['patronId'],
                    'Amount' => $_POST['amount'],
                    'PaymentStatus' => 'Unpaid',
                    'DueDate' => $_POST['due']
                ];
                $this->model('FineModel')->addNewFine($data);

                header('Location: ' . BASE_URL . '/staff/loan');
                exit;
            }
        }
    }

    public function deleteLoan() {
        session_start();
        if ($_SESSION['role'] != 'LibraryStaff') {
            header('Location: ' . BASE_URL . '/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['patronId']) && isset($_POST['bookId'])) {
                $data = [
                    'BookId' => $_POST['bookId'],
                    'PatronId' => $_POST['patronId']
                ];

                $this->model('LoanModel')->deleteLoan($data);

                header('Location: ' . BASE_URL . '/staff/loan');
                exit;
            }
        }
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

        $data['isbn'] = $this->model('BookModel')->getAllDataBook();
        $data['firstname'] = $this->model('PatronModel')->getAllDataPatron();

        $data['title'] = 'Reservation';
        $this->view('templates/headerStaff', $data);
        $this->view('staff/reservation', $data);
    }

    public function addReserve() {
        session_start();
        if ($_SESSION['role'] != 'LibraryStaff') {
            header('Location: ' . BASE_URL . '/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['patron']) && isset($_POST['isbn']) && isset($_POST['date'])) {
                $data = [
                    'PatronId' => $_POST['patron'],
                    'BookId' => $_POST['isbn'],
                    'ReservationDate' => $_POST['date']
                ];
                $this->model('ReservationModel')->addNewReservation($data);

                header('Location: ' . BASE_URL . '/staff/reservation');
                exit;
            }
        }
    }

    public function deleteReserve() {
        session_start();
        if ($_SESSION['role'] != 'LibraryStaff') {
            header('Location: ' . BASE_URL . '/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['patronId']) && isset($_POST['isbn']) && isset($_POST['reserveDate'])) {
                $data = [
                    'PatronId' => $_POST['patronId'],
                    'isbn' => $_POST['isbn'],
                    'ReservationDate' => $_POST['reserveDate']
                ];
                $res = $this->model('ReservationModel')->getAllDataReservation();
                $targetedRes = [];
                foreach ($res as $r) {
                    if ($r['PatronId'] == $data['PatronId'] && $r['ISBN'] == $data['isbn'] && $r['ReservationDate'] == $data['ReservationDate']) {
                        $targetedRes = $r;
                        break;
                    }
                }

                $this->model('ReservationModel')->deleteReservation($targetedRes['ReservationId']);

                header('Location: ' . BASE_URL . '/staff/reservation');
                exit;
            }
        }
    }

    public function editReserve() {
        session_start();
        if ($_SESSION['role'] != 'LibraryStaff') {
            header('Location: ' . BASE_URL . '/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['firstname'])) {
                $bookId = $this->model('BookModel')->getBookByISBN($_POST['isbn']);
                $reserveId = $this->model('ReservationModel')->getReservationByISBN($_POST['isbn']);
                $data = [
                    'reserveId' => $reserveId[0]['ReservationId'],
                    'bookId' => $bookId[0]['BookId'],
                    'patronId' => $_POST['patronId'],
                    'date' => $_POST['date']
                ];

                $this->model('ReservationModel')->updateReservation($data);

                header('Location: ' . BASE_URL . '/staff/reservation');
                exit;
            }
            
        }
    }

    public function fine() {
        session_start();
        if ($_SESSION['role'] != 'LibraryStaff') {
            header('Location: ' . BASE_URL . '/login');
        }

        $data['fine'] = $this->model('FineModel')->getAllDataFine();

        $data['title'] = 'Fine';
        $this->view('templates/headerStaff', $data);
        $this->view('staff/fine', $data);
    }

    public function markPaid() {
        session_start();
        if ($_SESSION['role'] != 'LibraryStaff') {
            header('Location: ' . BASE_URL . '/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['patronId'])) {
                $data = [
                    'PatronId' => $_POST['patronId']
                ];
                $this->model('FineModel')->paidFine($data);

                header('Location: ' . BASE_URL . '/staff/fine');
                exit;
            }
        }
    }

    public function checkOverdueFine() {
        session_start();
        if ($_SESSION['role'] != 'LibraryStaff') {
            header('Location: ' . BASE_URL . '/login');
        }

        $this->model('FineModel')->checkOverdueFine();

        header('Location: ' . BASE_URL . '/staff/fine');
        exit;
    }

    public function report()
    {
        session_start();
        if ($_SESSION['role'] != 'LibraryStaff') {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }

        if (isset($_POST['keyword'])) {
            $keyword = $_POST['keyword'];
            $type = isset($_POST['type']) ? $_POST['type'] : 'name';
            $data['report'] = $this->model('LoanModel')->getReportSpecificUser($keyword);
        } else {
            $data['report'] = $this->model('LoanModel')->getReportUser();
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
