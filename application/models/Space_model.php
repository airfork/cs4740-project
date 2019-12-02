<?php

class Space_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }

    public function get_space_hist($id) {
        // language=sql
        $sql = "SELECT name, reservedUntil FROM study_spaces NATURAL JOIN reserves WHERE student_id = ?";
        $query = $this->db->query($sql, array($id));
        return $query->result_array();
    }

    public function get_space_deadline($id) {
        // language=sql
        $sql = "SELECT name, location FROM reserves NATURAL JOIN study_spaces WHERE reservedUntil >= NOW() AND student_id = ?";
        $query = $this->db->query($sql, array($id));
        return $query->result_array();
    }

}
