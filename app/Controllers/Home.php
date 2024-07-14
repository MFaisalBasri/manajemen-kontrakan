<?php

namespace App\Controllers;

use App\Models\FasilitasModel;
use App\Models\PenghuniModel;
use App\Models\KamarModel;

class Home extends BaseController
{
    public function index(): string
    {
        $data = [
            'title'     => 'Sistem KOST',
        ];

        return view('templates/headerMain', $data)
            . view('pages/home')
            . view('templates/footer');
    }

    public function infoKost(): string
    {
        $model = model(KamarModel::class);

        $data = [
            'kamar_list' => $model->getKamar(),
            'title'     => 'Informasi Kost',
        ];


        return view('templates/headerMain', $data)
            . view('pages/infoKost')
            . view('templates/footer');
    }

    public function login(): string
    {
        $data = [
            'title'     => 'Login',
        ];

        return view('templates/headerMain', $data)
            . view('pages/login')
            . view('templates/footer');
    }

    public function dashboard(): string
    {

        $data = [
            'title'     => 'Dashboard',
        ];

        return view('templates/header', $data)
            . view('templates/sidebar')
            . view('admin/dashboard')
            . view('templates/footer');
    }

    public function dataFasilitas(): string
    {
        $model = model(FasilitasModel::class);

        $data = [
            'fasilitas_list' => $model->getFasilitas(),
            'title'     => 'Data Fasilitas',
        ];

        return view('templates/header', $data)
            . view('templates/sidebar')
            . view('admin/fasilitas/dataFasilitas')
            . view('templates/footer');
    }

    public function TambahFasilitas(): string
    {
        $data = [
            'title'     => 'Data Fasilitas',
        ];

        return view('templates/header', $data)
            . view('templates/sidebar')
            . view('admin/fasilitas/tambahFasilitas')
            . view('templates/footer');
    }

    public function dataPenghuni(): string
    {
        $model = model(PenghuniModel::class);

        $data = [
            'penghuni_list' => $model->getPenghuni(),
            'title'     => 'Data Penghuni',
        ];

        return view('templates/header', $data)
            . view('templates/sidebar')
            . view('admin/penghuni/dataPenghuni')
            . view('templates/footer');
    }

    public function dataPenyewaan(): string
    {
        $data = [
            'title'     => 'Data Penyewaan',
        ];

        return view('templates/header', $data)
            . view('templates/sidebar')
            . view('admin/penyewaan/dataPenyewaan')
            . view('templates/footer');
    }

    public function tambahPenyewaan(): string
    {
        $data = [
            'title'     => 'Data Penyewaan',
        ];

        return view('templates/header', $data)
            . view('templates/sidebar')
            . view('admin/penyewaan/tambahPenyewaan')
            . view('templates/footer');
    }

    public function dataPembayaran(): string
    {
        $data = [
            'title'     => 'Data Pembayaran',
        ];

        return view('templates/header', $data)
            . view('templates/sidebar')
            . view('admin/pembayaran/dataPembayaran')
            . view('templates/footer');
    }

    public function dataAjuan(): string
    {
        $data = [
            'title'     => 'Data Ajuan',
        ];

        return view('templates/header', $data)
            . view('templates/sidebar')
            . view('admin/ajuan/dataAjuan')
            . view('templates/footer');
    }

    public function laporanPenyewaan(): string
    {
        $data = [
            'title'     => 'Laporan Penyewaan',
        ];

        return view('templates/header', $data)
            . view('templates/sidebar')
            . view('admin/laporan/dataLaporan')
            . view('templates/footer');
    }
}
