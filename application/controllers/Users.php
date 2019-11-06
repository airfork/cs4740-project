<?php

class Users extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('user_model');
        $this->load->model('librarian_model');
        $this->load->helper('url_helper');
    }

    public function index() {
        $this->signed_in();
        $data['csrf'] = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->load->view('users/login', $data);
    }

    public function main_page() {
        $this->load->view('index');
    }

    public function login() {
        $this->signed_in();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'email', 'required', array('required' => 'You have not provided a %s'));
        $this->form_validation->set_rules('password', 'password', 'required|callback_check_user');
        if ($this->form_validation->run() === FALSE) {
            $data['csrf'] = array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
            );
            $this->load->view('users/login', $data);
        } else {
            redirect('/', 'refresh');
        }
    }

    public function logout() {
        session_destroy();
        redirect('/', 'refresh');
    }

    // Checks username and password
    public function check_user(): bool {
        $this->signed_in();
        $email = $this->sanitize($this->input->post('email'));
        $password = $this->input->post('password');
        if(!$this->user_model->check_user($email, $password) && !$this->librarian_model->check_user($email, $password)) {
            $this->form_validation->set_message('check_user', 'Email or password is incorrect, please try again.');
            return FALSE;
        }
        return TRUE;
    }

    private function sanitize($data) {
        return htmlspecialchars(trim(stripslashes($data)));
    }

    private function signed_in() {
        if (!empty($_SESSION['id'])) {
            redirect('/', 'refresh');
        }
    }
}