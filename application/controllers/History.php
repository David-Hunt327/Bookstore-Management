<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class History extends CI_Controller {
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
    public $M_History;

    public function __construct() {
        parent::__construct();
        // Load necessary libraries, helpers, and models
        $this->load->model('M_History');
    }

    public function index() {
        $data['display_history'] = $this->M_History->display_history();
        $data['content'] = "v_history";
        $this->load->view('template', $data, FALSE);
    }
}

/* End of file History.php */
/* Location: ./application/controllers/History.php */
?>