<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Admin extends CI_Model {

    public function get_login($username, $password) {
        $this->db->where('username', $username);
        $this->db->where('password', md5($password)); // Assuming passwords are stored as MD5 hashes
        return $this->db->get('users')->row(); // Ensure the table name is correct
    }

    public function get_register() {
        $regis = array(
            'username' => $this->input->post('username'),
            'password' => md5($this->input->post('password')),
            'user_name' => $this->input->post('user_name'),
            'level' => $this->input->post('level'),
        );
        return $this->db->insert('users', $regis); // Ensure the table name is correct
    }
}

/* End of file M_Admin.php */
/* Location: ./application/models/M_Admin.php */
?>