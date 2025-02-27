<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Default controller
$route['default_controller'] = 'roti'; // Mengarahkan ke controller Roti
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Routing untuk dashboard (index)
$route['dashboard'] = 'roti/index'; // Alias untuk halaman utama

// Routing untuk fungsi CRUD roti
$route['roti'] = 'roti/index'; // Daftar roti (dashboard)
$route['roti/create'] = 'roti/create'; // Form tambah roti
$route['roti/edit/(:num)'] = 'roti/edit/$1'; // Form edit roti dengan ID
$route['roti/delete/(:num)'] = 'roti/delete/$1'; // Hapus roti dengan ID

// Routing untuk konfigurasi fuzzy variables
$route['roti/fuzzy_variables'] = 'roti/fuzzy_variables'; // Daftar variabel fuzzy
$route['roti/add_variable'] = 'roti/add_variable'; // Form tambah variabel fuzzy
$route['roti/edit_variable/(:num)'] = 'roti/edit_variable/$1'; // Form edit variabel fuzzy
$route['roti/delete_variable/(:num)'] = 'roti/delete_variable/$1'; // Hapus variabel fuzzy

// Routing untuk konfigurasi fuzzy rules
$route['roti/fuzzy_rules'] = 'roti/fuzzy_rules'; // Daftar aturan fuzzy
$route['roti/add_rule'] = 'roti/add_rule'; // Form tambah aturan fuzzy
$route['roti/edit_rule/(:num)'] = 'roti/edit_rule/$1'; // Form edit aturan fuzzy
$route['roti/delete_rule/(:num)'] = 'roti/delete_rule/$1'; // Hapus aturan fuzzy

?>