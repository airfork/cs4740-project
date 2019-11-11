<?php

class Article_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }

    public function get($slug=false) {
        $search = '%'.$slug.'%';
        $sql = "SELECT title, ajauthor, pubDate FROM articles_journals WHERE title LIKE ?";
        $query = $this->db->query($sql, array($search));
        return $query->result_array();
    }

    public function checkout_count($id) {
        // language=sql
        $sql = "SELECT count(student_id) AS count FROM article_journal_checkout WHERE student_id = ? AND return_date IS NULL";
        $query = $this->db->query($sql, array($id));
        return $query->row_array();
    }

    public function checked_out($author, $title, $pubDate) {
        // language=sql
        $sql = "SELECT count(title) AS count FROM article_journal_checkout WHERE ajauthor = ? AND title = ? AND pubDate = ? AND return_date IS NULL";
        $query = $this->db->query($sql, array($author, $title, $pubDate));
        return $query->row_array();
    }

    public function checkout($id, $author, $title, $pubDate) {
        // language=sql
        $sql = "INSERT INTO article_journal_checkout (student_id, ajauthor, title, pubDate) VALUES (?, ?, ?, ?)";
        $this->db->query($sql, array($id, $author, $title, $pubDate));
    }
}