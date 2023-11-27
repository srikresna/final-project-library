<?php

class Team extends Controller {
    public function index() {
        $data['title'] = 'Team';
        $this->view('templates/header', $data);
        $this->view('team/index');
    }
}