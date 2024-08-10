<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\Kamar;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/info-kontrakan', 'Home::infoKost');
$routes->get('/detail-properti/(:segment)', 'Home::detailProperti/$1');
$routes->get('/jadwal-kunjungan/(:segment)', 'Home::jadwalKunjungan/$1');
$routes->post('/buat-kunjungan', 'Kunjungan::create');
$routes->get('/data-kunjungan', 'Kunjungan::index');
$routes->get('/data-kunjungan-admin', 'Kunjungan::indexKunjungan');

$routes->get('/login', 'Home::login');
$routes->get('/registrasi', 'Home::registrasi');
$routes->post('/registrasi', 'Home::registAkun');
$routes->get('/logout', 'Home::logout');
$routes->post('/auth', 'Home::auth');
$routes->get('setting-akun', 'Home::setting');
$routes->post('ubah-password-pemilik', 'Home::ubahPasswordPemilik');
$routes->get('/sewa-kontrakan/(:segment)', 'Home::sewaKontrakan/$1');
$routes->get('/dashboard-admin', 'Home::dashboard',);
$routes->get('/dashboard-pemilik', 'Home::dashboardPemilik',);

$routes->get('data-kamar', 'Kamar::index');
$routes->get('data-kontrakan-pemilik', 'Kamar::indexPemilik');
$routes->get('tambah-kamar', 'Kamar::tambahKamar');
$routes->get('tambah-kontrakan', 'Kamar::tambahKontrakan');
$routes->post('tambah-kontrakan', 'Kamar::create');
$routes->get('hapus-kontrakan/(:segment)', 'Kamar::hapusKontrakan/$1');
$routes->get('detail-kontrakan/(:segment)', 'Kamar::detailKontrakan/$1');
$routes->get('detail-kontrakan-admin/(:segment)', 'Kamar::detailKontrakanAdmin/$1');
$routes->post('edit-kontrakan', 'Kamar::editKontrakan');
$routes->post('edit-kamar', 'Kamar::editKamar');

$routes->get('data-user', 'Users::index');
$routes->get('tambah-user', 'Users::tambahUser');
$routes->post('tambah-user', 'Users::create');
$routes->get('detail-user/(:segment)', 'Users::detailUser/$1');
$routes->post('edit-user', 'Users::editUser');
$routes->get('hapus-user/(:segment)', 'Users::hapusUser/$1');

$routes->get('data-admin', 'Admin::index');
$routes->get('setting-admin', 'Admin::setting');
$routes->post('ubah-password-admin', 'Admin::ubahPasswordAdmin');
$routes->get('tambah-admin', 'Admin::tambahAdmin');
$routes->post('tambah-admin', 'Admin::create');
$routes->get('detail-admin/(:segment)', 'Admin::detailAdmin/$1');
$routes->post('edit-admin', 'Admin::editAdmin');
$routes->get('hapus-admin/(:segment)', 'Admin::hapusAdmin/$1');

$routes->get('data-penghuni', 'Penghuni::index');
$routes->get('data-penghuni-kontrakan', 'Penghuni::indexPenghuni');
$routes->get('tambah-penghuni', 'Penghuni::tambahPenghuni');
$routes->post('tambah-penghuni', 'Penghuni::create');
$routes->get('detail-penghuni/(:segment)', 'Penghuni::detailPenghuni/$1');
$routes->get('detail-penghuni-admin/(:segment)', 'Penghuni::detailPenghuniAdmin/$1');
$routes->post('edit-penghuni', 'Penghuni::editPenghuni');
$routes->post('edit-penghuni-admin', 'Penghuni::editPenghuniAdmin');
$routes->get('hapus-penghuni/(:segment)', 'Penghuni::hapusPenghuni/$1');

$routes->get('data-penyewaan', 'Penyewaan::index');
$routes->get('data-penyewaan-admin', 'Penyewaan::indexPenyewaan');
$routes->get('tambah-penyewaan', 'Penyewaan::tambahPenyewaan');
$routes->post('tambah-penyewaan', 'Penyewaan::create');
$routes->post('sewa-kontrakan', 'Penyewaan::sewaKontrakan');
$routes->get('detail-penyewaan/(:segment)', 'Penyewaan::detailPenyewaan/$1');
$routes->post('edit-penyewaan', 'penyewaan::editPenyewaan');
$routes->get('hapus-penyewaan/(:segment)', 'Penyewaan::hapusPenyewaan/$1');
$routes->get('setujui-penyewaan/(:segment)', 'Penyewaan::setujuiPenyewaan/$1');

$routes->get('data-tagihan', 'Tagihan::index');
$routes->get('data-tagihan-admin', 'Tagihan::indexTagihan');
$routes->get('buat-tagihan', 'Tagihan::buatTagihan');
$routes->post('buat-tagihan', 'Tagihan::create');
$routes->get('hapus-tagihan/(:segment)', 'Tagihan::hapusTagihan/$1');

$routes->get('data-pembayaran', 'Pembayaran::index');
$routes->get('data-pembayaran-admin', 'Pembayaran::indexPembayaran');
$routes->get('setujui-pembayaran/(:segment)', 'Pembayaran::setujuiPembayaran/$1');
$routes->get('tolak-pembayaran/(:segment)', 'Pembayaran::tolakPembayaran/$1');
$routes->get('laporan', 'Pembayaran::laporan');
$routes->get('laporan-pemilik', 'Pembayaran::laporanPemilik');


$routes->get('/data-ajuan', 'Home::dataAjuan');
$routes->get('/laporan-penyewaan', 'Home::laporanPenyewaan');

$routes->get('dashboard-user', 'DashboardUser::index');
$routes->get('dashboard-profile', 'DashboardUser::profile');
$routes->get('dashboard-akun', 'DashboardUser::akun');
$routes->post('edit-profile', 'DashboardUser::editProfile');
$routes->post('ubah-password', 'DashboardUser::ubahPassword');

$routes->get('tagihan-user', 'DashboardUser::tagihan');
$routes->get('bayar-tagihan/(:segment)', 'DashboardUser::pembayaran/$1');
$routes->post('bayar-tagihan', 'DashboardUser::createPembayaran');
$routes->get('pembayaran-user', 'DashboardUser::pembayaranUser');
$routes->get('laporan-user', 'DashboardUser::laporanUser');

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
