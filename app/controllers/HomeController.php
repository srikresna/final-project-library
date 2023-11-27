<?php


class Home extends Controller {
    public function index() {
        $data['title'] = 'Home';
        $this->view('templates/header', $data);
        $this->view('home/index');
    }

    public function login() {
        $data['title'] = 'Login';
        $this->view('templates/header', $data);
        $this->view('home/login');
    }

    public function team() {
        $data['title'] = 'Team';
        $this->view('templates/header', $data);
        $this->view('home/team');
    }
}