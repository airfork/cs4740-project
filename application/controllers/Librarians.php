<?php

class Librarians extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('user_model');
        $this->load->model('librarian_model');
        $this->load->model('book_model');
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

    private function is_signed_in() : bool {
        if (empty($_SESSION['id'])) {
            return false;
        }
        return true;
    }

    /*
    public function insert() {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_message('check_type', 'Please provide a valid type for the insertion');
        $this->form_validation->set_rules(
            'type', 'type', 'required|callback_check_type',
            array('check_type', 'Please provide a valid type for the insertion.')
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
    public function insert() {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_message('check_type', 'Please provide a valid type for the insertion');
        $this->form_validation->set_rules(
            'type', 'type', 'required|callback_check_type',
            array('check_type', 'Please provide a valid type for the insertion.')
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

*/
    public function delete() {
        $this->validate_lib();
        $data['logged_in'] = $this->is_signed_in();
        $data['csrf'] = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->load->view('librarians/delete', $data);
    }
    public function insert() {
        $this->validate_lib();
        $data['logged_in'] = $this->is_signed_in();
        $data['csrf'] = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->load->view('librarians/insert', $data);
    }


    /*public function add_item(){
        $item = $this->sanitize($this->input->post('input type (book, movie, article):'));
        if(item=="book"){
            $ISBN = $this->sanitize($this->input->post('ISBN'));
            $title = $this->sanitize($this->input->post('title'));
            $author = $this->sanitize($this->input->post('author'));

        }
    }*/

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
                    $data['searchpage'] = true;
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
