<?php

class Book_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }

    public function get_books($slug=false) {
        if ($slug == false) {
            // language=sql
            $sql = "SELECT isbn, title, author FROM books ORDER BY title ASC";
            $query = $this->db->query($sql);
            return $query->result_array();
        }
        $search = '%'.$slug.'%';
        $sql = "SELECT isbn, title, author FROM books WHERE title LIKE ?";
        $query = $this->db->query($sql, array($search));
        return $query->result_array();
    }

    public function checkout_count($id) {
        // language=sql
        $sql = "SELECT count(student_id) AS count FROM book_checkout WHERE student_id = ?";
        $query = $this->db->query($sql, array($id));
        return $query->row_array();
    }

    public function checked_out($isbn) {
        // language=sql
        $sql = "SELECT count(book_id) AS count FROM book_checkout WHERE book_id = ?";
        $query = $this->db->query($sql, array($isbn));
        return $query->row_array();
    }

    public function checkout($id, $isbn) {
        // language=sql
        $sql = "INSERT INTO book_checkout (student_id, book_id) VALUES (?, ?)";
        $this->db->query($sql, array($id, $isbn));
    }
}
