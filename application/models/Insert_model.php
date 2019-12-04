<?php

class Insert_model extends CI_Model {
    public function __construct() {
        $this->load->database();
        $this->load->library('encryption');
    }

    public function insert_book() {
        $title = $this->sanitize($this->input->post('title'));
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

    private function sanitize($data) {
        return htmlspecialchars(trim(stripslashes($data)));
    }
}