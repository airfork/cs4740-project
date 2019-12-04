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

    public function download_studyhist() {
        $id = $this->encryption->decrypt($_SESSION['id']);
        $this->space_model->get_space_hist($id, TRUE);
        $this->load->helper('download');
        force_download('space_checkout.csv', NULL);
    }

    public function reserve() {
        if (!$this->validate()) {
            header('Content-Type: application/json');
            echo json_encode(array('issue' => 'You need to be signed in to reserve a study space', 'valid' => false, 'csrf_token' => $this->security->get_csrf_hash()));
            return;
        }
        if ($this->validate_lib()) {
            header('Content-Type: application/json');
            echo json_encode(array('issue' => 'You cannot reserve spaces as a Librarian', 'valid' => false, 'csrf_token' => $this->security->get_csrf_hash()));
            return;
        }
        $space_id = $this->input->post('space_id');
        $already_reserved = $this->space_model->already_booked($space_id);
        if ($already_reserved['count'] >= 1) {
            header('Content-Type: application/json');
            echo json_encode(array('issue' => 'This study space has already been reserved', 'valid' => false, 'csrf_token' => $this->security->get_csrf_hash()));
            return;
        }
        $id = $this->encryption->decrypt($_SESSION['id']);
        $checkoutCount = $this->space_model->booking_count($id);
        if ($checkoutCount['count'] >= 1) {
            header('Content-Type: application/json');
            echo json_encode(array('issue' => 'You cannot reserve more than one study space within 2 hours', 'valid' => false, 'csrf_token' => $this->security->get_csrf_hash()));
            return;
        }
        $this->space_model->checkout($id, $space_id);
        header('Content-Type: application/json');
        echo json_encode(array('valid' => true, 'csrf_token' => $this->security->get_csrf_hash()));
    }

    public function add_inventory() {
        if (!$this->validate()) {
            header('Content-Type: application/json');
            echo json_encode(array('issue' => 'You need to be signed in to reserve a study space', 'valid' => false, 'csrf_token' => $this->security->get_csrf_hash()));
            return;
        }
        if (empty($_SESSION['lib'])) {
            header('Content-Type: application/json');
            echo json_encode(array('issue' => 'You must be a librarian to update the inventory', 'valid' => false, 'csrf_token' => $this->security->get_csrf_hash()));
            return;
        }
        $item_id = $this->input->post('item_id');
        $space_id = $this->input->post('space_id');
        $already_contains = $this->space_model->already_contains($item_id, $space_id);
        if ($already_contains['count'] >= 1) {
            header('Content-Type: application/json');
            echo json_encode(array('issue' => 'This study space already contains the item', 'valid' => false, 'csrf_token' => $this->security->get_csrf_hash()));
            return;
        }
        $this->space_model->add_inventory($item_id, $space_id);
        header('Content-Type: application/json');
        echo json_encode(array('valid' => true, 'csrf_token' => $this->security->get_csrf_hash()));
    }

    public function remove_inventory() {
        if (!$this->validate()) {
            header('Content-Type: application/json');
            echo json_encode(array('issue' => 'You need to be signed in to reserve a study space', 'valid' => false, 'csrf_token' => $this->security->get_csrf_hash()));
            return;
        }
        if (empty($_SESSION['lib'])) {
            header('Content-Type: application/json');
            echo json_encode(array('issue' => 'You must be a librarian to update the inventory', 'valid' => false, 'csrf_token' => $this->security->get_csrf_hash()));
            return;
        }
        $item_id = $this->input->post('item_id');
        $space_id = $this->input->post('space_id');
        $already_contains = $this->space_model->already_contains($item_id, $space_id);
        if ($already_contains['count'] < 1) {
            header('Content-Type: application/json');
            echo json_encode(array('issue' => 'This study space does not currently contain the item', 'valid' => false, 'csrf_token' => $this->security->get_csrf_hash()));
            return;
        }
        $this->space_model->remove_inventory($item_id, $space_id);
        header('Content-Type: application/json');
        echo json_encode(array('valid' => true, 'csrf_token' => $this->security->get_csrf_hash()));
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