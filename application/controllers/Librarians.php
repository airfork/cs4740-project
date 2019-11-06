<?php

class Librarians extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('user_model');
        $this->load->model('librarian_model');
        $this->load->helper('url_helper');
    }

    public function register() {
        $this->validateLib();
        $data['csrf'] = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->load->view('librarians/register', $data);
    }

    public function create() {
        $this->validateLib();
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
            $this->load->view('librarians/register', $data);
        } else {
            $_SESSION['id'] = $this->encryption->encrypt($this->user_model->create());
            redirect('/', 'refresh');
        }
    }

    private function validate() {
        if (empty($_SESSION['id'])) {
            redirect('/login', 'refresh');
        }
    }

    private function validateLib() {
        $this->validate();
        if (empty($_SESSION['lib'])) {
            redirect('/', 'refresh');
        }
    }
}
