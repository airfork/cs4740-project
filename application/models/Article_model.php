<?php

class Article_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }

    public function get($slug) {
        if(strtolower($slug) == 'all') {
            $sql = "CALL SelectAllArticles()";
            $query = $this->db->query($sql);
            mysqli_next_result($this->db->conn_id);
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

    public function get_aj_hist($id, $download=FALSE) {
        // language=sql
        $sql = "SELECT title, checkout_date, return_date FROM articles_journals NATURAL JOIN article_journal_checkout WHERE student_id = ? ORDER BY checkout_date DESC, return_date DESC";
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
        $this->load->dbutil();
        write_file('aj_checkout.csv', $this->dbutil->csv_from_result($query, $delimiter, $newline, $enclosure));
    }
    
    public function get_aj_deadline($id) {
        // language=sql
        $sql = "SELECT title FROM articles_journals NATURAL JOIN article_journal_checkout WHERE student_id = ? AND return_date IS NULL";
        $query = $this->db->query($sql, array($id));
        return $query->result_array();
    }

    public function delete_article($title) {
        //language = sql
        $sql = "DELETE FROM articles_journals WHERE title = ?";
        $query = $this->db->query($sql, array($title));
    }

    public function insert_article($title, $AJauthor, $pubDate){
        $sql = "INSERT INTO articles_journals(title, AJauthor, pubDate) VALUES (?, ?, ?)";
        $query = $this->db->query($sql, array($title, $AJauthor, $pubDate));
        return $this->db->insert_id();

    }
}