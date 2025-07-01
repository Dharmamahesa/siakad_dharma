<?php

namespace Config;

use Config\Services;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// == RUTE PUBLIK & OTENTIKASI ==
$routes->get('/', 'AuthController::login');
$routes->post('auth/process', 'AuthController::processLogin');
$routes->get('/logout', 'AuthController::logout');


// == GRUP RUTE ADMIN ==
$routes->group('admin', ['filter' => 'admin_auth'], function($routes) {
    
    $routes->get('dashboard', 'AdminController::index');

    // Rute Mahasiswa
    $routes->get('mahasiswa', 'AdminController::mahasiswa_index');
    $routes->get('mahasiswa/create', 'AdminController::mahasiswa_create');
    $routes->post('mahasiswa/store', 'AdminController::mahasiswa_store');
    $routes->get('mahasiswa/edit/(:num)', 'AdminController::mahasiswa_edit/$1');
    $routes->post('mahasiswa/update/(:num)', 'AdminController::mahasiswa_update/$1');
    $routes->get('mahasiswa/delete/(:num)', 'AdminController::mahasiswa_delete/$1');
    
    // Rute Dosen
    $routes->get('dosen', 'AdminController::dosen_index');
    $routes->get('dosen/create', 'AdminController::dosen_create');
    $routes->post('dosen/store', 'AdminController::dosen_store');
    $routes->get('dosen/edit/(:num)', 'AdminController::dosen_edit/$1');
    $routes->post('dosen/update/(:num)', 'AdminController::dosen_update/$1');
    $routes->get('dosen/delete/(:num)', 'AdminController::dosen_delete/$1');
    
    // Rute Mata Kuliah
    $routes->get('matakuliah', 'AdminController::matakuliah_index');
    $routes->get('matakuliah/create', 'AdminController::matakuliah_create');
    $routes->post('matakuliah/store', 'AdminController::matakuliah_store');
    $routes->get('matakuliah/edit/(:num)', 'AdminController::matakuliah_edit/$1');
    $routes->post('matakuliah/update/(:num)', 'AdminController::matakuliah_update/$1');
    $routes->get('matakuliah/delete/(:num)', 'AdminController::matakuliah_delete/$1');
});


// !! TAMBAHKAN BLOK GRUP RUTE BARU INI UNTUK MAHASISWA !!
// == GRUP RUTE MAHASISWA ==
$routes->group('mahasiswa', ['filter' => 'mahasiswa_auth'], function($routes) {
    
    // Rute Dashboard Mahasiswa
    $routes->get('dashboard', 'MahasiswaController::index');
    // Rute untuk proses upload laporan
    $routes->post('upload', 'MahasiswaController::upload_process');
    
    // Rute untuk Kartu Rencana Studi (KRS)
    $routes->get('krs', 'MahasiswaController::rencanaStudi_index');
    $routes->get('krs/tambah', 'MahasiswaController::rencanaStudi_create');
    $routes->post('krs/simpan', 'MahasiswaController::rencanaStudi_store');
    $routes->get('krs/hapus/(:num)', 'MahasiswaController::rencanaStudi_delete_item/$1');
});


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}