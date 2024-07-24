<?php

namespace App\Controllers;

use App\Models\PenghuniModel;
use App\Models\UserModel;

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

    public function tambahPenghuni(): string
    {
        helper('form');
        $data = [
            'title'     => 'Tambah Data Penghuni',
        ];

        return view('templates/header', $data)
            . view('templates/sidebar')
            . view('admin/penghuni/tambahPenghuni')
            . view('templates/footer');
    }

    public function create()
    {
        helper('form');

        $data = $this->request->getPost(['nama', 'tanggal_lahir', 'pekerjaan']);

        // Checks whether the submitted data passed the validation rules.
        if (!$this->validateData($data, [
            'nama' => 'required|max_length[255]|min_length[3]',
            'tanggal_lahir'  =>  'max_length[255]|min_length[3]',
            'pekerjaan' => 'max_length[255]|min_length[3]',
        ])) {
            // The validation fails, so returns the form.
            return $this->tambahPenghuni();
        }

        // Gets the validated data.
        $post = $this->validator->getValidated();

        $model = model(PenghuniModel::class);
        $model->insert([
            'nama' => $post['nama'],
            'tgl_lahir'  => $post['tanggal_lahir'],
            'pekerjaan'  => $post['pekerjaan'],
        ]);

        // Get the last inserted ID from tb_penghuni
        $lastInsertId = $model->insertID();

        $modelUser = model(UserModel::class);

        $modelUser->insert([
            'id_penghuni' => $lastInsertId,
            'password' => 'admin',
            'role'  => 'user',
        ]);

        session()->setFlashdata('success', 'Data berhasil disimpan.');
        return redirect()->to('tambah-penyewaan');
    }

    public function detailPenghuni($id)
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
        $data = $this->request->getPost(['id', 'nama', 'tanggal_lahir', 'pekerjaan']);

        // Validasi data
        if (!$this->validateData($data, [
            'id' => 'required|min_length[1]',
            'nama' => 'required|max_length[255]|min_length[3]',
            'tanggal_lahir' => 'required|max_length[255]|min_length[3]',
            'pekerjaan' => 'required|max_length[255]|min_length[3]',
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
            'nama' => $validatedData['nama'],
            'tgl_lahir' => $validatedData['tanggal_lahir'],
            'pekerjaan' => $validatedData['pekerjaan'],
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
        return redirect()->to('data-penghuni');
    }
}
