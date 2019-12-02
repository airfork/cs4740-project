<?php

class User_model extends CI_Model {
    public function __construct() {
        $this->load->database();
        $this->load->library('encryption');
    }

    public function create() {
        $name = $this->sanitize($this->input->post('name'));
        $email = $this->sanitize($this->input->post('email'));
        $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
        // language=sql
        $sql = "INSERT INTO students (name, email, password) VALUES (?, ?, ?)";
        $query = $this->db->query($sql, array($name, $email, $password));
        return $this->db->insert_id();
    }

    public function check_user($email, $password) {
        // language=sql
        $sql = "SELECT student_id, password FROM students WHERE email = ?";
        $query = $this->db->query($sql, array($email))->row_array();
        if (empty($query)) {
            return false;
        }
        if (!password_verify($password, $query['password'])) {
            return false;
        }
        $_SESSION['id'] = $this->encryption->encrypt($query['student_id']);
        return true;
    }

    public function update_db_name($data) {
        extract($data);
        $this->db->where('student_id', $id);
        $this->db->update($table_name, array('name' => $name));
        return true;
    }

    public function update_db_email($data) {
        extract($data);
        $this->db->where('student_id', $id);
        $this->db->update($table_name, array('email' => $email));
        return true;
    }

    public function get_name($id) {
        $sql = "SELECT name FROM students WHERE student_id = ?";
        $query = $this->db->query($sql, array($id));
        return $query->row_array();
    }
     
    public function get_email($id) {
        $sql = "SELECT email FROM students WHERE student_id = ?";
        $query = $this->db->query($sql, array($id));
        return $query->row_array();
    }

    private function sanitize($data) {
        return htmlspecialchars(trim(stripslashes($data)));
    }
}
