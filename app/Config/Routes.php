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
$routes->get('galeri-sarpras/(:segment)', 'Home::detailSarpras/$1');
$routes->get('kegiatan-siswa', 'Home::kegiatan');
$routes->get('galeri-kegiatan/(:segment)', 'Home::galeriKegiatan/$1');
$routes->get('kesetaraan-paket-c', 'Home::paketc');
$routes->get('kesetaraan-paket-b', 'Home::paketb');
$routes->get('tutor-dan-staff', 'Home::tutor');
$routes->get('berita-lembaga/(:segment)', 'Home::berita/$1');
$routes->get('berita-lembaga', 'Home::berita');
$routes->get('penerimaan-peserta-didik-baru', 'Home::ppdb');
$routes->get('kontak-kami', 'Home::kontak');
$routes->get('dashboard', 'Home::dashboard');
$routes->get('edit-dashboard/(:segment)', 'Home::edit/$1');
$routes->put('home/(:segment)', 'Home::update/$1');
$routes->get('pages', 'Home::pages');
$routes->get('edit-pages/(:segment)', 'Home::editPages/$1');
$routes->put('pages/(:segment)', 'Home::updatePages/$1');

$routes->get('kategori-blog', 'KategoriBlog::index');
$routes->get('kategori-blog/new', 'KategoriBlog::new');
$routes->post('kategori-blog', 'KategoriBlog::create');
$routes->get('kategori-blog/(:segment)/edit', 'KategoriBlog::edit/$1');
$routes->put('kategori-blog/(:segment)', 'KategoriBlog::update/$1');
$routes->delete('kategori-blog/(:segment)', 'KategoriBlog::delete/$1');

$routes->get('posts/trash', 'Posts::trash');
$routes->get('posts/restore/(:segment)', 'Posts::restore/$1');
$routes->get('posts/restore', 'Posts::restore');
$routes->delete('posts/delpermanent/(:segment)', 'Posts::delpermanent/$1');
$routes->delete('posts/delpermanent', 'Posts::delpermanent');
$routes->resource('posts');

$routes->get('kategori-sarpras', 'KategoriSarpras::index');
$routes->get('kategori-sarpras/new', 'KategoriSarpras::new');
$routes->post('kategori-sarpras', 'KategoriSarpras::create');
$routes->get('kategori-sarpras/(:segment)/edit', 'KategoriSarpras::edit/$1');
$routes->put('kategori-sarpras/(:segment)', 'KategoriSarpras::update/$1');
$routes->delete('kategori-sarpras/(:segment)', 'KategoriSarpras::delete/$1');

$routes->get('sarpras/trash', 'Sarpras::trash');
$routes->get('sarpras/restore/(:segment)', 'Sarpras::restore/$1');
$routes->get('sarpras/restore', 'Sarpras::restore');
$routes->delete('sarpras/delpermanent/(:segment)', 'Sarpras::delpermanent/$1');
$routes->delete('sarpras/delpermanent', 'Sarpras::delpermanent');
$routes->resource('sarpras');

$routes->get('kategori-kegiatan', 'KategoriKegiatan::index');
$routes->get('kategori-kegiatan/new', 'KategoriKegiatan::new');
$routes->post('kategori-kegiatan', 'KategoriKegiatan::create');
$routes->get('kategori-kegiatan/(:segment)/edit', 'KategoriKegiatan::edit/$1');
$routes->put('kategori-kegiatan/(:segment)', 'KategoriKegiatan::update/$1');
$routes->delete('kategori-kegiatan/(:segment)', 'KategoriKegiatan::delete/$1');

$routes->get('kegiatan/trash', 'Kegiatan::trash');
$routes->get('kegiatan/restore/(:segment)', 'Kegiatan::restore/$1');
$routes->get('kegiatan/restore', 'Kegiatan::restore');
$routes->delete('kegiatan/delpermanent/(:segment)', 'Kegiatan::delpermanent/$1');
$routes->delete('kegiatan/delpermanent', 'Kegiatan::delpermanent');
$routes->resource('kegiatan');

$routes->get('data-siswa-psb', 'PSB::index');
$routes->get('detail-peserta/(:segment)', 'PSB::detailPeserta/$1');
$routes->get('download-foto/(:segment)', 'PSB::downloadFoto/$1');
$routes->get('download-akta/(:segment)', 'PSB::downloadAkta/$1');
$routes->get('download-kk/(:segment)', 'PSB::downloadKk/$1');
$routes->get('download-kip/(:segment)', 'PSB::downloadKip/$1');
$routes->get('download-pkh/(:segment)', 'PSB::downloadPkh/$1');

$routes->get('users', 'Users::index');
$routes->get('users/new', 'Users::new');
$routes->post('users', 'Users::create');
$routes->delete('users/(:segment)', 'Users::delete/$1');

service('auth')->routes($routes);


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
