<!-- <?php
// defined('BASEPATH') OR exit('No direct script access allowed');

// $route['default_controller'] = 'admin';
// $route['404_override'] = '';
// $route['translate_uri_dashes'] = FALSE;

// Custom routes for English equivalents
// $route['transaction-history'] = 'riwayat';
// $route['book-details'] = 'buku';
// $route['sales'] = 'transaksi';
// $route['categories'] = 'transaksi';
// Add more routes as needed

?> -->

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'admin';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Custom routes for English equivalents
$route['transaction-history'] = 'history'; // Updated from 'riwayat'
$route['book-details'] = 'books'; // Updated from 'buku'
$route['sales'] = 'transactions'; // Updated from 'transaksi'
$route['categories'] = 'categories'; // Corrected from 'transaksi'

// Add more routes as needed
?>