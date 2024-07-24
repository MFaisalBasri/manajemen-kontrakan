<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\PenghuniModel;
use App\Models\TagihanModel;
use App\Models\PenyewaanModel;

// Add this line to import the class.
use CodeIgniter\Exceptions\PageNotFoundException;

class DashboardUser extends BaseController
{
    public function index()
    {
        $model = new UserModel();

        $session = session();
        $data = [
            'id' => $session->get('id'),
            'id_penghuni' => $session->get('id_penghuni'),
            'nama' => $session->get('nama'),
            'role' => $session->get('role'),
            'title' => 'Dashboard'
        ];


        // Tampilkan view dengan data yang telah didapatkan
        return view('templates/header', $data)
            . view('user/templates/sidebar')
            . view('user/dashboard')
            . view('templates/footer');
    }

    public function profile()
    {
        helper('form');
        $model = new PenghuniModel();

        $session = session();
        $id_penghuni = $session->get('id_penghuni'); // Ambil id_penghuni dari session

        // Ambil data penghuni berdasarkan id_penghuni
        $penghuni = $model->where('id', $id_penghuni)->first();
        if (!$penghuni) {
            // Handle kasus jika penghuni tidak ditemukan
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Penghuni tidak ditemukan.');
        }

        $data = [
            'penghuni' => $penghuni,
            'title' => 'My Profile'
        ];


        // Tampilkan view dengan data yang telah didapatkan
        return view('templates/header', $data)
            . view('user/templates/sidebar')
            . view('user/profile')
            . view('templates/footer');
    }

    public function akun()
    {
        helper('form');
        $model = new UserModel();
        $session = session();
        $data = [
            'id' => $session->get('id'),
            'id_penghuni' => $session->get('id_penghuni'),
            'nama' => $session->get('nama'),
            'password' => $session->get('password'),
            'role' => $session->get('role'),
            'user' => $model->getDetailUser($session->get('id')),
            'title' => 'Akun'
        ];


        // Tampilkan view dengan data yang telah didapatkan
        return view('templates/header', $data)
            . view('user/templates/sidebar')
            . view('user/akun')
            . view('templates/footer');
    }

    public function tagihan()
    {
        $session = session();
        $model = new TagihanModel();

        // Ambil id_penghuni dari session
        $id_penghuni = $session->get('id_penghuni');

        // Ambil data tagihan berdasarkan id_penghuni
        $data = [
            'tagihan_list' => $model->getTagihanByPenghuni($id_penghuni),
            'title' => 'Data Tagihan'
        ];

        // Tampilkan view dengan data yang telah didapatkan
        return view('templates/header', $data)
            . view('user/templates/sidebar')
            . view('user/tagihan')
            . view('templates/footer');
    }

    public function pembayaran()
    {
        helper('form');
        $model = new TagihanModel();

        $session = session();
        // Ambil id_penghuni dari session
        $id_penghuni = $session->get('id_penghuni');

        // Ambil data tagihan berdasarkan id_penghuni
        $data = [
            'tagihan_list' => $model->getTagihanByPenghuni($id_penghuni),
            'title'     => 'Bayar Tagihan',
        ];

        return view('templates/header', $data)
            . view('user/templates/sidebar')
            . view('user/pembayaran')
            . view('templates/footer');
    }

    public function editProfile()
    {
        helper('form');

        // Ambil data dari POST termasuk nomor_kamar
        $data = $this->request->getPost(['id', 'nama', 'tanggal_lahir', 'pekerjaan']);

        // Validasi data
        if (!$this->validateData($data, [
            'id' => 'required|min_length[1]',
            'nama' => 'required|max_length[255]|min_length[3]',
            'tanggal_lahir' => 'required|max_length[255]|min_length[3]',
            'pekerjaan' => 'required|max_length[255]|min_length[3]',
        ])) {
            // The validation fails, so returns the form.
            return $this->editProfile();
        }

        // Dapatkan data yang divalidasi
        $validatedData = $this->validator->getValidated();

        // Cek apakah data dengan nomor_kamar tersebut ada
        $model = model(PenghuniModel::class);

        // Update data kamar
        $model->update($validatedData['id'], [
            'nama' => $validatedData['nama'],
            'tgl_lahir' => $validatedData['tanggal_lahir'],
            'pekerjaan' => $validatedData['pekerjaan'],
        ]);
        session()->setFlashdata('success', 'Data berhasil diupdate.');
        // Redirect atau tampilkan view setelah berhasil update
        return redirect()->to('/dashboard-profile')->with('success', 'Profile berhasil diupdate');
    }

    public function ubahPassword()
    {
        helper('form');

        // Ambil data dari POST termasuk nomor_kamar
        $data = $this->request->getPost(['id', 'nama', 'password']);

        // Validasi data
        if (!$this->validateData($data, [
            'id' => 'required|min_length[1]',
            'nama' => 'required|max_length[255]|min_length[3]',
            'password' => 'required|max_length[255]|min_length[3]',
        ])) {
            // The validation fails, so returns the form.
            return $this->akun();
        }

        // Dapatkan data yang divalidasi
        $validatedData = $this->validator->getValidated();

        // Cek apakah data dengan nomor_kamar tersebut ada
        $model = model(UserModel::class);

        // Update data User
        $model->update($validatedData['id'], [
            'password' => $validatedData['password'],
        ]);
        session()->setFlashdata('success', 'Password berhasil diupdate.');
        // Redirect atau tampilkan view setelah berhasil update
        return redirect()->to('/dashboard-akun')->with('success', 'Password berhasil diupdate');
    }

    public function hapusUser($id)
    {
        $model = model(UserModel::class);

        // Ambil data kamar berdasarkan nomor kamar
        $user = $model->where('id', $id)->first();

        if (!$user) {
            session()->setFlashdata('error', 'Data Tagihan tidak ditemukan.');
            return redirect()->to('data-tagihan');
        }

        // Hapus entri data kamar dari basis data
        $model->where('id', $id)->delete();


        session()->setFlashdata('success', 'Data berhasil dihapus.');
        return redirect()->to('data-user');
    }
}
