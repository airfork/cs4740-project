<?php

class User_model extends CI_Model {
    public function __construct() {
        $this->load->database();
        $this->load->library('encryption');
    }

    public function create() {
        $name = $this->sanitize($this->input->post('name'));
        $email = $this->sanitize($this->input->post('email'));
        $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
        // language=sql
        $sql = "INSERT INTO students (name, email, password) VALUES (?, ?, ?)";
        $query = $this->db->query($sql, array($name, $email, $password));
        return $this->db->insert_id();
    }

    public function check_user($email, $password) {
        // language=sql
        $sql = "SELECT student_id, password FROM students WHERE email = ?";
        $query = $this->db->query($sql, array($email))->row_array();
        if (empty($query)) {
            return false;
        }
        if (!password_verify($password, $query['password'])) {
            return false;
        }
        $_SESSION['id'] = $this->encryption->encrypt($query['student_id']);
        return true;
    }
    
    public function get_user($email) {
        $sql = "SELECT student_id FROM students WHERE email = ?";
        $query = $this->db->query($sql, array($email));
        return $query->row_array();
    }
    
    public function get_book_hist() {
        // language=sql
        $sql = "SELECT title, checkout_date FROM books NATURAL JOIN book_checkout bc WHERE books.isbn = bc.book_id AND student_id = ?";
        $query = $this->db->query($sql, array($student_id));
        return $query->row_array();
    }
    
    public function get_aj_hist() {
        // language=sql
        $sql = "SELECT title, checkout_date FROM articles_journals NATURAL JOIN article_journal_checkout WHERE student_id = ?";
        $query = $this->db->query($sql, array($student_id));
        return $query->row_array();
    }
    
    public function get_movie_hist() {
        // language=sql
        $sql = "SELECT title, checkout_date FROM movies NATURAL JOIN movie_checkout WHERE student_id = ?";
        $query = $this->db->query($sql, array($student_id));
        return $query->row_array();
    }
    
    public function get_space_hist() {
        // language=sql
        $sql = "SELECT name FROM study_spaces NATURAL JOIN reserves WHERE student_id = ?";
        $query = $this->db->query($sql, array($student_id));
        return $query->row_array();
    }
    
    public function get_book_deadline() {
        // language=sql
        $sql = "SELECT title, return_date FROM books NATURAL JOIN book_checkout bc WHERE books.isbn = bc.book_id AND student_id = ?";
        $query = $this->db->query($sql, array($student_id));
        return $query->row_array();
    }
    
    public function get_aj_deadline() {
        // language=sql
        $sql = "SELECT title, return_date FROM articles_journals NATURAL JOIN article_journal_checkout WHERE student_id = ?";
        $query = $this->db->query($sql, array($student_id));
        return $query->row_array();
    }
    
    public function get_movie_deadline() {
        // language=sql
        $sql = "SELECT title, return_date FROM movies NATURAL JOIN movie_checkout WHERE student_id = ?";
        $query = $this->db->query($sql, array($student_id));
        return $query->row_array();
    }
    
    public function get_space_deadline() {
        // language=sql
        $sql = "SELECT name, reservedUntil FROM study_spaces NATURAL JOIN reserves WHERE student_id = ?";
        $query = $this->db->query($sql, array($student_id));
        return $query->row_array();
    }
    
    private function sanitize($data) {
        return htmlspecialchars(trim(stripslashes($data)));
    }
}
