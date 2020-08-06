<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
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
$routes->post('/chat', 'AuthController::tambahChat');
$routes->get('/logout', 'AuthController::logout');
$routes->get('/daftarHadir', 'AuthController::daftarHadir');
$routes->get('/geolokasi', 'AuthController::geolokasi');
$routes->get('/logbookApi/(:any)', 'StaffController::logbookApi/$1');
$routes->get('/kinerjaApi', 'StaffController::kinerjaApi');
$routes->get('/exportCapaianKerja', 'StaffController::exportCapaianKerja');
$routes->get('/exportLaporanEvaluasi', 'StaffController::exportLaporanEvaluasi');
$routes->get('/exportLaporanKeaktifan', 'StaffController::exportLaporanKeaktifan');
$routes->post('/staff/inputLogbookApi', 'StaffController::inputLogbookApi');

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
$routes->post('/admin/editIndeksPertanyaan', 'AdminController::editIndeksPertanyaan');
$routes->get('/admin/hapusIndeksPertanyaan/(:any)/(:any)', 'AdminController::hapusIndeksPertanyaan/$1/$2');
$routes->post('/admin/tambahIndeksKepuasan', 'AdminController::tambahIndeksKepuasan');
$routes->get('/admin/apiPassword/(:any)', 'AdminController::apiPassword/$1');
$routes->post('/admin/ubahGambar/(:any)', 'AdminController::ubahGambar/$1');
$routes->post('/admin/ubahPassword/(:any)', 'AdminController::ubahPassword/$1');
$routes->get('/admin/settingPekerjaan/(:any)', 'AdminController::settingPekerjaan/$1');
$routes->get('/admin/ubahUser/(:any)', 'AdminController::ubahUser/$1');
$routes->get('/admin/hasilIndeksKepuasan/(:any)', 'AdminController::hasilIndeksKepuasan/$1');
$routes->post('/admin/editUser/(:any)', 'AdminController::editUser/$1');
$routes->get('/admin/penilaianKinerja', 'AdminController::penilaianKinerja');
$routes->post('/admin/tambahPenilaianKinerja', 'AdminController::tambahPenilaianKinerja');
$routes->get('/admin/editPenilaianKinerja/(:any)', 'AdminController::editPenilaianKinerja/$1');
$routes->get('/admin/hasilPenilaianKinerja/(:any)', 'AdminController::hasilPenilaianKinerja/$1');
$routes->post('/admin/tambahPertanyaanPenilaian', 'AdminController::tambahPertanyaanPenilaian');
$routes->post('/admin/ubahPertanyaanPenilaian', 'AdminController::ubahPertanyaanPenilaian');
$routes->get('/admin/hapusPertanyaanPenilaian/(:any)/(:any)', 'AdminController::hapusPertanyaanPenilaian/$1/$2');
$routes->get('/admin/daftarPengumuman', 'AdminController::daftarPengumuman');
$routes->get('/admin/daftarRancanganTugas', 'AdminController::daftarRancanganTugas');
$routes->get('/admin/lihatRancanganTugas/(:any)', 'AdminController::lihatRancanganTugas/$1');
$routes->post('/admin/tambahRancanganTugas', 'AdminController::tambahRancanganTugas');
$routes->post('/admin/ubahRancanganTugas', 'AdminController::ubahRancanganTugas');
$routes->get('/admin/hapusRancanganTugas/(:any)/(:any)', 'AdminController::hapusRancanganTugas/$1/$2');
$routes->get('/admin/apiDetailJabatan/(:any)', 'AdminController::apiDetailJabatan/$1');
$routes->post('/admin/tambahRiwayatPekerjaan/(:any)', 'AdminController::tambahRiwayatPekerjaan/$1');
$routes->delete('/admin/(:any)', 'AdminController::deleteUser/$1');
$routes->get('/admin/daftarJamKerja', 'AdminController::daftarJamKerja');
$routes->get('/admin/laporanKeaktifan', 'AdminController::laporanKeaktifan');
$routes->get('/admin/laporanKinerja', 'AdminController::laporanKinerja');
$routes->get('/admin/LaporanEvaluasi', 'AdminController::laporanEvaluasi');

// Operator
$routes->get('/operator', 'OperatorController::index');

