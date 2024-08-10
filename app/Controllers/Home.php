<?php

namespace App\Controllers;

use App\Models\PenghuniModel;
use App\Models\KamarModel;
use App\Models\UserModel;
use App\Models\PenyewaanModel;
use App\Models\AdminModel;
use App\Models\RegistrasiModel;

class Home extends BaseController
{
    public function index(): string
    {
        $data = [
            'title'     => 'Sewa Kontrakan',
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
            'title'     => 'Informasi Kontrakan',
        ];


        return view('templates/headerMain', $data)
            . view('pages/infoKontrakan')
            . view('templates/footer');
    }

    public function detailProperti($id): string
    {
        $model = model(KamarModel::class);

        $data = [
            'kamar_list' => $model->where('id', $id)->findAll(),
            'title'     => 'Detail Kontrakan',
        ];


        return view('templates/headerMain', $data)
            . view('pages/detail')
            . view('templates/footer');
    }

    public function sewaKontrakan($id): string
    {
        helper('form');
        $model = model(KamarModel::class);

        $data = [
            'kamar_list' => $model->where('id', $id)->findAll(),
            'title'     => 'Sewa Kontrakan',
        ];


        return view('templates/headerMain', $data)
            . view('pages/formSewa')
            . view('templates/footer');
    }

    public function jadwalKunjungan($id): string
    {
        helper('form');
        $model = model(KamarModel::class);

        $data = [
            'kamar_list' => $model->where('id', $id)->findAll(),
            'title'     => 'Jadwal Kunjungan',
        ];


        return view('templates/headerMain', $data)
            . view('pages/jadwal')
            . view('templates/footer');
    }

    public function registrasi(): string
    {
        helper('form');
        $data = [
            'title'     => 'Registrasi',
        ];

        return view('templates/headerMain', $data)
            . view('pages/registrasi')
            . view('templates/footer');
    }

    public function registAkun()
    {
        helper('form');

        $data = $this->request->getPost(['nama', 'no_hp', 'email', 'password', 'status']);

        // Checks whether the submitted data passed the validation rules.
        if (!$this->validateData($data, [
            'nama' => 'required|max_length[255]|min_length[3]',
            'no_hp' => 'integer',
            'email' => 'required|max_length[255]|min_length[3]',
            'password' => 'required|max_length[255]|min_length[3]',
            'status' => 'required|max_length[255]|min_length[3]',
        ])) {
            // The validation fails, so returns the form.
            return $this->registrasi();
        }

        // Gets the validated data.
        $validatedData = $this->validator->getValidated();

        $model = model(RegistrasiModel::class);
        $model->insert([
            'nama' => $validatedData['nama'],
            'no_hp' => $validatedData['no_hp'],
            'email' => $validatedData['email'],
            'password' => $validatedData['password'],
            'status' => $validatedData['status'],
        ]);

        session()->setFlashdata('success', 'Registrasi berhasil.');
        return redirect()->to('login');
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
        $registrasiModel = new RegistrasiModel();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        // Cari pengguna berdasarkan nama
        $user = $registrasiModel->where('email', $email)->first();

        if ($user) {
            // Cocokkan password
            if ($user['password'] === $password) {
                // Data sesi untuk pengguna ditemukan
                $ses_data = [
                    'id' => $user['id'],
                    'nama' => $user['nama'],
                    'email' => $user['email'],
                    'status' => $user['status'],
                    'isLoggedIn' => TRUE
                ];
                $session->set($ses_data);

                // Redirect sesuai status pengguna
                if ($user['status'] === 'penyewa') {
                    return redirect()->to('/dashboard-user');
                } elseif ($user['status'] === 'pemilik') {
                    return redirect()->to('/dashboard-pemilik');
                } else {
                    // Jika status tidak dikenali
                    $session->setFlashdata('danger', 'Status tidak dikenali');
                    return redirect()->to('/login');
                }
            } else {
                // Jika password tidak cocok
                $session->setFlashdata('danger', 'Password salah');
                return redirect()->to('/login');
            }
        } else {
            // Jika pengguna tidak ditemukan
            $session->setFlashdata('danger', 'Username tidak ditemukan');
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


    // public function dashboard(): string
    // {

    //     $session = session();
    //     if (!$session->get('id')) {
    //         return redirect()->to('/login');
    //     }

    //     $penghuni = model(PenghuniModel::class);
    //     $kamar = model(KamarModel::class);
    //     $penyewaan = model(PenyewaanModel::class);
    //     $admin = model(AdminModel::class);

    //     $data = [
    //         'dataPenghuni' => $penghuni->getTotalPenghuni(),
    //         'dataKamar' => $kamar->getTotalKamar(),
    //         'dataPenyewaan' => $penyewaan->getTotalPenyewaan(),
    //         'dataAdmin' => $admin->getTotalAdmin(),
    //         'title'     => 'Dashboard Admin',
    //     ];


    //     return view('templates/header', $data)
    //         . view('templates/sidebar')
    //         . view('admin/dashboard')
    //         . view('templates/footer');
    // }

    public function dashboardPemilik(): string
    {

        $session = session();
        $id_pemilik = $session->get('id');

        if (!$session->get('id')) {
            return redirect()->to('/login');
        }

        $penghuni = model(PenghuniModel::class);
        $kamar = model(KamarModel::class);
        $penyewaan = model(PenyewaanModel::class);
        $admin = model(AdminModel::class);

        $data = [
            'dataPenghuni' => $penghuni->getTotalPenghuni(),
            'dataKamar' => $kamar->totalKontrakan($id_pemilik),
            'dataPenyewaan' => $penyewaan->totalPenyewaan($id_pemilik),
            'dataAdmin' => $admin->getTotalAdmin(),
            'title'     => 'Dashboard Pemilik',
        ];


        return view('templates/header', $data)
            . view('pemilik/sidebar')
            . view('pemilik/dashboard')
            . view('templates/footer');
    }
}
