<?php

namespace App\Controllers;

use App\Models\PenyewaanModel;
use App\Models\KamarModel;
use App\Models\PenghuniModel;
use App\Models\RegistrasiModel;

// Add this line to import the class.
use CodeIgniter\Exceptions\PageNotFoundException;

class Penyewaan extends BaseController
{
    public function index()
    {
        $session = session();
        $id_pemilik = $session->get('id');
        $model = new PenyewaanModel();

        $data = [
            'penyewaan_list' => $model->getPenyewaanTagihan($id_pemilik),
            'title'     => 'Data Penyewaan',
        ];

        // Tampilkan view dengan data yang telah didapatkan
        return view('templates/header', $data)
            . view('pemilik/sidebar')
            . view('pemilik/penyewaan/dataPenyewaan')
            . view('templates/footer');
    }

    public function indexPenyewaan()
    {
        $session = session();
        $id_pemilik = $session->get('id');
        $model = new PenyewaanModel();

        $data = [
            'penyewaan_list' => $model->getPenyewaanAdmin(),
            'title'     => 'Data Penyewaan',
        ];

        // Tampilkan view dengan data yang telah didapatkan
        return view('templates/header', $data)
            . view('templates/sidebar')
            . view('admin/penyewaan/dataPenyewaan')
            . view('templates/footer');
    }

    public function tambahPenyewaan(): string
    {
        $modelPenghuni = new PenghuniModel();

        // Memanggil metode baru dari PenghuniModel untuk mendapatkan penghuni yang tersedia
        $penghuni_list = $modelPenghuni->getAvailableTenants();

        $modelPenyewaan = new PenyewaanModel();

        $session = session();
        $id_pemilik = $session->get('id');

        $model = model(KamarModel::class);

        $data = [
            'penghuni_list' => $penghuni_list,
            'kamar_list' => $model->getKontrakanPemilik($id_pemilik),
            'title' => 'Tambah Penyewaan',
        ];

        return view('templates/header', $data)
            . view('pemilik/sidebar')
            . view('pemilik/penyewaan/tambahPenyewaan')
            . view('templates/footer');
    }

    public function create()
    {
        helper('form');
        $session = session();
        $id_pemilik = $session->get('id');

        $data = $this->request->getPost(['nama_penghuni', 'nomor_kamar', 'tanggal_penyewaan', 'status']);

        // Checks whether the submitted data passed the validation rules.
        if (!$this->validateData($data, [
            'nama_penghuni' => 'required|max_length[255]|min_length[1]',
            'nomor_kamar' => 'required|max_length[255]|min_length[1]',
            'tanggal_penyewaan' => 'max_length[255]',
        ])) {
            // The validation fails, so returns the form.
            return $this->tambahPenyewaan();
        }

        // Gets the validated data.
        $post = $this->validator->getValidated();

        $model = model(PenyewaanModel::class);
        $model->insert([
            'id_penghuni' => $post['nama_penghuni'],
            'id_kamar' => $post['nomor_kamar'],
            'id_pemilik' => $id_pemilik,
            'tanggal_penyewaan' => $post['tanggal_penyewaan'],
            'status' => 'Disetujui',
        ]);

        $modelKamar = new KamarModel();
        $modelKamar->updateStatus($post['nomor_kamar'], 'Digunakan');

        session()->setFlashdata('success', 'Data berhasil disimpan.');
        return redirect()->to('data-penyewaan');
    }

