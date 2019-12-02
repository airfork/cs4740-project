<?php

class Books extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('book_model');
        $this->load->helper('url_helper');
        $this->load->library('session');
        $this->load->library('encryption');
    }

    public function checkout() {
        if (!$this->validate()) {
            header('Content-Type: application/json');
            echo json_encode(array('issue' => 'You need to be signed in to checkout a book', 'valid' => false, 'csrf_token' => $this->security->get_csrf_hash()));
            return;
        }
        if ($this->validate_lib()) {
            header('Content-Type: application/json');
            echo json_encode(array('issue' => 'You cannot checkout items as a Librarian', 'valid' => false, 'csrf_token' => $this->security->get_csrf_hash()));
            return;
        }
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
            echo json_encode(array('issue' => 'You cannot checkout any more books', 'valid' => false, 'csrf_token' => $this->security->get_csrf_hash()));
            return;
        }
        $this->book_model->checkout($id, $isbn);
        header('Content-Type: application/json');
        echo json_encode(array('valid' => true, 'csrf_token' => $this->security->get_csrf_hash()));
    }

    public function deadline() {
        $id = $this->encryption->decrypt($_SESSION['id']);
        $data['deadline'] = $this->book_model->get_book_deadline($id);
        $this->load->view('books/deadlines', $data);
    }

    public function history() {
        $id = $this->encryption->decrypt($_SESSION['id']);
        $data['hist'] = $this->book_model->get_book_hist($id);
        $this->load->view('books/history', $data);
    }

    public function download_bookhist() {
        $id = $this->encryption->decrypt($_SESSION['id']);
        $this->book_model->get_book_hist($id, TRUE);
        $this->load->helper('download');
        force_download('book_checkout.csv', NULL);
    }

    private function validate() : bool {
        if (empty($_SESSION['id'])) {
            return false;
        }
        return true;
    }

    // Returns true if user is librarian
    private function validate_lib() {
        if (empty($_SESSION['lib'])) {
            return false;
        }
        return true;
    }
}