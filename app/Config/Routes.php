<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
// $routes->get('/', 'Home::index');

$routes->get('/', 'Daftar::index');
$routes->post('/cek_email', 'Daftar::cek_email');
$routes->post('/cek_resort', 'Daftar::cek_resort');
$routes->post('/tambah_resort', 'Daftar::tambah_resort');
