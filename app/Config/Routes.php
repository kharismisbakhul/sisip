<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('AuthController');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

// Root
$routes->get('/', 'AuthController::login');
$routes->post('/login', 'AuthController::login');
$routes->get('/logout', 'AuthController::logout');
$routes->get('/daftarHadir', 'AuthController::daftarHadir');

// Admin
$routes->get('/admin', 'AdminController::index');
$routes->get('/admin/managementUsers', 'AdminController::managementUsers');
$routes->get('/admin/profil', 'AdminController::profil');
$routes->get('/admin/tambahUser', 'AdminController::tambahUser');
$routes->post('/admin/saveUser', 'AdminController::saveUser');
$routes->get('/admin/daftarSaran', 'AdminController::daftarSaran');
$routes->get('/admin/indeksKepuasan', 'AdminController::indeksKepuasan');
$routes->get('/admin/editIndeksKepuasan/(:any)', 'AdminController::editIndeksKepuasan/$1');
$routes->post('/admin/tambahIndeksPertanyaan', 'AdminController::tambahIndeksPertanyaan');
$routes->post('/admin/editIndeksPertanyaan/(:any)', 'AdminController::editIndeksPertanyaan/$1');
$routes->get('/admin/hapusIndeksPertanyaan/(:any)/(:any)', 'AdminController::hapusIndeksPertanyaan/$1/$2');
$routes->post('/admin/tambahIndeksKepuasan', 'AdminController::tambahIndeksKepuasan');
$routes->get('/admin/apiPassword/(:any)', 'AdminController::apiPassword/$1');
$routes->post('/admin/ubahGambar/(:any)', 'AdminController::ubahGambar/$1');
$routes->post('/admin/ubahPassword/(:any)', 'AdminController::ubahPassword/$1');
$routes->get('/admin/settingPekerjaan/(:any)', 'AdminController::settingPekerjaan/$1');
$routes->get('/admin/ubahUser/(:any)', 'AdminController::ubahUser/$1');
$routes->get('/admin/hasilIndeksKepuasan/(:any)', 'AdminController::hasilIndeksKepuasan/$1');
$routes->post('/admin/editUser/(:any)', 'AdminController::editUser/$1');
$routes->delete('/admin/(:any)', 'AdminController::deleteUser/$1');

// Operator
$routes->get('/operator', 'OperatorController::index');

// Direktur
$routes->get('/direktur', 'DirekturController::index');

// General Manager
$routes->get('/gm', 'GMController::index');

// Supervisor
$routes->get('/supervisor', 'SupervisorController::index');
$routes->get('/supervisor/profil', 'SupervisorController::profil');
$routes->post('/supervisor/profil', 'SupervisorController::profil');
$routes->get('/supervisor/presensi', 'SupervisorController::presensi');
$routes->get('/supervisor/logbook', 'SupervisorController::logbook');
$routes->get('/supervisor/capaianKerja', 'SupervisorController::capaianKerja');
$routes->get('/supervisor/saran', 'SupervisorController::saran');
$routes->get('/supervisor/klarifikasi', 'SupervisorController::klarifikasi');
$routes->get('/supervisor/indeksKepuasan', 'SupervisorController::indeksKepuasan');
$routes->get('/supervisor/validasi', 'SupervisorController::validasi');

// Staff
$routes->get('/staff', 'StaffController::index');
$routes->get('/staff/profil', 'StaffController::profil');
$routes->post('/staff/profil', 'StaffController::profil');
$routes->get('/staff/presensi', 'StaffController::presensi');
$routes->post('/staff/presensi', 'StaffController::presensi');
$routes->get('/staff/logbook', 'StaffController::logbook');
$routes->get('/staff/detailTugas/(:num)', 'StaffController::detailTugas/$1');
$routes->get('/staff/capaianKerja', 'StaffController::capaianKerja');
$routes->get('/staff/saran', 'StaffController::saran');
$routes->post('/staff/saran', 'StaffController::saran');
$routes->get('/staff/klarifikasi', 'StaffController::klarifikasi');
$routes->get('/staff/indeksKepuasan', 'StaffController::indeksKepuasan');
$routes->post('/staff/saveIndeksKepuasan', 'StaffController::saveIndeksKepuasan');
/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need to it be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
