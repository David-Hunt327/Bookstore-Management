<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
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
    public $users;

    public function __construct() {
        parent::__construct();
        // Load necessary libraries, helpers, and models
        $this->load->model('M_users', 'users');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->library('cart');
    }

    public function index() {
        $data['display_users'] = $this->users->display_users();
        $data['content'] = "v_users";
        $this->load->view('template', $data);
    }

    public function add() {
        if ($this->input->post('save')) {
            if ($this->users->save_user()) {
                $this->session->set_flashdata('message', 'User Added Successfully');
                redirect('users', 'refresh');
            } else {
                $this->session->set_flashdata('message', 'Failed to Add');
                redirect('users', 'refresh');
            }
        }
    }

    public function edit($id) {
        $data = $this->users->detail($id);
        echo json_encode($data);
    }

    public function update() {
        if ($this->input->post('edit')) {
            if ($this->users->update_user()) {
                $this->session->set_flashdata('message', 'Successfully Updated');
                redirect('users', 'refresh');
            } else {
                $this->session->set_flashdata('message', 'Update Failed');
                redirect('users', 'refresh');
            }
        }
    }

    public function delete($id = '') {
        if ($this->users->delete_user($id)) {
            $this->session->set_flashdata('message', 'Successfully Deleted');
            redirect('users', 'refresh');
        } else {
            $this->session->set_flashdata('message', 'Failed to delete');
            redirect('users', 'refresh');
        }
    }
}

/* End of file Users.php */
/* Location: ./application/controllers/Users.php */
?>