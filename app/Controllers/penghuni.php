<?php

namespace App\Controllers;

use App\Models\PenghuniModel;
use App\Models\PenyewaanModel;
use App\Models\RegistrasiModel;

// Add this line to import the class.
use CodeIgniter\Exceptions\PageNotFoundException;

class Penghuni extends BaseController
{
    public function index()
    {
        $model = new PenghuniModel();

        $data = [
            'penghuni_list' => $model->getPenghuni(),
            'title'     => 'Data Penghuni',
        ];

        // Tampilkan view dengan data yang telah didapatkan
        return view('templates/header', $data)
            . view('templates/sidebar')
            . view('admin/penghuni/dataPenghuni')
            . view('templates/footer');
    }

    public function indexPenghuni()
    {
        $session = session();
        $id_pemilik = $session->get('id');
        $model = new PenyewaanModel();

        $data = [
            'penghuni_list' => $model->getPenyewaan($id_pemilik),
            'title'     => 'Data Penghuni',
        ];

        // Tampilkan view dengan data yang telah didapatkan
        return view('templates/header', $data)
            . view('pemilik/sidebar')
            . view('pemilik/penghuni/dataPenghuni')
            . view('templates/footer');
    }

    public function tambahPenghuni(): string
    {
        helper('form');
        $data = [
            'title'     => 'Tambah Data Penghuni',
        ];

        return view('templates/header', $data)
            . view('pemilik/sidebar')
            . view('pemilik/penghuni/tambahPenghuni')
            . view('templates/footer');
    }

    public function create()
    {
        helper('form');

        $data = $this->request->getPost(['id', 'email', 'nik', 'nama', 'tanggal_lahir', 'no_hp', 'pekerjaan', 'tujuan']);

        // Checks whether the submitted data passed the validation rules.
        if (!$this->validateData($data, [
            'nik' => 'required|max_length[255]|min_length[3]',
            'nama' => 'required|max_length[255]|min_length[3]',
            'tanggal_lahir' => 'required|max_length[255]|min_length[3]',
            'no_hp' => 'integer',
            'pekerjaan' => 'required|max_length[255]|min_length[3]',
            'tujuan' => 'required|max_length[255]|min_length[3]',
            'email' => 'required|max_length[255]|min_length[3]',
        ])) {
            // The validation fails, so returns the form.
            return $this->tambahPenghuni();
        }

        // Gets the validated data.
        $post = $this->validator->getValidated();

        // Model untuk tabel pengguna
        $registrasiModel = new RegistrasiModel();

        // Cari pengguna berdasarkan nama
        $user = $registrasiModel->where('email', $post['email'])->first();

        if (!$user) {
            // Email atau password tidak valid
            session()->setFlashdata('danger', 'Email yang anda masukan tidak terdaftar!');
            return redirect()->to('/tambah-penghuni');
        }

        $userId = $user['id']; // ID pengguna berdasarkan email dan password

        // Model untuk tabel penghuni
        $penghuniModel = model(PenghuniModel::class); // Asumsi nama model adalah PenghuniModel
        $penghuniModel->insert([
            'id_pengguna' =>  $userId,
            'nik' =>  $post['nik'],
            'nama' => $post['nama'],
            'tgl_lahir' => $post['tanggal_lahir'],
            'no_hp' => $post['no_hp'],
            'pekerjaan' => $post['pekerjaan'],
            'tujuan' => $post['tujuan'],
        ]);

        session()->setFlashdata('success', 'Data berhasil disimpan.');
        return redirect()->to('data-penghuni-kontrakan');
    }

    public function detailPenghuni($id)
    {
        $model = model(PenghuniModel::class);

        $data = [
            'penghuni_list' => $model->where('id', $id)->findAll(),
            'title'     => 'Data Penghuni',
        ];

        return view('templates/header', $data)
            . view('pemilik/sidebar')
            . view('pemilik/penghuni/editPenghuni')
            . view('templates/footer');
    }

    public function detailPenghuniAdmin($id)
    {
        $model = model(PenghuniModel::class);

        $data = [
            'penghuni_list' => $model->where('id', $id)->findAll(),
            'title'     => 'Data Penghuni',
        ];

        return view('templates/header', $data)
            . view('templates/sidebar')
            . view('admin/penghuni/editPenghuni')
            . view('templates/footer');
    }

