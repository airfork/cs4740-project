<?php

class Studyspaces extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('studyspaces_model');
        $this->load->helper('url_helper');
        $this->load->library('session');
        $this->load->library('encryption');
    }

    public function reserve() {
        if (!$this->validate()) {
            header('Content-Type: application/json');
            echo json_encode(array('issue' => 'You need to be signed in to reserve a study space', 'valid' => false, 'csrf_token' => $this->security->get_csrf_hash()));
            return;
        }
        $space_id = $this->input->post('study_spaces');
        $already_reserved = $this->study_spaces_model->already_booked($space_id);
        if ($already_reserved['count'] >= 1) {
            header('Content-Type: application/json');
            echo json_encode(array('issue' => 'This study space has already been reserved', 'valid' => false, 'csrf_token' => $this->security->get_csrf_hash()));
            return;
        }
        $id = $this->encryption->decrypt($_SESSION['id']);
        $checkoutCount = $this->book_model->booking_count($id);
        if ($checkoutCount['count'] >= 1) {
            header('Content-Type: application/json');
            echo json_encode(array('issue' => 'You cannot reserve more than one study space within 2 hours', 'valid' => false, 'csrf_token' => $this->security->get_csrf_hash()));
            return;
        }
        $this->book_model->checkout($id, $space_id);
        header('Content-Type: application/json');
        echo json_encode(array('valid' => true, 'csrf_token' => $this->security->get_csrf_hash()));
    }

    private function validate() : bool {
        if (empty($_SESSION['id'])) {
            return false;
        }
        return true;
    }
}