<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_books extends CI_Model {
    public function get_books() {
        $this->db->select('books.*, book_categories.category_name');
        $this->db->from('books');
        $this->db->join('book_categories', 'books.category_code = book_categories.category_code');
        return $this->db->get()->result();
    }

    public function get_categories() {
        return $this->db->get('book_categories')->result();
    }

    public function add_book($data) {
        return $this->db->insert('books', $data);
    }

    public function get_book($id) {
        return $this->db->get_where('books', array('book_code' => $id))->row();
    }

    public function update_book($data) {
        $this->db->where('book_code', $this->input->post('book_code'));
        return $this->db->update('books', $data);
    }

    public function delete_book($id) {
        return $this->db->delete('books', array('book_code' => $id));
    }

    public function get_total_transactions() {
        return $this->db->count_all('transactions');
    }
}

/* End of file M_books.php */
/* Location: ./application/models/M_books.php */
?>