    public function editPenghuni()
    {
        helper('form');

        // Ambil data dari POST termasuk nomor_kamar
        $data = $this->request->getPost(['id', 'nik', 'nama', 'tanggal_lahir', 'no_hp', 'pekerjaan', 'tujuan']);

        // Validasi data
        if (!$this->validateData($data, [
            'id' => 'required|min_length[1]',
            'nik' => 'required|max_length[255]|min_length[3]',
            'nama' => 'required|max_length[255]|min_length[3]',
            'tanggal_lahir' => 'required|max_length[255]|min_length[3]',
            'no_hp' => 'integer',
            'pekerjaan' => 'required|max_length[255]|min_length[3]',
            'tujuan' => 'required|max_length[255]|min_length[3]',
        ])) {
            // The validation fails, so returns the form.
            return $this->editPenghuni();
        }

        // Dapatkan data yang divalidasi
        $validatedData = $this->validator->getValidated();

        // Cek apakah data dengan nomor_kamar tersebut ada
        $model = model(PenghuniModel::class);

        // Update data kamar
        $model->update($validatedData['id'], [
            'nik' => $validatedData['nik'],
            'nama' => $validatedData['nama'],
            'tgl_lahir' => $validatedData['tanggal_lahir'],
            'no_hp' => $validatedData['no_hp'],
            'pekerjaan' => $validatedData['pekerjaan'],
            'tujuan' => $validatedData['tujuan'],
        ]);
        session()->setFlashdata('success', 'Data berhasil diupdate.');
        // Redirect atau tampilkan view setelah berhasil update
        return redirect()->to('/data-penghuni-kontrakan')->with('success', 'Data Penghuni berhasil diupdate');
    }

    public function editPenghuniAdmin()
    {
        helper('form');

        // Ambil data dari POST termasuk nomor_kamar
        $data = $this->request->getPost(['id', 'nik', 'nama', 'tanggal_lahir', 'no_hp', 'pekerjaan', 'tujuan']);

        // Validasi data
        if (!$this->validateData($data, [
            'id' => 'required|min_length[1]',
            'nik' => 'required|max_length[255]|min_length[3]',
            'nama' => 'required|max_length[255]|min_length[3]',
            'tanggal_lahir' => 'required|max_length[255]|min_length[3]',
            'no_hp' => 'integer',
            'pekerjaan' => 'required|max_length[255]|min_length[3]',
            'tujuan' => 'required|max_length[255]|min_length[3]',
        ])) {
            // The validation fails, so returns the form.
            return $this->editPenghuni();
        }

        // Dapatkan data yang divalidasi
        $validatedData = $this->validator->getValidated();

        // Cek apakah data dengan nomor_kamar tersebut ada
        $model = model(PenghuniModel::class);

        // Update data kamar
        $model->update($validatedData['id'], [
            'nik' => $validatedData['nik'],
            'nama' => $validatedData['nama'],
            'tgl_lahir' => $validatedData['tanggal_lahir'],
            'no_hp' => $validatedData['no_hp'],
            'pekerjaan' => $validatedData['pekerjaan'],
            'tujuan' => $validatedData['tujuan'],
        ]);
        session()->setFlashdata('success', 'Data berhasil diupdate.');
        // Redirect atau tampilkan view setelah berhasil update
        return redirect()->to('/data-penghuni')->with('success', 'Data Penghuni berhasil diupdate');
    }

    public function hapusPenghuni($id)
    {
        $model = model(PenghuniModel::class);

        // Ambil data kamar berdasarkan nomor kamar
        $kamar = $model->where('id', $id)->first();

        if (!$kamar) {
            session()->setFlashdata('error', 'Data Penghuni tidak ditemukan.');
            return redirect()->to('data-penghuni');
        }

        // Hapus entri data kamar dari basis data
        $model->where('id', $id)->delete();


        session()->setFlashdata('success', 'Data berhasil dihapus.');
        return redirect()->to('data-penghuni-kontrakan');
    }
}
