<?php

class Book_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }

    public function get_space_hist() {
        // language=sql
        $sql = "SELECT name FROM study_spaces NATURAL JOIN reserves WHERE student_id = ?";
        $query = $this->db->query($sql, array($student_id));
        return $query->row_array();
    }
    
    public function get_space_deadline($id) {
        // language=sql
        $sql = "SELECT name, reservedUntil FROM study_spaces NATURAL JOIN reserves WHERE student_id = ?";
        $query = $this->db->query($sql, array($id));
        return $query->row_array();
    }

}
