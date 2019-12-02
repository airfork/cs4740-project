<?php

class Articles extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('article_model');
        $this->load->helper('url_helper');
        $this->load->library('session');
        $this->load->library('encryption');
    }

    // Checkout article
    public function checkout() {
        if (!$this->validate()) {
            header('Content-Type: application/json');
            echo json_encode(array('issue' => 'You need to be signed in to checkout an article/journal', 'valid' => false, 'csrf_token' => $this->security->get_csrf_hash()));
            return;
        }
        $author = $this->input->post('author');
        $title = $this->input->post('title');
        $pubDate = $this->input->post('pubDate');
        $checked_out = $this->article_model->checked_out($author, $title, $pubDate);
        if ($checked_out['count'] == 1) {
            header('Content-Type: application/json');
            echo json_encode(array('issue' => 'This article/journal has already been checked out', 'valid' => false, 'csrf_token' => $this->security->get_csrf_hash()));
            return;
        }
        $id = $this->encryption->decrypt($_SESSION['id']);
        $checkoutCount = $this->article_model->checkout_count($id);
        if ($checkoutCount['count'] >= 3) {
            header('Content-Type: application/json');
            echo json_encode(array('issue' => 'You cannot checkout any more articles/journals', 'valid' => false, 'csrf_token' => $this->security->get_csrf_hash()));
            return;
        }
        $this->article_model->checkout($id, $author, $title, $pubDate);
        header('Content-Type: application/json');
        echo json_encode(array('valid' => true, 'csrf_token' => $this->security->get_csrf_hash()));
    }

    public function deadline() {
        $id = $this->encryption->decrypt($_SESSION['id']);
        $data['deadline'] = $this->article_model->get_aj_deadline($id);
        $this->load->view('articles/deadlines', $data);
    }

    public function history() {
        $id = $this->encryption->decrypt($_SESSION['id']);
        $data['hist'] = $this->article_model->get_aj_hist($id);
        $this->load->view('articles/history', $data);
    }

    private function validate() : bool {
        if (empty($_SESSION['id'])) {
            return false;
        }
        return true;
    }
}