<?php

class Users extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('user_model');
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

    public function register() {
        $data['csrf'] = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->load->view('users/register', $data);
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

    public function create() {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('encryption');
        $this->form_validation->set_rules(
            'email', 'email',
            'required|is_unique[students.email]',
            array(
                'required'      => 'You have not provided a %s.',
                'is_unique'     => 'This %s already exists.'
            )
        );
        $this->form_validation->set_rules('name', 'name', 'required|min_length[3]|max_length[100]');
        $this->form_validation->set_rules('password', 'password', 'required|min_length[8]');
        $this->form_validation->set_rules('passconf', 'password confirmation', 'required|matches[password]');
        if ($this->form_validation->run() === FALSE) {
            $data['csrf'] = array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
            );
            $this->load->view('users/register', $data);
        } else {
            $_SESSION['id'] = $this->encryption->encrypt($this->user_model->create());
            redirect('/', 'refresh');
        }
    }

    public function logout() {
        session_unset();
        session_destroy();
        redirect('/', 'refresh');
    }

    // Checks username and password
    public function check_user(): bool {
        $this->signed_in();
        $email = $this->sanitize($this->input->post('email'));
        $password = $this->input->post('password');
        if(!$this->user_model->check_user($email, $password)) {
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