<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Dashboard extends CI_Model {

    public function get_total_books() {
        return $this->db->select('count(*) as total_books')
                        ->get('books')
                        ->row();
    }

    public function get_total_transactions() {
        return $this->db->select('SUM(total) as total_transactions')
                        ->get('transactions')
                        ->row();
    }

    public function get_total_users() {
        return $this->db->select('count(*) as total_users')
                        ->get('users')
                        ->row();
    }

    public function get_book_categories() {
        return $this->db->select('count(*) as book_categories')
                        ->get('book_categories')
                        ->row();
    }

    public function get_system_users() {
        return $this->db->select('count(*) as system_users')
                        ->get('users')
                        ->row();
    }

    public function get_book_stock() {
        return $this->db->select('SUM(stock) as book_stock')
                        ->get('books')
                        ->row();
    }

    public function get_sales_percentage() {
        return $this->db->select('SUM(total) as sales_percentage')
                        ->where('date > NOW() - INTERVAL 24 HOUR')
                        ->get('transactions')
                        ->row();
    }
}

/* End of file M_Dashboard.php */
/* Location: ./application/models/M_Dashboard.php */
?>