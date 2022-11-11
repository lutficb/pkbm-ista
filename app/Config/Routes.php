<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override(function () {
    return view('home/404');
});
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// $routes->get('/', 'Home::index');
$routes->get('home', 'Home::index');
$routes->get('tentang-lembaga', 'Home::about');
$routes->get('visi-dan-misi', 'Home::visiMisi');
$routes->get('legalitas-lembaga', 'Home::legalitas');
$routes->get('sarana-prasarana', 'Home::sarpras');
$routes->get('kesetaraan-paket-c', 'Home::paketc');
$routes->get('kesetaraan-paket-b', 'Home::paketb');
$routes->get('tutor-dan-staff', 'Home::tutor');
$routes->get('berita-lembaga', 'Home::berita');
$routes->get('penerimaan-peserta-didik-baru', 'Home::ppdb');
$routes->get('kontak-kami', 'Home::kontak');
$routes->get('dashboard', 'Home::dashboard');
$routes->get('edit-dashboard/(:segment)', 'Home::edit/$1');
$routes->put('home/(:segment)', 'Home::update/$1');

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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
