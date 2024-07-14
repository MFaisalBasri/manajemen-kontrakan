<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\Kamar;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/info-kost', 'Home::infoKost');
$routes->get('/login', 'Home::login');
$routes->get('/dashboard', 'Home::dashboard');

$routes->get('data-kamar', 'Kamar::index');
$routes->get('tambah-kamar', 'Kamar::tambahKamar');
$routes->post('tambah-kamar', 'Kamar::create');
$routes->get('hapus-kamar/(:segment)', 'Kamar::hapusKamar/$1');
$routes->get('detail-kamar/(:segment)', 'Kamar::detailKamar/$1');
$routes->post('edit-kamar', 'Kamar::editKamar');

$routes->get('data-penghuni', 'Penghuni::index');
$routes->get('tambah-penghuni', 'Penghuni::tambahPenghuni');
$routes->post('tambah-penghuni', 'Penghuni::create');
$routes->get('detail-penghuni/(:segment)', 'Penghuni::detailPenghuni/$1');
$routes->post('edit-penghuni', 'Penghuni::editPenghuni');
$routes->get('hapus-penghuni/(:segment)', 'Penghuni::hapusPenghuni/$1');

$routes->get('data-penyewaan', 'Penyewaan::index');
$routes->get('tambah-penyewaan', 'Penyewaan::tambahPenyewaan');
$routes->post('tambah-penyewaan', 'penyewaan::create');
$routes->get('detail-penyewaan/(:segment)', 'Penyewaan::detailPenyewaan/$1');
$routes->post('edit-penyewaan', 'penyewaan::editPenyewaan');
$routes->get('hapus-penyewaan/(:segment)', 'Penyewaan::hapusPenyewaan/$1');

$routes->get('/data-pembayaran', 'Home::dataPembayaran');
$routes->get('/data-ajuan', 'Home::dataAjuan');
$routes->get('/laporan-penyewaan', 'Home::laporanPenyewaan');

use App\Controllers\News;
use App\Controllers\Pages;

// $routes->get('news', [News::class, 'index']);           // Add this line
// $routes->get('news/(:segment)', [News::class, 'show']); // Add this line

$routes->get('news', [News::class, 'index']);
$routes->get('news/new', [News::class, 'new']); // Add this line
$routes->post('news', [News::class, 'create']); // Add this line
$routes->get('news/(:segment)', [News::class, 'show']);

$routes->get('pages', [Pages::class, 'index']);
$routes->get('(:segment)', [Pages::class, 'view']);
