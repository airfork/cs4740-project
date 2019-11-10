<?php

class Books extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('book_model');
        $this->load->helper('url_helper');
        $this->load->library('session');
        $this->load->library('encryption');
    }

    public function view_all() {
        $data['books'] = $this->book_model->get_books();
        $this->load->view('books/index', $data);
    }

    public function checkout() {
        $this->validate();
        $isbn = $this->input->post('book');
        $checked_out = $this->book_model->checked_out($isbn);
        if ($checked_out['count'] == 1) {
            header('Content-Type: application/json');
            echo json_encode(array('issue' => 'This book has already been checked out', 'valid' => false, 'csrf_token' => $this->security->get_csrf_hash()));
            return;
        }
        $id = $this->encryption->decrypt($_SESSION['id']);
        $checkoutCount = $this->book_model->checkout_count($id);
        if ($checkoutCount['count'] >= 3) {
            header('Content-Type: application/json');
            echo json_encode(array('issue' => 'You cannot checkout any more items', 'valid' => false, 'csrf_token' => $this->security->get_csrf_hash()));
            return;
        }
        $this->book_model->checkout($id, $isbn);
        header('Content-Type: application/json');
        echo json_encode(array('valid' => true, 'csrf_token' => $this->security->get_csrf_hash()));
    }

    private function validate() {
        if (empty($_SESSION['id'])) {
            redirect('/login', 'refresh');
        }
    }
}