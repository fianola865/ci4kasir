<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/produk', 'Produk::index');
$routes->get('/produk/tampil', 'Produk::tampil_produk');
$routes->post('/produk/simpan', 'Produk::simpan_produk');
$routes->get('/produk/edit', 'Produk::edit_produk');
$routes->post('/produk/update', 'Produk::update_produk');
$routes->delete('/produk/hapus/(:num)', 'Produk::hapus_produk/$1');

$routes->get('/pelanggan', 'Pelanggan::index');
$routes->get('/pelanggan/tampil', 'Pelanggan::tampil');
$routes->post('/pelanggan/simpan', 'Pelanggan::simpan');
$routes->get('/pelanggan/edit', 'Pelanggan::edit');
$routes->post('/pelanggan/update', 'Pelanggan::update');
$routes->delete('/pelanggan/hapus/(:num)', 'Pelanggan::hapus/$1');


