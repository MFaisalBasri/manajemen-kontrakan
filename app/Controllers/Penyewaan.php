<?php

namespace App\Controllers;

use App\Models\PenyewaanModel;
use App\Models\KamarModel;
use App\Models\PenghuniModel;

// Add this line to import the class.
use CodeIgniter\Exceptions\PageNotFoundException;

class Penyewaan extends BaseController
{
    public function index()
    {
        $model = new PenyewaanModel();

        $data = [
            'penyewaan_list' => $model->getPenyewaan(),
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
        // $model = new PenyewaanModel();
        // $modelKamar = new KamarModel();
        // $modelPenghuni = new PenghuniModel();
        // $data = [
        //     'penyewaan_list' => $model->getPenyewaan(),
        //     'kamar_list' => $modelKamar->getKamar(),
        //     'penghuni_list' => $modelPenghuni->getPenghuni(),
        //     'title'     => 'Tambah Penyewaan',
        // ];
        // return view('templates/header', $data)
        //     . view('templates/sidebar')
        //     . view('admin/penyewaan/tambahPenyewaan')
        //     . view('templates/footer');

        $modelPenyewaan = new PenyewaanModel();
        $modelPenghuni = new PenghuniModel();

        $data = [
            'penghuni_list' => $modelPenghuni->findAll(),
            'kamar_list' => $modelPenyewaan->getAvailableRooms(),
            'title' => 'Tambah Penyewaan',
        ];

        return view('templates/header', $data)
            . view('templates/sidebar')
            . view('admin/penyewaan/tambahPenyewaan')
            . view('templates/footer');
    }

    public function create()
    {
        helper('form');

        $data = $this->request->getPost(['nama_penghuni', 'nomor_kamar', 'tanggal_penyewaan', 'status']);

        // Checks whether the submitted data passed the validation rules.
        if (!$this->validateData($data, [
            'nama_penghuni' => 'required|max_length[255]|min_length[1]',
            'nomor_kamar' => 'required|max_length[255]|min_length[1]',
            'tanggal_penyewaan' => 'max_length[255]',
            'status' => 'max_length[255]',
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
            'tanggal_penyewaan' => $post['tanggal_penyewaan'],
            'status_pembayaran'  => $post['status'],
        ]);

        $modelKamar = new KamarModel();
        $modelKamar->updateStatus($post['nomor_kamar'], 'Digunakan');

        session()->setFlashdata('success', 'Data berhasil disimpan.');
        return redirect()->to('data-penyewaan');
    }


    public function detailPenyewaan($id)
    {
        $model = model(PenyewaanModel::class);

        $data = [
            'penyewaan_item' => $model->getDetailPenyewaan($id),
            'title'     => 'Data Penyewaan',
        ];

        return view('templates/header', $data)
            . view('templates/sidebar')
            . view('admin/penyewaan/editPenyewaan')
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
}
