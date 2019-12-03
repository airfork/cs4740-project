<?php

class Book_model extends CI_Model {
    public function __construct() {
        $this->load->database();
        $this->load->dbutil();
    }

    public function get_books($slug) {
        if(strtolower($slug) == 'all') {
            $sql = "CALL SelectAllBooks()";
            $query = $this->db->query($sql);
            mysqli_next_result($this->db->conn_id);
            return $query->result_array();
        }
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

    public function get_book_hist($id, $download=FALSE) {
        // language=sql
        $sql = "SELECT title, checkout_date, return_date FROM books NATURAL JOIN book_checkout bc WHERE books.isbn = bc.book_id AND student_id = ? ";
        $query = $this->db->query($sql, array($id));
        if ($download) {
            $this->write_csv($query);
        }
        return $query->result_array();
    }

    private function write_csv($query) {
        $delimiter = ",";
        $newline = "\r\n";
        $enclosure = '"';

        $this->load->helper('file');
        write_file('book_checkout.csv', $this->dbutil->csv_from_result($query, $delimiter, $newline, $enclosure));
    }
    
    public function get_book_deadline($id) {
        // language=sql
        $sql = "SELECT title FROM books NATURAL JOIN book_checkout bc WHERE books.isbn = bc.book_id AND student_id = ? AND return_date IS NULL";
        $query = $this->db->query($sql, array($id));
        return $query->result_array();
    }
}
