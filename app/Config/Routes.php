<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\Kamar;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/info-kost', 'Home::infoKost');
$routes->get('/login', 'Home::login');
$routes->get('/logout', 'Home::logout');
$routes->post('/auth', 'Home::auth');
$routes->get('/dashboard', 'Home::dashboard',);

$routes->get('data-kamar', 'Kamar::index');
$routes->get('tambah-kamar', 'Kamar::tambahKamar');
$routes->post('tambah-kamar', 'Kamar::create');
$routes->get('hapus-kamar/(:segment)', 'Kamar::hapusKamar/$1');
$routes->get('detail-kamar/(:segment)', 'Kamar::detailKamar/$1');
$routes->post('edit-kamar', 'Kamar::editKamar');

$routes->get('data-user', 'Users::index');
$routes->get('tambah-user', 'Users::tambahUser');
$routes->get('detail-user/(:segment)', 'Users::detailUser/$1');
$routes->post('edit-user', 'Users::editUser');
$routes->get('hapus-user/(:segment)', 'Users::hapusUser/$1');

$routes->get('data-admin', 'Admin::index');
$routes->get('tambah-admin', 'Admin::tambahAdmin');
$routes->post('tambah-admin', 'Admin::create');

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

$routes->get('data-tagihan', 'Tagihan::index');
$routes->get('buat-tagihan', 'Tagihan::buatTagihan');
$routes->post('buat-tagihan', 'Tagihan::create');
$routes->get('hapus-tagihan/(:segment)', 'Tagihan::hapusTagihan/$1');

$routes->get('data-pembayaran', 'Pembayaran::index');


$routes->get('/data-ajuan', 'Home::dataAjuan');
$routes->get('/laporan-penyewaan', 'Home::laporanPenyewaan');

$routes->get('dashboard-user', 'DashboardUser::index');
$routes->get('dashboard-profile', 'DashboardUser::profile');
$routes->get('dashboard-akun', 'DashboardUser::akun');
$routes->get('tagihan-user', 'DashboardUser::tagihan');
$routes->get('bayar-tagihan', 'DashboardUser::pembayaran');
$routes->post('bayar-tagihan', 'Pembayaran::create');
$routes->get('pembayaran-user', 'DashboardUser::pembayaran');

$routes->get('lihat-bukti/(:segment)', 'Pembayaran::lihatBukti/$1');


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
