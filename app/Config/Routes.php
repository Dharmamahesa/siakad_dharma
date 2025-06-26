<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// File: app/Config/Routes.php

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
// The Auto Routing (Legacy) is very inefficient and is not recommended.
// It's far better to define your routes manually.
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

// == RUTE PUBLIK & OTENTIKASI ==
// Rute untuk menampilkan halaman login (halaman utama)
$routes->get('/', 'AuthController::login');
// Rute untuk memproses data dari form login
$routes->post('auth/process', 'AuthController::processLogin');
// Rute untuk logout
$routes->get('/logout', 'AuthController::logout');


// == GRUP RUTE ADMIN ==
// Semua rute di dalam grup ini akan memiliki awalan /admin
// dan dilindungi oleh filter 'admin_auth'
$routes->group('admin', ['filter' => 'admin_auth'], function($routes) {
    
    // Rute Dashboard Admin
    $routes->get('dashboard', 'AdminController::index');

    // Rute untuk Manajemen Mahasiswa
    $routes->get('mahasiswa', 'AdminController::mahasiswa_index');
    $routes->get('mahasiswa/create', 'AdminController::mahasiswa_create');
    $routes->post('mahasiswa/store', 'AdminController::mahasiswa_store');
    $routes->get('mahasiswa/edit/(:num)', 'AdminController::mahasiswa_edit/$1');
    $routes->post('mahasiswa/update/(:num)', 'AdminController::mahasiswa_update/$1');
    $routes->get('mahasiswa/delete/(:num)', 'AdminController::mahasiswa_delete/$1');
    
    // Rute untuk Manajemen Dosen (bisa ditambahkan nanti)
    // $routes->get('dosen', 'AdminController::dosen_index');
    // ... etc

    // Rute untuk Manajemen Mata Kuliah (bisa ditambahkan nanti)
    // $routes->get('matakuliah', 'AdminController::matakuliah_index');
    // ... etc
});


// == GRUP RUTE MAHASISWA ==
// Semua rute di dalam grup ini akan memiliki awalan /mahasiswa
// dan dilindungi oleh filter 'mahasiswa_auth'
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
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}