<?php

class Studyspaces_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }

    public function get() {
        // $sql = "SELECT s.name, s.description, s.location, s.space_id,
        //         (SELECT count(student_id) FROM reserves WHERE space_id = s.space_id AND reservedUntil > now()) AS already_reserved 
        //         FROM study_spaces s";
        $sql = "SELECT s.space_id, s.name, s.description, s.location, i.item_id, i.type, i.description AS itemdescription, 
                (SELECT count(student_id) FROM reserves WHERE space_id = s.space_id AND reservedUntil > now()) AS already_reserved 
                FROM study_spaces s INNER JOIN contains c INNER JOIN inventory i where c.space_id = s.space_id AND c.item_id = i.item_id ORDER BY s.space_id";
        $query = $this->db->query($sql);
        $intermediate = $query->result_array();
        $result = array();
        $result[0] = $intermediate[0];
        $lastsameindex = 0; //in the intermediate array
        $x = 1;
        $counter = 0;
        while($x < sizeof($intermediate)){
            $space = $intermediate[$x]; //going along in the intermediate array
            if($space['space_id'] == $intermediate[$lastsameindex]['space_id']){
                $result[$counter]['type'] = $result[$counter]['type'].", ".$space['type'];
                $result[$counter]['itemdescription'] = $result[$counter]['itemdescription']."; ".$space['itemdescription'];
            }
            else{
                $counter++;
                $lastsameindex = $x;
                $result[$counter] = $space;
            }
            $x++;
        }
        return $result;
        //return $query->result_array();
    }

    public function booking_count($id) {
        // language=sql
        $sql = "SELECT count(student_id) AS count FROM reserves WHERE student_id = ? AND reservedUntil > now()";
        $query = $this->db->query($sql, array($id));
        return $query->row_array();
    }

    public function already_booked($space_id) {
        // language=sql
        $sql = "SELECT count(space_id) AS count FROM reserves WHERE space_id = ? AND reservedUntil > now()";
        $query = $this->db->query($sql, array($space_id));
        return $query->row_array();
    }

    public function checkout($student_id, $space_id) {
        // language=sql
        $startTime = date("Y-m-d H:i:s");
        $reserved_until = date('Y-m-d H:i:s',strtotime('+2 hour',strtotime($startTime)));

        $sql = "INSERT INTO reserves (student_id, space_id, reservedUntil) VALUES (?, ?, ?)";
        $this->db->query($sql, array($student_id, $space_id, $reserved_until));
    }
}