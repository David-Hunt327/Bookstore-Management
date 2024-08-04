<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
    // Declare properties used in your application's controllers
    public $benchmark;
    public $hooks;
    public $config;
    public $log;
    public $uri;
    public $router;
    public $exceptions;
    public $output;
    public $security;
    public $input;
    public $lang;
    public $load;
    public $db;
    public $session;
    public $form_validation;
    public $cart;
    public $utf8;

    // Add any other properties mentioned in the errors

    public function __construct() {
        parent::__construct();
        // Your custom constructor code, if any
    }
}
?>