// Direktur
$routes->get('/direktur', 'DirekturController::index');
$routes->get('/direktur/profil', 'DirekturController::profil');
$routes->post('/direktur/profil', 'DirekturController::profil');
$routes->get('/direktur/presensi', 'DirekturController::presensi');
$routes->get('/direktur/logbook', 'DirekturController::logbook');
$routes->get('/direktur/capaianKerja', 'DirekturController::capaianKerja');
$routes->get('/direktur/saran', 'DirekturController::saran');
$routes->get('/direktur/klarifikasi', 'DirekturController::klarifikasi');
$routes->get('/direktur/indeksKepuasan', 'DirekturController::indeksKepuasan');
$routes->get('/direktur/validasi', 'DirekturController::validasi');
$routes->get('/direktur/perizinan', 'DirekturController::perizinan');
$routes->get('/direktur/terimaIzin/(:any)', 'DirekturController::terimaIzin/$1');
$routes->get('/direktur/tolakIzin/(:any)', 'DirekturController::tolakIzin/$1');
$routes->get('/direktur/detailValidasi/(:num)', 'DirekturController::detailValidasi/$1');
$routes->get('/direktur/validasiSemua/(:num)', 'DirekturController::validasiSemua/$1');
$routes->get('/direktur/valid/(:num)/(:num)', 'DirekturController::valid/$1/$2');
$routes->get('/direktur/tolak/(:num)/(:num)', 'DirekturController::tolak/$1/$2');
$routes->post('/direktur/revisiTugas', 'DirekturController::revisiTugas');
$routes->get('/direktur/daftarPenilaian/(:any)', 'DirekturController::daftarPenilaian/$1');
$routes->post('/direktur/savePertanyaanPenilaian/(:any)', 'DirekturController::savePertanyaanPenilaian/$1');
$routes->get('/direktur/laporanKeaktifan', 'DirekturController::laporanKeaktifan');
$routes->get('/direktur/laporanKinerja', 'DirekturController::laporanKinerja');
$routes->get('/direktur/LaporanEvaluasi', 'DirekturController::laporanEvaluasi');

// General Manager
$routes->get('/gm', 'GMController::index');
$routes->get('/gm/profil', 'GMController::profil');
$routes->post('/gm/profil', 'GMController::profil');
$routes->get('/gm/presensi', 'GMController::presensi');
$routes->get('/gm/logbook', 'GMController::logbook');
$routes->get('/gm/capaianKerja', 'GMController::capaianKerja');
$routes->get('/gm/saran', 'GMController::saran');
$routes->get('/gm/klarifikasi', 'GMController::klarifikasi');
$routes->get('/gm/indeksKepuasan', 'GMController::indeksKepuasan');
$routes->get('/gm/validasi', 'GMController::validasi');
$routes->get('/gm/perizinan', 'GMController::perizinan');
$routes->get('/gm/terimaIzin/(:any)', 'GMController::terimaIzin/$1');
$routes->get('/gm/tolakIzin/(:any)', 'GMController::tolakIzin/$1');
$routes->get('/gm/detailValidasi/(:num)', 'GMController::detailValidasi/$1');
$routes->get('/gm/validasiSemua/(:num)', 'GMController::validasiSemua/$1');
$routes->get('/gm/valid/(:num)/(:num)', 'GMController::valid/$1/$2');
$routes->get('/gm/tolak/(:num)/(:num)', 'GMController::tolak/$1/$2');
$routes->post('/gm/revisiTugas', 'GMController::revisiTugas');
$routes->get('/gm/daftarPenilaian/(:any)', 'GMController::daftarPenilaian/$1');
$routes->post('/gm/savePertanyaanPenilaian/(:any)', 'GMController::savePertanyaanPenilaian/$1');
$routes->get('/gm/laporanKeaktifan', 'GMController::laporanKeaktifan');
$routes->get('/gm/laporanKinerja', 'GMController::laporanKinerja');
$routes->get('/gm/LaporanEvaluasi', 'GMController::laporanEvaluasi');

