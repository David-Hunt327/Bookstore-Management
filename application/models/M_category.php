<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_category extends CI_Model {

    public function display_categories() {
        return $this->db->get('book_categories')->result();
    }

    public function save_category() {
        $object = array(
            'category_code' => $this->input->post('category_code'),
            'category_name' => $this->input->post('category_name')
        );
        return $this->db->insert('book_categories', $object);
    }

    public function detail($id) {
        return $this->db->where('category_code', $id)
                        ->get('book_categories')
                        ->row();
    }

    public function update_category() {
        $object = array(
            'category_code' => $this->input->post('category_code'),
            'category_name' => $this->input->post('category_name')
        );
        return $this->db->where('category_code', $this->input->post('old_category_code'))
                        ->update('book_categories', $object);
    }

    public function delete_category($id = '') {
        return $this->db->where('category_code', $id)
                        ->delete('book_categories');
    }
}

/* End of file M_category.php */
/* Location: ./application/models/M_category.php */
?>