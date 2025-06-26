<?php

namespace Config;

// !! BARIS INI MEMPERBAIKI ERROR "CLASS NOT FOUND" !!
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

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

// == RUTE PUBLIK & OTENTIKASI ==
$routes->get('/', 'AuthController::login');
$routes->post('auth/process', 'AuthController::processLogin');
$routes->get('/logout', 'AuthController::logout');


// == GRUP RUTE ADMIN ==
// Semua rute di dalam grup ini akan dilindungi oleh filter
$routes->group('admin', ['filter' => 'admin_auth'], function($routes) {
    
    $routes->get('dashboard', 'AdminController::index');

    // Rute Mahasiswa
    $routes->get('mahasiswa', 'AdminController::mahasiswa_index');
    $routes->get('mahasiswa/create', 'AdminController::mahasiswa_create');
    $routes->post('mahasiswa/store', 'AdminController::mahasiswa_store');
    $routes->get('mahasiswa/edit/(:num)', 'AdminController::mahasiswa_edit/$1');
    $routes->post('mahasiswa/update/(:num)', 'AdminController::mahasiswa_update/$1');
    $routes->get('mahasiswa/delete/(:num)', 'AdminController::mahasiswa_delete/$1');
    
});


// == GRUP RUTE MAHASISWA ==
$routes->group('mahasiswa', ['filter' => 'mahasiswa_auth'], function($routes) {
    
    $routes->get('dashboard', 'MahasiswaController::index');
    $routes->post('upload', 'MahasiswaController::upload_process');
    
    // Rute KRS
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