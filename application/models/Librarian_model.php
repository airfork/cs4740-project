<?php

class Librarian_model extends CI_Model {
    public function __construct() {
        $this->load->database();
        $this->load->library('encryption');
    }

    public function check_user($email, $password) {
        // language=sql
        $sql = "SELECT id, password FROM librarians WHERE email = ?";
        $query = $this->db->query($sql, array($email))->row_array();
        if (empty($query)) {
            return false;
        }
        if (!password_verify($password, $query['password'])) {
            return false;
        }
        $_SESSION['id'] = $this->encryption->encrypt($query['id']);
        $_SESSION['lib'] = $this->encryption->encrypt(true);
        return true;
    }

    
}
