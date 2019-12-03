<?php

class Users extends CI_Controller {
    private $web;
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('user_model');
        $this->load->model('book_model');
        $this->load->model('movie_model');
        $this->load->model('article_model');
        $this->load->model('space_model');
        $this->load->model('librarian_model');
        $this->load->model('studyspaces_model');
        $this->load->helper('url_helper');
        $this->load->library('encryption');
        $this->web = base_url();
        if (getenv('PRODUCTION')) {
            $this->web = 'https://library4750.herokuapp.com/';
        }
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
        $data['logged_in'] = $this->is_signed_in();
        $data['homepage'] = true;
        if ($this->is_librarian()) {
            $data['librarian'] = true;
        }
        $this->load->view('index', $data);
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
            redirect($this->web, 'refresh');
        }
    }

    public function search_page() {
        $data['csrf'] = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $data['logged_in'] = $this->is_signed_in();
        if ($this->is_librarian()) {
            $data['librarian'] = true;
        }
        $data['searchpage'] = true;
        $this->load->view('users/search', $data);
    }

    public function search() {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_message('check_type', 'Please provide a valid type for the search');
        $this->form_validation->set_rules(
            'type', 'type', 'required|callback_check_type',
            array('check_type', 'Please provide a valid type for the search.')
        );
        $this->form_validation->set_rules('search', 'search term', 'trim|required|min_length[2]|max_length[100]');
        if ($this->form_validation->run() === FALSE) {
            $data['csrf'] = array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
            );
            $data['searchpage'] = true;
            $data['logged_in'] = $this->is_signed_in();
            $this->load->view('users/search', $data);
        } else {
            switch ($this->input->post('type')) {
                case 'books':
                    $books = $this->book_model->get_books($this->sanitize($this->input->post('search')));
                    $data['csrf'] = array(
                        'name' => $this->security->get_csrf_token_name(),
                        'hash' => $this->security->get_csrf_hash()
                    );
                    $data['books'] = $books;
                    $data['logged_in'] = $this->is_signed_in();
                    $data['searchpage'] = true;
                    $this->load->view('users/search', $data);
                    break;
                case 'movies':
                    $movies = $this->movie_model->get($this->sanitize($this->input->post('search')));
                    $data['csrf'] = array(
                        'name' => $this->security->get_csrf_token_name(),
                        'hash' => $this->security->get_csrf_hash()
                    );
                    $data['movies'] = $movies;
                    $data['type'] = 'movies';
                    $data['logged_in'] = $this->is_signed_in();
                    $data['searchpage'] = true;
                    $this->load->view('users/search', $data);
                    break;
                case 'articles':
                    $articles = $this->article_model->get($this->sanitize($this->input->post('search')));
                    $data['csrf'] = array(
                        'name' => $this->security->get_csrf_token_name(),
                        'hash' => $this->security->get_csrf_hash()
                    );
                    $data['articles'] = $articles;
                    $data['type'] = 'articles';
                    $data['logged_in'] = $this->is_signed_in();
                    $data['searchpage'] = true;
                    $this->load->view('users/search', $data);
                    break;
            }
        }
    }

    public function reserve(){
        $study_spaces = $this->studyspaces_model->get();
        $logged_in = $this->is_signed_in();
        $csrf = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $data = array('study_spaces' => $study_spaces, 'logged_in' => $logged_in, 'csrf' => $csrf);
        $this->load->view('users/reserve', $data);
    }

    public function remove_inventory(){
        $study_spacesud = $this->studyspaces_model->getfull();
        $items = $this->studyspaces_model->getitems();
        $logged_in = $this->is_signed_in();
        $csrf = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $data = array('study_spacesud' => $study_spacesud, 'items' => $items, 'logged_in' => $logged_in, 'csrf' => $csrf);
        $this->load->view('users/removeinventory', $data);
    }

    public function add_inventory(){
        $study_spacesadd = $this->studyspaces_model->getfull();
        $itemsadd = $this->studyspaces_model->getitems();
        $logged_in = $this->is_signed_in();
        $csrf = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $data = array('study_spacesadd' => $study_spacesadd, 'itemsadd' => $itemsadd, 'logged_in' => $logged_in, 'csrf' => $csrf);
        $this->load->view('users/addinventory', $data);
    }

    public function logout() {
        session_unset();
        session_destroy();
        redirect($this->web, 'refresh');
    }

    // Checks username and password
    public function check_user(): bool {
        $this->signed_in();
        $email = $this->sanitize($this->input->post('email'));
        $password = $this->input->post('password');
        if(!$this->user_model->check_user($email, $password)) {
            if (!$this->librarian_model->check_user($email, $password)) {
                $this->form_validation->set_message('check_user', 'Email or password is incorrect, please try again.');
                return FALSE;
            }
        }
        return TRUE;
    }

    public function check_type(): bool {
        $type = $this->sanitize($this->input->post('type'));
        if ($type === 'books' || $type === 'movies' || $type === 'articles') {
            return TRUE;
        }
        return FALSE;
    }
    
    public function accountpage() {
        if (!$this->is_signed_in()) {
            redirect($this->web, 'refresh');
        }
        $data['id'] = $this->encryption->decrypt($_SESSION['id']);
        $data['logged_in'] = $this->is_signed_in();
        $data['accountpage'] = true;
        $data['deadline'] = $this->book_model->get_book_deadline($data['id']);
        $data['deadline_aj'] = $this->article_model->get_aj_deadline($data['id']);
        $data['deadline_movie'] = $this->movie_model->get_movie_deadline($data['id']);
        $data['deadline_space'] = $this->space_model->get_space_deadline($data['id']);

        $this->load->view('users/accountpage', $data);
    }

    public function checkouthistory() {
        if (empty($_SESSION['id'])) {
            redirect($this->web, 'refresh');
        }
        $data['id'] = $this->encryption->decrypt($_SESSION['id']);
        $data['logged_in'] = $this->is_signed_in();
        $data['book_hist'] = $this->book_model->get_book_hist($data['id']);
        $data['aj_hist'] = $this->article_model->get_aj_hist($data['id']);
        $data['movie_hist'] = $this->movie_model->get_movie_hist($data['id']);
        $data['space_hist'] = $this->space_model->get_space_hist($data['id']);

        $this->load->view('users/checkouthistory', $data);
    }

    public function updateuser() {
        if (empty($_SESSION['id'])) {
            redirect($this->web, 'refresh');
        }
        $id = $this->encryption->decrypt($_SESSION['id']);
        $name = $this->sanitize($this->input->post('name'));
        $email = $this->sanitize($this->input->post('email'));
        $password = $this->input->post('password');
        $hash = password_hash($this->input->post('password'), PASSWORD_DEFAULT);

        if (strlen($this->sanitize($name)) < 3 ) {
            header('Content-Type: application/json');
            echo json_encode(array('issue' => 'Your name must be at least three characters long', 'valid' => false, 'csrf_token' => $this->security->get_csrf_hash()));
            return;
        }

        if (strlen($this->sanitize($email)) === 0 ) {
            header('Content-Type: application/json');
            echo json_encode(array('issue' => 'The email field cannot be blank', 'valid' => false, 'csrf_token' => $this->security->get_csrf_hash()));
            return;
        }

        if (strlen($password) < 8 ) {
            header('Content-Type: application/json');
            echo json_encode(array('issue' => 'Your password must be at least eight characters long', 'valid' => false, 'csrf_token' => $this->security->get_csrf_hash()));
            return;
        }
        $this->user_model->updating($id, $name, $email, $hash);
        header('Content-Type: application/json');
        echo json_encode(array('valid' => true, 'csrf_token' => $this->security->get_csrf_hash()));
    }

    public function editinfo() {
        if (!$this->is_signed_in()) {
            redirect($this->web, 'refresh');
        }
        $data['id'] = $this->encryption->decrypt($_SESSION['id']);
        $data['logged_in'] = $this->is_signed_in();
        $data['name'] = $this->user_model->get_name($data['id']);
        $data['email'] = $this->user_model->get_email($data['id']);
        $data['csrf'] = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );

        $this->load->view('users/editinfo', $data);
    }

    private function is_signed_in() : bool {
        if (empty($_SESSION['id'])) {
            return false;
        }
        return true;
    }

    private function is_librarian() : bool {
        if (empty($_SESSION['lib'])) {
            return false;
        }
        return true;
    }

    private function sanitize($data) {
        return htmlspecialchars(trim(stripslashes($data)));
    }

    private function signed_in() {
        if (!empty($_SESSION['id'])) {
            redirect($this->web, 'refresh');
        }
    }
}
