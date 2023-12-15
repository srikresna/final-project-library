<?php
error_reporting(E_ALL);
class Login extends Controller
{
    public function index()
    {
        $data['title'] = 'Login';
        $this->view('templates/header', $data);
        $this->view('login/index');
    }

    public function loginProcess()
    {
        session_start();
        $userModel = $this->model('UserModel');
        $username = $_POST['username'];
        $password = $_POST['password'];
        $user = $userModel->getDataUser($username, $password);
        
        if ($user && isset($user[0]['Role']) && $user[0]['Role'] == 'Patron') {
            $_SESSION['username'] = $user[0]['Username'];
            $_SESSION['role'] = $user[0]['Role'];
            $_SESSION['PatronId'] = $user[0]['PatronId'];
            header('Location: ' . BASE_URL . '/patron/index');
            exit;
        } else {
            $_SESSION['username'] = $user[0]['Username'];
            $_SESSION['role'] = $user[0]['Role'];
            $_SESSION['StaffId'] = $user[0]['LibraryStaffId'];
            header('Location: ' . BASE_URL . '/staff/index');
            exit;
        }
    }
}
