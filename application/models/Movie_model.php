<?php

class Movie_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }

    public function get($slug=false) {
        $search = '%'.$slug.'%';
        $sql = "SELECT m.director, m.title, m.releaseDate,
                (SELECT count(title) FROM movie_checkout WHERE title = m.title AND director = m.director AND return_date IS NULL) AS checked_out
                FROM movies m WHERE m.title LIKE ?";
        $query = $this->db->query($sql, array($search));
        return $query->result_array();
    }

    public function checkout_count($id) {
        // language=sql
        $sql = "SELECT count(student_id) AS count FROM movie_checkout WHERE student_id = ? AND return_date IS NULL";
        $query = $this->db->query($sql, array($id));
        return $query->row_array();
    }

    public function checked_out($title, $director) {
        // language=sql
        $sql = "SELECT count(title) AS count FROM movie_checkout WHERE title = ? AND director = ? AND return_date IS NULL";
        $query = $this->db->query($sql, array($title, $director));
        return $query->row_array();
    }

    public function checkout($id, $title, $director) {
        // language=sql
        $sql = "INSERT INTO movie_checkout (student_id, title, director) VALUES (?, ?, ?)";
        $this->db->query($sql, array($id, $title, $director));
    }
}