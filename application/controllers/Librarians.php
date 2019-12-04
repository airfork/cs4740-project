<?php

class Librarians extends CI_Controller {
    private $web;
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('user_model');
        $this->load->model('librarian_model');
        $this->load->model('book_model');
        $this->load->model('movie_model');
        $this->load->model('article_model');
        $this->load->helper('url_helper');
        $this->load->library('email');
        $this->web = base_url();
        if (getenv('PRODUCTION')) {
            $this->web = 'https://library4750.herokuapp.com/';
        }
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
        if ($this->form_validation->run() === FALSE) {
            $data['csrf'] = array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
            );
            $this->load->view('librarians/register', $data);
        } else {
            $password = $this->random_password();
            $_SESSION['id'] = $this->encryption->encrypt($this->user_model->create($password));
            $this->email_password($this->input->post('email'), $password);
            redirect($this->web, 'refresh');
        }
    }

    private function email_password($email, $password) {
        $this->load->config('email');
        $this->email->from($this->config->item('smtp_user'), "Tunji Afolabi-Brown");
        $this->email->to($email);
        $this->email->subject('THE Library Account Info');
        $this->email->message('An account has been created for you. Your email is '. $email.' and your password is '.$password);
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
            redirect($this->web.'login', 'refresh');
        }
    }

    private function validate_lib() {
        $this->validate();
        if (empty($_SESSION['lib'])) {
            redirect($this->web, 'refresh');
        }
    }

    private function is_signed_in() : bool {
        if (empty($_SESSION['id'])) {
            return false;
        }
        return true;
    }

    
    public function delete() {
        $this->validate_lib();
        $data['logged_in'] = $this->is_signed_in();
        $data['csrf'] = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $data['librarian'] = true;
        $data['delete'] = true;
        $this->load->view('librarians/delete', $data);
    }

    public function delete_book(){
        $this->validate_lib();
        $isbn = $this->input->post('book');
        $this->book_model->delete_book($isbn);
        header('Content-Type: application/json');
        echo json_encode(array('valid' => true, 'csrf_token' => $this->security->get_csrf_hash()));

    }

    public function delete_movie(){
        $this->validate_lib();
        $title = $this->input->post('movie');
        $this->movie_model->delete_movie($title);
        header('Content-Type: application/json');
        echo json_encode(array('valid' => true, 'csrf_token' => $this->security->get_csrf_hash()));
    }

    public function delete_article(){
        $this->validate_lib();
        $title = $this->input->post('article');
        $this->article_model->delete_article($title);
        header('Content-Type: application/json');
        echo json_encode(array('valid' => true, 'csrf_token' => $this->security->get_csrf_hash()));
    }

    public function insert() {
        $this->validate_lib();
        $data['logged_in'] = $this->is_signed_in();
        $data['csrf'] = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $data['librarian'] = true;
        $data['insert'] = true;
        $this->load->view('librarians/insert', $data);
    }

    public function insert_book(){
        $this->validate_lib();
        $isbn = $this->sanitize($this->input->post('ISBN'));
        $title = $this->sanitize($this->input->post('title'));
        $author = $this->sanitize($this->input->post('author'));

        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('encryption');
        $this->form_validation->set_rules(
            'ISBN', 'ISBN',
            'required|is_unique[books.isbn]',
            array(
                'required'      => 'You have not provided a %s.',
                'is_unique'     => 'This %s already exists.'
            )
        );
        $this->form_validation->set_rules('title', 'title', 'required|min_length[3]|max_length[100]');
        $this->form_validation->set_rules('author', 'author', 'required|min_length[3]|max_length[100]');
        if ($this->form_validation->run() === FALSE) {
            $data['logged_in'] = $this->is_signed_in();
            $data['csrf'] = array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
            );
            $data['librarian'] = true;
            $this->load->view('librarians/insert', $data);
        } else {
            $data['logged_in'] = $this->is_signed_in();
            $this->book_model->insert_book($isbn, $title, $author);
            $this->load->view('librarians/insert_success', $data);
        }
    }   

    public function insert_movie(){
        $this->validate_lib();
        $title = $this->sanitize($this->input->post('title'));
        $director = $this->sanitize($this->input->post('director'));
        $releaseDate = $this->sanitize($this->input->post('releaseDate'));
        $length = $this->sanitize($this->input->post('length'));

        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('encryption');
        $this->form_validation->set_rules(
            'title', 'title',
            'required|is_unique[movies.title]',
            array(
                'required'      => 'You have not provided a %s.',
                'is_unique'     => 'This %s already exists.'
            )
        );
        $this->form_validation->set_rules('director', 'director', 'required|min_length[3]|max_length[100]');
        $this->form_validation->set_rules('releaseDate', 'releaseDate', 'required');
        $this->form_validation->set_rules('length', 'length', 'required');
        if ($this->form_validation->run() === FALSE) {
            $data['logged_in'] = $this->is_signed_in();
            $data['csrf'] = array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
            );
            $data['librarian'] = true;
            $this->load->view('librarians/insert', $data);
        } else {
            $data['logged_in'] = $this->is_signed_in();
            $this->movie_model->insert_movie($title, $director, $releaseDate, $length);
            $this->load->view('librarians/insert_success', $data);
        }
    }   

    public function insert_article(){
        $this->validate_lib();
        $title = $this->sanitize($this->input->post('title'));
        $AJauthor = $this->sanitize($this->input->post('AJauthor'));
        $pubDate = $this->sanitize($this->input->post('pubDate'));

        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('encryption');
        $this->form_validation->set_rules(
            'title', 'title',
            'required|is_unique[articles_journals.title]',
            array(
                'required'      => 'You have not provided a %s.',
                'is_unique'     => 'This %s already exists.'
            )
        );
        $this->form_validation->set_rules('AJauthor', 'AJauthor', 'required|min_length[3]|max_length[100]');
        $this->form_validation->set_rules('pubDate', 'pubDate', 'required');
        if ($this->form_validation->run() === FALSE) {
            $data['logged_in'] = $this->is_signed_in();
            $data['csrf'] = array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
            );
            $data['librarian'] = true;
            $this->load->view('librarians/insert', $data);
        } else {
            $data['logged_in'] = $this->is_signed_in();
            $this->article_model->insert_article($title, $AJauthor, $pubDate);
            $this->load->view('librarians/insert_success', $data);
        }
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
            $data['delete'] = true;
            $data['logged_in'] = $this->is_signed_in();
            $this->load->view('librarians/delete', $data);
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
                    $data['librarian'] = true;
                    $data['delete'] = true;
                    $this->load->view('librarians/delete', $data);
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
                    $data['librarian'] = true;
                    $data['delete'] = true;
                    $this->load->view('librarians/delete', $data);
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
                    $data['librarian'] = true;
                    $data['delete'] = true;
                    $this->load->view('librarians/delete', $data);
                    break;
            }
        }
    }

    public function check_type(): bool {
        $type = $this->sanitize($this->input->post('type'));
        if ($type === 'books' || $type === 'movies' || $type === 'articles') {
            return TRUE;
        }
        return FALSE;
    }

    private function sanitize($data) {
        return htmlspecialchars(trim(stripslashes($data)));
    }

}
