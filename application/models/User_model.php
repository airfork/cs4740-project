<?php

class User_model extends CI_Model {
    public function __construct() {
        $this->load->database();
        $this->load->library('encryption');
    }

    public function create($password) {
        $name = $this->sanitize($this->input->post('name'));
        $email = $this->sanitize($this->input->post('email'));
        $password = password_hash($password, PASSWORD_DEFAULT);
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

    public function updating($id, $name, $email, $password) {
        if ($password === "**********") {
            $sql = "UPDATE students SET name = ?, email = ? WHERE student_id = ?";
            $this->db->query($sql, array($name, $email, $id));
        }
        else {
            $sql = "UPDATE students SET name = ?, email = ?, password = ? WHERE student_id = ?";
            $this->db->query($sql, array($name, $email, $password, $id));
        }
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
