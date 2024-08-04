<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
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
    public $M_Dashboard;

    public function __construct() {
        parent::__construct();
        $this->load->model('M_Dashboard'); // Ensure this line is correct
    }

    public function index() {
        if ($this->session->userdata('logged_in') == TRUE) {
            $data['content'] = 'Home'; // Ensure this view exists
            $data['total_books'] = $this->M_Dashboard->get_total_books();
            $data['total_transactions'] = $this->M_Dashboard->get_total_transactions();
            $data['total_users'] = $this->M_Dashboard->get_total_users();
            $data['book_categories'] = $this->M_Dashboard->get_book_categories();
            $data['system_users'] = $this->M_Dashboard->get_system_users();
            $data['book_stock'] = $this->M_Dashboard->get_book_stock();
            $data['sales_percentage'] = $this->M_Dashboard->get_sales_percentage();
            $this->load->view('template', $data);
        } else {
            redirect('admin/login');
        }
    }
}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */
?>