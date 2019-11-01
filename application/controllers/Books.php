<?php

class Books extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('book_model');
        $this->load->helper('url_helper');
        $this->load->library('session');
    }

    public function view_all() {
        $data['books'] = $this->book_model->get_books();
        $this->load->view('books/index', $data);
    }

    public function search_page() {
        $this->validate();
        $this->load->view('books/search');
    }

    private function validate() {
        if (empty($_SESSION['id'])) {
            redirect('/login', 'refresh');
        }
    }
}