<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Books extends CI_Controller {
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
    public $books;

    public function __construct() {
        parent::__construct();
        $this->load->model('m_books', 'books');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->library('cart');
    }

    public function index() {
        $data['display_books'] = $this->books->get_books();
        $data['categories'] = $this->books->get_categories();
        $data['total_transactions'] = $this->books->get_total_transactions();
        $data['content'] = "v_books";
        $this->load->view('template', $data);
    }

    public function add() {
        if ($this->input->post('save')) {
            $data = array(
                'book_title' => $this->input->post('book_title'),
                'year' => $this->input->post('year'),
                'price' => $this->input->post('price'),
                'category_code' => $this->input->post('category_code'),
                'publisher' => $this->input->post('publisher'),
                'author' => $this->input->post('author'),
                'stock' => $this->input->post('stock')
            );

            if ($this->books->add_book($data)) {
                $this->session->set_flashdata('message', 'Book Added Successfully');
                redirect('books', 'refresh');
            } else {
                $this->session->set_flashdata('message', 'Failed to Add');
                redirect('books', 'refresh');
            }
        }
    }

    public function edit($id) {
        $data = $this->books->get_book($id);
        echo json_encode($data);
    }

    public function update() {
        if ($this->input->post('save')) {
            $data = array(
                'book_title' => $this->input->post('book_title'),
                'year' => $this->input->post('year'),
                'price' => $this->input->post('price'),
                'category_code' => $this->input->post('category_code'),
                'publisher' => $this->input->post('publisher'),
                'author' => $this->input->post('author'),
                'stock' => $this->input->post('stock')
            );

            $this->db->where('book_code', $this->input->post('book_code'));
            if ($this->books->update_book($data)) {
                $this->session->set_flashdata('message', 'Successfully Updated');
                redirect('books', 'refresh');
            } else {
                $this->session->set_flashdata('message', 'Update Failed');
                redirect('books', 'refresh');
            }
        }
    }

    public function delete($id = '') {
        if ($this->books->delete_book($id)) {
            $this->session->set_flashdata('message', 'Successfully Deleted');
            redirect('books', 'refresh');
        } else {
            $this->session->set_flashdata('message', 'Failed to delete');
            redirect('books', 'refresh');
        }
    }

}

/* End of file Books.php */
/* Location: ./application/controllers/Books.php */
?>