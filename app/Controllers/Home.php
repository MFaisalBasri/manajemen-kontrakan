<?php

namespace App\Controllers;

use App\Models\PenghuniModel;
use App\Models\KamarModel;
use App\Models\UserModel;
use App\Models\PenyewaanModel;
use App\Models\AdminModel;

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

    public function auth()
    {
        $session = session();
        $penghuniModel = new PenghuniModel();
        $userModel = new UserModel();
        $adminModel = new AdminModel(); // Pastikan model AdminModel sudah disesuaikan dengan struktur tabel Admin
        $nama = $this->request->getVar('nama');
        $password = $this->request->getVar('password');

        // Cari penghuni berdasarkan nama
        $penghuni = $penghuniModel->where('nama', $nama)->first();
        $admin = $adminModel->where('nama', $nama)->first();

        if ($penghuni || $admin) {
            if ($penghuni) {
                // Cek apakah ada user dengan id_penghuni yang sama
                $user = $userModel->where('id_penghuni', $penghuni['id'])->first();

                if ($user) {
                    // Jika ditemukan user, cocokkan password
                    if ($user['password'] === $password) {
                        // Data sesi untuk user ditemukan
                        $ses_data = [
                            'id' => $user['id'],
                            'id_penghuni' => $user['id_penghuni'],
                            'nama' => $penghuni['nama'],
                            'password' => $user['password'],
                            'role' => $user['role'],
                            'isLoggedIn' => TRUE
                        ];
                        $session->set($ses_data);

                        // Redirect sesuai role user
                        if ($user['role'] === 'admin') {
                            return redirect()->to('/dashboard');
                        } else {
                            return redirect()->to('/dashboard-user');
                        }
                    } else {
                        // Jika password tidak cocok
                        $session->setFlashdata('danger', 'Password salah');
                        return redirect()->to('/login');
                    }
                } else {
                    // Jika tidak ditemukan di tabel user, cek di tabel admin
                    $admin = $adminModel->where('nama', $nama)->first();

                    if ($admin) {
                        // Cocokkan password untuk admin
                        if ($admin['password'] === $password) {
                            // Data sesi untuk admin ditemukan
                            $ses_data = [
                                'id' => $admin['id'],
                                'nama' => $admin['nama'],
                                'role' => $admin['role'],
                                'isLoggedIn' => TRUE
                            ];
                            $session->set($ses_data);

                            // Redirect ke dashboard admin
                            return redirect()->to('/dashboard');
                        } else {
                            // Jika password admin tidak cocok
                            $session->setFlashdata('danger', 'Password salah');
                            return redirect()->to('/login');
                        }
                    } else {
                        // Jika tidak ditemukan di tabel admin maupun user
                        $session->setFlashdata('danger', 'User tidak ditemukan');
                        return redirect()->to('/login');
                    }
                }
            } elseif ($admin) {
                // Cocokkan password untuk admin
                if ($admin['password'] === $password) {
                    // Data sesi untuk admin ditemukan
                    $ses_data = [
                        'id' => $admin['id'],
                        'nama' => $admin['nama'],
                        'role' => $admin['role'],
                        'isLoggedIn' => TRUE
                    ];
                    $session->set($ses_data);

                    // Redirect ke dashboard admin
                    return redirect()->to('/dashboard');
                } else {
                    // Jika password admin tidak cocok
                    $session->setFlashdata('danger', 'Password salah');
                    return redirect()->to('/login');
                }
            }
        } else {
            // Jika nama penghuni tidak ditemukan
            $session->setFlashdata('danger', 'periksa kembali username!');
            return redirect()->to('/login');
        }
    }





    public function logout()
    {
        $session = session();
        $session->destroy();

        // Debug: periksa apakah sesi masih ada
        $session->setFlashdata('logout_message', 'Sesi berhasil dihapus');

        return redirect()->to('/login');
    }


    public function dashboard(): string
    {

        $session = session();
        if (!$session->get('id')) {
            return redirect()->to('/login');
        }

        $penghuni = model(PenghuniModel::class);
        $kamar = model(KamarModel::class);
        $penyewaan = model(PenyewaanModel::class);
        $admin = model(AdminModel::class);

        $data = [
            'dataPenghuni' => $penghuni->getTotalPenghuni(),
            'dataKamar' => $kamar->getTotalKamar(),
            'dataPenyewaan' => $penyewaan->getTotalPenyewaan(),
            'dataAdmin' => $admin->getTotalAdmin(),
            'title'     => 'Dashboard Admin',
        ];


        return view('templates/header', $data)
            . view('templates/sidebar')
            . view('admin/dashboard')
            . view('templates/footer');
    }
}
