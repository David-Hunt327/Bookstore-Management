<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transactions extends CI_Controller {
    // Declare properties
    public $benchmark;
    public $hooks;
    public $config;
    public $log;
    public $utf8;
    public $uri;
    public $router;
    public $output;
    public $security;
    public $input;
    public $lang;
    public $load;
    public $db;
    public $session;
    public $form_validation;
    public $cart;
    public $transactions;

    public function __construct() {
        parent::__construct();
        // Load necessary libraries, helpers, and models
        $this->load->model('M_transactions', 'transactions');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->library('cart');
    }

    public function index() {
        $data['display_books'] = $this->transactions->get_books();
        $data['transactions'] = $this->transactions->get_transactions();
        $data['content'] = "v_transactions";
        $this->load->view('template', $data);
    }

    public function addcart($book_code) {
        $book = $this->transactions->get_book($book_code);
        if ($book) {
            $data = array(
                'id' => $book->book_code,
                'qty' => 1,
                'price' => $book->price,
                'name' => $book->book_title,
                'options' => array('title' => $book->book_title)
            );
            $this->cart->insert($data);
            redirect('transactions');
        } else {
            $this->session->set_flashdata('message', 'Book not found');
            redirect('transactions');
        }
    }

    public function save() {
        $this->form_validation->set_rules('user_code', 'Cashier', 'required');
        $this->form_validation->set_rules('buyer_name', 'Customer Name', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', validation_errors());
            redirect('transactions');
        } else {
            if ($this->input->post('pay')) {
                if ($this->transactions->check() == 1) {
                    $receipt_id = $this->transactions->save_cart_db();
                    if ($receipt_id) {
                        $this->cart->destroy();
                        $this->session->set_flashdata('message', 'Transaction Successful');
                        redirect('transactions');
                    } else {
                        $this->session->set_flashdata('message', 'Transaction Failed');
                        redirect('transactions');
                    }
                } else {
                    $this->session->set_flashdata('message', 'Insufficient Stock');
                    redirect('transactions');
                }
            } elseif ($this->input->post('update')) {
                // Ensure the data is in the correct format
                $data = array();
                foreach ($this->input->post('rowid') as $key => $rowid) {
                    $data[] = array(
                        'rowid' => $rowid,
                        'qty' => $this->input->post('qty')[$key]
                    );
                }
                $this->cart->update($data);
                redirect('transactions');
            }
        }
    }

    public function delete_cart($rowid) {
        $data = array(
            'rowid' => $rowid,
            'qty' => 0
        );
        $this->cart->update($data);
        redirect('transactions');
    }

    public function clearcart() {
        $this->cart->destroy();
        redirect('transactions');
    }

    public function receipt($receipt_id) {
        $data['transactions'] = $this->transactions->detail_receipt($receipt_id);
        $data['transaction_details'] = $this->transactions->detail_transaction($receipt_id);
        echo json_encode($data);
    }
}

/* End of file Transactions.php */
/* Location: ./application/controllers/Transactions.php */
?>