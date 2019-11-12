<?php

class Librarian_model extends CI_Model {
    public function __construct() {
        $this->load->database();
        $this->load->library('encryption');
    }

    public function check_user($email, $password) {
        // language=sql
        $sql = "SELECT id, password FROM librarians WHERE email = ?";
        $query = $this->db->query($sql, array($email))->row_array();
        if (empty($query)) {
            return false;
        }
        if (!password_verify($password, $query['password'])) {
            return false;
        }
        $_SESSION['id'] = $this->encryption->encrypt($query['id']);
        $_SESSION['lib'] = $this->encryption->encrypt(true);
        return true;
    }

    public function items_returned($student_ID,$checkout_date, $id, $return_date){
        //language = sql
        if()
        $sql = "INSERT INTO movie_checkout (student_id, title, director) VALUES (?, ?, ?)";
        $this->db->query($sql, array($id, $title, $director));
        
        $sql = "INSERT INTO article_journal_checkout (student_id, ajauthor, title, pubDate) VALUES (?, ?, ?, ?)";
        $this->db->query($sql, array($id, $author, $title, $pubDate));

        $sql = "INSERT INTO book_checkout (student_id, book_id) VALUES (?, ?)";
        $this->db->query($sql, array($id, $isbn));


    }

    public function create_user($email, $password){
        // language=sql
        $sql = "INSERT INTO students (name, email, password) VALUES (?, ?, ?)";
        $query = $this->db->query($sql, array($name, $email, $password));
        return $this->db->insert_id();
    }

    public function add_item(){
        //language = sql
        $sql = ""
    }

    public function remove_item(){
        //language = sql

    }
}
