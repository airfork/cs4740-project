<?php

class Study_Spaces_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }

    public function get() {
        //$sql = "SELECT name, description, location, reservedUntil FROM study_spaces INNER JOIN reserves WHERE DATETIME_DIFF(reservedUntil,CURRENT_DATETIME(),MILLISECOND) < 0"
        $sql = "SELECT space_id, name, description, location, reservedUntil FROM study_spaces INNER JOIN reserves";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function booking_count($id) {
        // language=sql
        $sql = "SELECT count(student_id) AS count FROM reserves WHERE student_id = ? AND DATETIME_DIFF(reservedUntil,CURRENT_DATETIME(),SECOND) > 0";
        $query = $this->db->query($sql, array($id));
        return $query->row_array();
    }

    public function already_booked($space_id) {
        // language=sql
        $sql = "SELECT count(space_id) AS count FROM reserves WHERE space_id = ? AND DATETIME_DIFF(reservedUntil,CURRENT_DATETIME(),SECOND) > 0";
        $query = $this->db->query($sql, array($space_id));
        return $query->row_array();
    }

    public function checkout($student_id, $space_id) {
        // language=sql
        $startTime = date("Y-m-d H:i:s");
        $reserved_until = date('Y-m-d H:i:s',strtotime('+2 hour',strtotime($startTime)));

        $sql = "INSERT INTO movie_checkout (student_id, space_id, reservedUntil) VALUES (?, ?, ?)";
        $this->db->query($sql, array($student_id, $space_id, $reserved_until));
    }
}