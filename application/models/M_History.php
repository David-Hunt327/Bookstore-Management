<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_History extends CI_Model {

    public function display_history() {
        $this->db->select('transactions.*, users.user_name, transaction_details.quantity as book_qty, books.book_title as bookname');
        $this->db->from('transactions');
        $this->db->join('users', 'users.user_code = transactions.user_code');
        $this->db->join('transaction_details', 'transaction_details.transaction_code = transactions.transaction_code');
        $this->db->join('books', 'books.book_code = transaction_details.book_code');
        return $this->db->get()->result();
    }
}

/* End of file M_History.php */
/* Location: ./application/models/M_History.php */
?>