// Supervisor
$routes->get('/manager', 'ManagerController::index');
$routes->get('/manager/profil', 'ManagerController::profil');
$routes->post('/manager/profil', 'ManagerController::profil');
$routes->get('/manager/presensi', 'ManagerController::presensi');
$routes->get('/manager/logbook', 'ManagerController::logbook');
$routes->get('/manager/capaianKerja', 'ManagerController::capaianKerja');
$routes->get('/manager/saran', 'ManagerController::saran');
$routes->get('/manager/klarifikasi', 'ManagerController::klarifikasi');
$routes->get('/manager/indeksKepuasan', 'ManagerController::indeksKepuasan');
$routes->get('/manager/validasi', 'ManagerController::validasi');
$routes->get('/manager/perizinan', 'ManagerController::perizinan');
$routes->get('/manager/terimaIzin/(:any)', 'ManagerController::terimaIzin/$1');
$routes->get('/manager/tolakIzin/(:any)', 'ManagerController::tolakIzin/$1');
$routes->get('/manager/detailValidasi/(:num)', 'ManagerController::detailValidasi/$1');
$routes->get('/manager/validasiSemua/(:num)', 'ManagerController::validasiSemua/$1');
$routes->get('/manager/valid/(:num)/(:num)', 'ManagerController::valid/$1/$2');
$routes->get('/manager/tolak/(:num)/(:num)', 'ManagerController::tolak/$1/$2');
$routes->post('/manager/revisiTugas', 'ManagerController::revisiTugas');
$routes->get('/manager/daftarPenilaian/(:any)', 'ManagerController::daftarPenilaian/$1');
$routes->post('/manager/savePertanyaanPenilaian/(:any)', 'ManagerController::savePertanyaanPenilaian/$1');
$routes->get('/manager/laporanKeaktifan', 'ManagerController::laporanKeaktifan');
$routes->get('/manager/laporanKinerja', 'ManagerController::laporanKinerja');
$routes->get('/manager/LaporanEvaluasi', 'ManagerController::laporanEvaluasi');

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
$routes->get('/supervisor/perizinan', 'SupervisorController::perizinan');
$routes->get('/supervisor/terimaIzin/(:any)', 'SupervisorController::terimaIzin/$1');
$routes->get('/supervisor/tolakIzin/(:any)', 'SupervisorController::tolakIzin/$1');
$routes->get('/supervisor/detailValidasi/(:num)', 'SupervisorController::detailValidasi/$1');
$routes->get('/supervisor/validasiSemua/(:num)', 'SupervisorController::validasiSemua/$1');
$routes->get('/supervisor/valid/(:num)/(:num)', 'SupervisorController::valid/$1/$2');
$routes->get('/supervisor/tolak/(:num)/(:num)', 'SupervisorController::tolak/$1/$2');
$routes->post('/supervisor/revisiTugas', 'SupervisorController::revisiTugas');
$routes->get('/supervisor/daftarPenilaian/(:any)', 'SupervisorController::daftarPenilaian/$1');
$routes->post('/supervisor/savePertanyaanPenilaian/(:any)', 'SupervisorController::savePertanyaanPenilaian/$1');
$routes->get('/supervisor/laporanKeaktifan', 'SupervisorController::laporanKeaktifan');
$routes->get('/supervisor/laporanKinerja', 'SupervisorController::laporanKinerja');
$routes->get('/supervisor/LaporanEvaluasi', 'SupervisorController::laporanEvaluasi');

// Staff
$routes->get('/staff', 'StaffController::index');
$routes->get('/staff/profil', 'StaffController::profil');
$routes->post('/staff/profil', 'StaffController::profil');
$routes->post('/staff/ubahFoto', 'StaffController::ubahFoto');
$routes->post('/staff/ubahPassword', 'StaffController::ubahPassword');
$routes->post('/staff/ajukanIzin', 'StaffController::ajukanIzin');
$routes->get('/staff/presensi', 'StaffController::presensi');
$routes->post('/staff/presensi', 'StaffController::presensi');
$routes->get('/staff/logbook', 'StaffController::logbook');
$routes->post('/staff/inputLogbook', 'StaffController::inputLogbook');
$routes->get('/staff/selesaiInput/(:num)', 'StaffController::selesaiInput/$1');
$routes->get('/staff/hapusTugas/(:num)', 'StaffController::hapusTugas/$1');
$routes->get('/hapusTugasApi/(:any)', 'StaffController::hapusTugasApi/$1');
$routes->get('/staff/detailTugas/(:num)', 'StaffController::detailTugas/$1');
$routes->get('/staff/capaianKerja', 'StaffController::capaianKerja');
$routes->get('/staff/saran', 'StaffController::saran');
$routes->post('/staff/saran', 'StaffController::saran');
$routes->get('/staff/perizinan', 'StaffController::perizinan');
$routes->get('/staff/klarifikasi', 'StaffController::klarifikasi');
$routes->post('/staff/klarifikasiTugas', 'StaffController::klarifikasiTugas');
$routes->get('/staff/indeksKepuasan', 'StaffController::indeksKepuasan');
$routes->post('/staff/saveIndeksKepuasan', 'StaffController::saveIndeksKepuasan');
$routes->post('/staff/tambahChat', 'StaffController::tambahChat');
$routes->get('/staff/laporanKeaktifan', 'StaffController::laporanKeaktifan');
$routes->get('/staff/laporanKinerja', 'StaffController::laporanKinerja');
$routes->get('/staff/LaporanEvaluasi', 'StaffController::laporanEvaluasi');
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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
