<?php

class Book_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }

    public function get_books($slug) {
        $search = '%'.$slug.'%';
        $sql = "SELECT b.isbn, b.title, b.author, 
                (SELECT count(student_id) FROM book_checkout WHERE book_id = b.isbn AND return_date IS NULL) AS checked_out
                FROM books b WHERE b.title LIKE ?";
        $query = $this->db->query($sql, array($search));
        return $query->result_array();
    }

    public function checkout_count($id) {
        // language=sql
        $sql = "SELECT count(student_id) AS count FROM book_checkout WHERE student_id = ? AND return_date IS NULL";
        $query = $this->db->query($sql, array($id));
        return $query->row_array();
    }

    public function checked_out($isbn) {
        // language=sql
        $sql = "SELECT count(book_id) AS count FROM book_checkout WHERE book_id = ? AND return_date IS NULL";
        $query = $this->db->query($sql, array($isbn));
        return $query->row_array();
    }

    public function checkout($id, $isbn) {
        // language=sql
        $sql = "INSERT INTO book_checkout (student_id, book_id) VALUES (?, ?)";
        $this->db->query($sql, array($id, $isbn));
    }

    public function get_book_hist() {
        // language=sql
        $sql = "SELECT title, checkout_date FROM books NATURAL JOIN book_checkout bc WHERE books.isbn = bc.book_id AND student_id = ?";
        $query = $this->db->query($sql);
        return $query->row_array();
    }
    
    public function get_book_deadline($id) {
        // language=sql
        $sql = "SELECT title, return_date FROM books NATURAL JOIN book_checkout bc WHERE books.isbn = bc.book_id AND student_id = ? AND return_date IS NULL";
        $query = $this->db->query($sql, array($id));
        return $query->result_array();
    }
}
