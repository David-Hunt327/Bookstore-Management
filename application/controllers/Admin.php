<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
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
    public $M_Admin;

    public function __construct() {
        parent::__construct();
        $this->load->model('M_Admin'); // Ensure this line is correct
    }

    public function index() {
        if ($this->session->userdata('login') == FALSE) {
            $this->load->view('login');
        } else {
            redirect('Dashboard');
        }
    }

    public function proses_login() {
        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('username', 'username', 'trim|required');
            $this->form_validation->set_rules('password', 'password', 'trim|required');
            if ($this->form_validation->run() == TRUE) {
                $username = $this->input->post('username');
                $password = $this->input->post('password');
                $user = $this->M_Admin->get_login($username, $password); // Ensure this method returns user data

                if ($user) {
                    $session_data = array(
                        'username' => $user->username,
                        'user_name' => $user->user_name, // Ensure this is set correctly
                        'level' => $user->level,
                        'logged_in' => TRUE
                    );
                    $this->session->set_userdata($session_data);
                    redirect('dashboard');
                } else {
                    $this->session->set_flashdata('message', 'Wrong Username and Password');
                    redirect('admin/index');
                }
            } else {
                $this->session->set_flashdata('message', 'Username or Password must be filled!!');
                redirect('admin/index');
            }
        }
    }

    public function register() {
        if ($this->session->userdata('login') == FALSE) {
            $this->load->view('register');
        } else {
            redirect('Dashboard');
        }
    }

    public function proses_register() {
        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('username', 'username', 'trim|required');
            $this->form_validation->set_rules('password', 'password', 'trim|required');
            $this->form_validation->set_rules('user_name', 'user_name', 'trim|required');
            $this->form_validation->set_rules('level', 'level', 'trim|required');
            if ($this->form_validation->run() == TRUE) {
                if ($this->M_Admin->get_register() == TRUE) {
                    redirect('admin/index');
                } else {
                    $this->session->set_flashdata('message', 'Wrong Username and Password');
                    redirect('admin/register');
                }
            } else {
                $this->session->set_flashdata('message', 'Username or Password must be filled!!');
                redirect('admin/register');
            }
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('admin/index','refresh');
    }
}

/* End of file Admin.php */
/* Location: ./application/controllers/Admin.php */
?>