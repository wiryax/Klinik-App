<?php

namespace Config;

use App\Controllers\admin;

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
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

//lang routes
$routes->get('language/(:any)', 'Language::index/$1');

// ajax
$routes->post('admin/getDataAjax', 'admin::getDataAjax');
$routes->post('admin/getDataPembayaranAjax', 'admin::getDataPembayaranAjax');

// Home Routes
$routes->get('/', 'Home::index');
$routes->get('Home', 'Home::index');
$routes->get('{locale}/Home', 'Home::index');
$routes->get('Home/Logout', 'Home::Logout');
$routes->post('Home/insertDataPasien', 'Home::insertDataPasien');
$routes->post('Home/Login', 'Home::Login');
$routes->get('Home/Registrasi', 'Home::Registrasi');

// Pasien Routes

$routes->get('pasien/', 'pasien::Antrian');
$routes->get('pasien/Resep', 'pasien::Resep');
$routes->get('pasien/Pembayaran', 'pasien::Pembayaran');
$routes->get('pasien/detilResep/(:any)/(:any)/(:any)', 'pasien::detilResep/$1/$2/$3');
$routes->get('pasien/delete/(:any)', 'pasien::delete/$1');

// form handler
$routes->get('pasien/saveAntrian', 'pasien::saveAntrian');
$routes->post('pasien/savePembayaran', 'pasien::savePembayaran');
$routes->get('pasien/masukan', 'pasien::masukan');
$routes->post('pasien/kirimMasukan', 'pasien::kirimMasukan');
// end pasien routs

// admin

// $routes->get('{locale}/admin', 'admin::index');
$routes->get('admin', 'admin::index');
$routes->get('admin/daftarPembayaran', 'admin::daftarPembayaran');
$routes->get('admin/Laporan', 'admin::Laporan');
$routes->get('admin/Masukan', 'admin::Masukan');
// end admin

//pdf report
$routes->get('admin/cetakTransaksi', 'admin::cetakTransaksi');
$routes->get('admin/cetakPembayaran', 'admin::cetakPembayaran');
$routes->get('admin/cetakDataDiagnosa', 'admin::cetakDataDiagnosa');
$routes->get('admin/cetakDataResep', 'admin::cetakDataResep');
$routes->get('admin/cetakDataPasien', 'admin::cetakDataPasien');


$routes->post('admin/saveDiagnosis', 'admin::saveDiagnosis');
$routes->post('admin/verifPembayaran', 'admin::verifPembayaran');
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
