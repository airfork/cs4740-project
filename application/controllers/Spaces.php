<?php

class Spaces extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('space_model');
        $this->load->helper('url_helper');
        $this->load->library('session');
        $this->load->library('encryption');
    }

    public function deadline() {
        $id = $this->encryption->decrypt($_SESSION['id']);
        $data['deadline'] = $this->space_model->get_space_deadline($id);
        $this->load->view('sapces/deadlines', $data);
    }

    public function history() {
        $id = $this->encryption->decrypt($_SESSION['id']);
        $data['hist'] = $this->book_model->get_book_hist($id);
        $this->load->view('books/history', $data);
    }

    private function validate() : bool {
        if (empty($_SESSION['id'])) {
            return false;
        }
        return true;
    }
}