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
        $sql = "SELECT isbn, title, author FROM books WHERE title LIKE '%?%'";
        $query = $this->db->query($sql, array($slug));
        return $query->row_array();
    }
}
