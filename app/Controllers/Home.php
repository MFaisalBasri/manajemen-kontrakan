<?php

namespace App\Controllers;

use App\Models\FasilitasModel;
use App\Models\PenghuniModel;
use App\Models\KamarModel;
use App\Models\UserModel;

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
        $nama = $this->request->getVar('nama');
        $password = $this->request->getVar('password');

        $penghuni = $penghuniModel->where('nama', $nama)->first();

        if ($penghuni) {
            $user = $userModel->where('id_penghuni', $penghuni['id'])->first();
            if ($user) {
                $pass = $user['password'];
                if ($pass === $password) {
                    $ses_data = [
                        'id' => $user['id'],
                        'id_penghuni' => $user['id_penghuni'],
                        'nama' => $penghuni['nama'],
                        'role' => $user['role'],
                        'isLoggedIn' => TRUE
                    ];
                    $session->set($ses_data);
                    if ($user['role'] === 'admin') {
                        return redirect()->to('/dashboard');
                    } else {
                        return redirect()->to('/dashboard-user');
                    }
                } else {
                    $session->setFlashdata('msg', 'Password salah');
                    return redirect()->to('/info-kost');
                }
            } else {
                $session->setFlashdata('msg', 'User tidak ditemukan');
                return redirect()->to('/login');
            }
        } else {
            $session->setFlashdata('msg', 'Nama penghuni tidak ditemukan');
            return redirect()->to('/data-user');
        }
    }


    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }

    public function dashboard(): string
    {
        $data = [
            'title'     => 'Dashboard Admin',
        ];


        return view('templates/header', $data)
            . view('templates/sidebar')
            . view('admin/dashboard')
            . view('templates/footer');
    }
}