    public function sewaKontrakan()
    {
        helper('form');

        // Ambil data dari request
        $data = $this->request->getPost(['email', 'password', 'nik', 'nama', 'tanggal_lahir', 'no_hp', 'pekerjaan', 'tujuan', 'id_kamar', 'id_pemilik', 'tanggal']);

        // Validasi data
        if (!$this->validateData($data, [
            'email' => 'required',
            'password' => 'required',
            'nik' => 'required',
            'nama' => 'required',
            'tanggal_lahir' => 'required|max_length[255]|min_length[3]',
            'tanggal' => 'required|max_length[255]|min_length[3]',
            'pekerjaan' => 'required',
            'tujuan' => 'required',
            'no_hp' => 'required',
            'id_kamar' => 'max_length[255]',
            'id_pemilik' => 'max_length[255]',
        ])) {
            // Validasi gagal, kembalikan ke form
            session()->setFlashdata('danger', 'Gagal Sewa kontrakan. harap isi seluruh form dengan benar!');
            return redirect()->to('/info-kontrakan');
        }

        // Ambil data yang telah tervalidasi
        $post = $this->validator->getValidated();

        // Model untuk tabel pengguna
        $registrasiModel = new RegistrasiModel();

        // Cari pengguna berdasarkan nama
        $user = $registrasiModel->where('email', $post['email'])
            ->where('password', $post['password']) // Pastikan hashing password sesuai dengan cara yang digunakan
            ->first();

        if (!$user) {
            // Email atau password tidak valid
            session()->setFlashdata('danger', 'Email/Password yang anda masukan tidak terdaftar!');
            return redirect()->to('/info-kontrakan');
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

        // Ambil ID penghuni yang baru dimasukkan
        $penghuniId = $penghuniModel->getInsertID();

        // Model untuk tabel penyewaan
        $penyewaanModel = model(PenyewaanModel::class); // Asumsi nama model adalah PenyewaanModel
        $penyewaanModel->insert([
            'id_penghuni' => $penghuniId,
            'id_kamar' => $post['id_kamar'],
            'id_pemilik' => $post['id_pemilik'],
            'tanggal_penyewaan' => $post['tanggal'],
            'status' => 'Belum disetujui',
        ]);

        // Model untuk tabel kamar
        $kamarModel = model(KamarModel::class); // Asumsi nama model adalah KamarModel
        $kamarModel->updateStatus('status', 'Digunakan');

        // Set flashdata dan redirect
        session()->setFlashdata('success', 'Berhasil Sewa kontrakan.');
        return redirect()->to('/');
    }



    public function detailPenyewaan($id)
    {
        $model = model(PenyewaanModel::class);

        $data = [
            'penyewaan_item' => $model->getDetailPenyewaan($id),
            'title'     => 'Data Penyewaan',
        ];

        return view('templates/header', $data)
            . view('pemilik/sidebar')
            . view('pemilik/penyewaan/editPenyewaan')
            . view('templates/footer');
    }

    public function editPenyewaan()
    {
        helper('form');

        // Ambil data dari POST termasuk nomor_kamar
        $data = $this->request->getPost(['id', 'nomor_kamar', 'tanggal_penyewaan']);

        // Validasi data
        if (!$this->validateData($data, [
            'id' => 'required|min_length[1]',
            'nomor_kamar' => 'required',
            'tanggal_penyewaan' => 'required|max_length[255]|min_length[3]',
        ])) {
            // The validation fails, so returns the form.
            return $this->editPenyewaan();
        }

        // Dapatkan data yang divalidasi
        $validatedData = $this->validator->getValidated();

        // Cek apakah data dengan nomor_kamar tersebut ada
        $model = model(PenyewaanModel::class);

        // Update data kamar
        $model->update($validatedData['id'], [
            'tanggal_penyewaan' => $validatedData['tanggal_penyewaan'],
        ]);
        session()->setFlashdata('success', 'Data berhasil diupdate.');
        // Redirect atau tampilkan view setelah berhasil update
        return redirect()->to('data-penyewaan')->with('success', 'Data kamar berhasil diupdate');
    }

    public function hapusPenyewaan($id)
    {
        $model = model(PenyewaanModel::class);

        // Ambil data kamar berdasarkan nomor kamar
        $kamar = $model->where('id', $id)->first();

        if (!$kamar) {
            session()->setFlashdata('error', 'Data Penyewaan tidak ditemukan.');
            return redirect()->to('data-penyewaan');
        }

        // Hapus entri data kamar dari basis data
        $model->where('id', $id)->delete();


        session()->setFlashdata('success', 'Data berhasil dihapus.');
        return redirect()->to('data-penyewaan');
    }

    public function setujuiPenyewaan($id)
    {
        helper('form');
        $model = model(PenyewaanModel::class);

        // Update data 
        $model->update($id, [
            'status' => 'Disetujui',
        ]);

        session()->setFlashdata('success', 'Data berhasil diupdate.');
        // Redirect atau tampilkan view setelah berhasil update
        return redirect()->to('/data-penyewaan')->with('success', 'Data penyewaan berhasil Disetujui');
    }
}
