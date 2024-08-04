<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Loader extends CI_Loader {
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
    public $M_Dashboard;
    public $category;
    public $books;
    public $pagination;
    public $transactions;
    public $M_History;
    public $users;
    public $Admin;
    // public $M_admin; // Add this line

    public function __construct() {
        parent::__construct();
    }
}
?>