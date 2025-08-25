<?php

namespace Config;

use Config\Services;

$routes = Services::routes();

// Main page: /hello_staff
$routes->get('hello_staff', 'Hello_Staff::index', ['namespace' => 'Hello_Staff\Controllers']);

// These is post and get endpoints are optional, allow additional public methods on the controller as clean URLs
$routes->get('hello_staff/(:any)', 'Hello_Staff::$1', ['namespace' => 'Hello_Staff\Controllers']);
// $routes->post('hello_staff/(:any)', 'Hello_Staff::$1', ['namespace' => 'Hello_Staff\Controllers']);
