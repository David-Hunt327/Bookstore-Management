<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_users extends CI_Model {

    public function display_users() {
        return $this->db->get('users')->result();
    }

    public function save_user() {
        $data = array(
            'user_name' => $this->input->post('user_name'),
            'username' => $this->input->post('username'),
            'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
            'level' => $this->input->post('level')
        );
        return $this->db->insert('users', $data);
    }

    public function detail($id) {
        return $this->db->get_where('users', array('user_code' => $id))->row();
    }

    public function update_user() {
        $data = array(
            'user_name' => $this->input->post('user_name'),
            'username' => $this->input->post('username'),
            'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
            'level' => $this->input->post('level')
        );
        $this->db->where('user_code', $this->input->post('user_code'));
        return $this->db->update('users', $data);
    }

    public function delete_user($id) {
        return $this->db->delete('users', array('user_code' => $id));
    }
}

/* End of file M_users.php */
/* Location: ./application/models/M_users.php */
?>