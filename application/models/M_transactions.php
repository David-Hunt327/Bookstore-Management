<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_transactions extends CI_Model {
    public function get_books() {
        $this->db->select('books.*, book_categories.category_name');
        $this->db->from('books');
        $this->db->join('book_categories', 'books.category_code = book_categories.category_code');
        return $this->db->get()->result();
    }

    public function get_transactions() {
        return $this->db->get('users')->result();
    }

    public function check_stock($book_code) {
        $check_stock = $this->db->where('book_code', $book_code)->get('books')->row()->stock;
        if ($check_stock == 0) {
            return 0;
        } else {
            return 1;
        }
    }

    public function check() {
        $check = 1;
        for ($i = 0; $i < count($this->input->post('rowid')); $i++) {
            $stock = $this->db->where('book_code', $this->input->post('book_code')[$i])
                ->get('books')
                ->row()
                ->stock;
            $qty = $this->input->post('qty')[$i];
            $remaining = $stock - $qty;
            if ($remaining < 0) {
                $ok = 0;
            } else {
                $ok = 1;
            }
            $check = $ok * $check;
        }
        return $check;
    }

    public function save_cart_db() {
        for ($i = 0; $i < count($this->input->post('rowid')); $i++) {
            $stock = $this->db->where('book_code', $this->input->post('book_code')[$i])
                ->get('books')
                ->row()
                ->stock;
            $qty = $this->input->post('qty')[$i];
            $remaining = $stock - $qty;
            $update_stock = array('stock' => $remaining);
            $this->db->where('book_code', $this->input->post('book_code')[$i])
                ->update('books', $update_stock);
        }

        // Ensure bookname and book_qty are arrays
        $book_names = $this->input->post('bookname');
        $book_quantities = $this->input->post('book_qty');

        if (!is_array($book_names)) {
            $book_names = array($book_names);
        }
        if (!is_array($book_quantities)) {
            $book_quantities = array($book_quantities);
        }

        // Concatenate book names and quantities
        $book_names_str = implode(', ', $book_names);
        $book_quantities_str = implode(', ', $book_quantities);

        $object = array(
            'user_code' => $this->input->post('user_code'),
            'buyer_name' => $this->input->post('buyer_name'),
            'date' => date('Y-m-d'),
            'total' => $this->input->post('total'),
            'book_name' => $book_names_str,
            'book_quantity' => $book_quantities_str
        );
        $this->db->insert('transactions', $object);
        $receipt = $this->db->order_by('transaction_code', 'desc')
            ->where('user_code', $this->input->post('user_code'))
            ->limit(1)
            ->get('transactions')
            ->row();
        for ($i = 0; $i < count($this->input->post('rowid')); $i++) {
            $result[] = array(
                'transaction_code' => $receipt->transaction_code,
                'book_code' => $this->input->post('book_code')[$i],
                'quantity' => $this->input->post('qty')[$i]
            );
        }
        $process = $this->db->insert_batch('transaction_details', $result);
        if ($process) {
            return $receipt->transaction_code;
        } else {
            return 0;
        }
    }

    public function detail_receipt($receipt_id) {
        return $this->db->where('transaction_code', $receipt_id)
            ->join('users', 'users.user_code = transactions.user_code')
            ->get('transactions')
            ->row();
    }

    public function detail_transaction($receipt_id) {
        return $this->db->where('transaction_code', $receipt_id)
            ->join('books', 'books.book_code = transaction_details.book_code')
            ->join('book_categories', 'book_categories.category_code = books.category_code')
            ->get('transaction_details')->result();
    }

    // Add the missing get_book method
    public function get_book($book_code) {
        return $this->db->get_where('books', array('book_code' => $book_code))->row();
    }
}

/* End of file M_transactions.php */
/* Location: ./application/models/M_transactions.php */
?>