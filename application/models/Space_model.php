<?php

class Space_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }

    public function get_space_hist($id, $download=FALSE) {
        // language=sql
        $sql = "SELECT name, reservedUntil FROM study_spaces NATURAL JOIN reserves WHERE student_id = ?";
        $query = $this->db->query($sql, array($id));
        if ($download) {
            $name = "space_checkout.csv";
            $this->load->helper('download');
            force_download('file.csv', NULL);
        }
        return $query->result_array();
    }

    private function write_csv($query) {
        $delimiter = ",";
        $newline = "\r\n";
        $enclosure = '"';

        $this->load->helper('file');
        write_file('exports/space_checkout.csv', $this->dbutil->csv_from_result($query, $delimiter, $newline, $enclosure));
    }

    public function get_space_deadline($id) {
        // language=sql
        $sql = "SELECT name, location FROM reserves NATURAL JOIN study_spaces WHERE reservedUntil >= NOW() AND student_id = ?";
        $query = $this->db->query($sql, array($id));
        return $query->result_array();
    }
}
