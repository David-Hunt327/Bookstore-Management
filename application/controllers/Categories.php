<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends CI_Controller {
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
    public $category;

    public function __construct() {
        parent::__construct();
        // Load necessary libraries, helpers, and models
        $this->load->model('M_category', 'category');
    }

    public function index() {
        $data['display_categories'] = $this->category->display_categories();
        $data['content'] = "v_categories"; // Ensure this matches the actual file name
        $this->load->view('template', $data);
    }

    public function add() {
        if ($this->input->post('save')) {
            if ($this->category->save_category()) {
                $this->session->set_flashdata('message', 'Successfully Added');
                redirect('categories', 'refresh');
            } else {
                $this->session->set_flashdata('message', 'Failed to Add');
                redirect('categories', 'refresh');
            }
        }
    }

    public function edit_category($id) {
        $data = $this->category->detail($id);
        echo json_encode($data);
    }

    public function update_category() {
        if ($this->input->post('edit')) {
            if ($this->category->update_category()) {
                $this->session->set_flashdata('message', 'Updated');
                redirect('categories', 'refresh');
            } else {
                $this->session->set_flashdata('message', 'Update Failed');
                redirect('categories', 'refresh');
            }
        }
    }

    public function delete($id = '') {
        if ($this->category->delete_category($id)) {
            $this->session->set_flashdata('message', 'Delete Success');
            redirect('categories', 'refresh');
        } else {
            $this->session->set_flashdata('message', 'Failed to delete');
            redirect('categories', 'refresh');
        }
    }
}

/* End of file Categories.php */
/* Location: ./application/controllers/Categories.php */
?>