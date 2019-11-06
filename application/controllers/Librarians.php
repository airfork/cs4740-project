<?php

class Librarians extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('user_model');
        $this->load->model('librarian_model');
        $this->load->helper('url_helper');
        $this->load->library('email');
    }

    public function register() {
        $this->validate_lib();
        $data['csrf'] = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->load->view('librarians/register', $data);
    }

    public function create() {
        $this->validate_lib();
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
            $this->email_password($this->input->post('email'));
            redirect('/', 'refresh');
        }
    }

    private function email_password($email) {
        $this->load->config('email');
        $this->email->from($this->config->item('smtp_user'), "Tunji Afolabi-Brown");
        $this->email->to($email);
        $this->email->subject('THE Library Account Info');
        $this->email->message('An account has been created for you. Your email is '. $email.' and your password is '.$this->random_password());
        $this->email->set_newline("\r\n");
        if (!$this->email->send()) {
            show_error($this->email->print_debugger());
        }
    }

    private function random_password() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }

    private function validate() {
        if (empty($_SESSION['id'])) {
            redirect('/login', 'refresh');
        }
    }

    private function validate_lib() {
        $this->validate();
        if (empty($_SESSION['lib'])) {
            redirect('/', 'refresh');
        }
    }
}
