<?php

class Article_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }

    public function get($slug) {
        if(strtolower($slug) == 'all') {
            $sql = "CALL SelectAllArticles()";
            $query = $this->db->query($sql);
            return $query->result_array();
        }
        $search = '%'.$slug.'%';
        $sql = "SELECT aj.title, aj.ajauthor, aj.pubDate, 
                (SELECT count(title) FROM article_journal_checkout WHERE ajauthor = aj.ajauthor AND title = aj.title AND pubDate = aj.pubDate AND return_date IS NULL) 
                    AS checked_out 
                FROM articles_journals aj WHERE aj.title LIKE ?";
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