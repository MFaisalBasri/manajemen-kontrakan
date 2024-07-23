<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\PenghuniModel;

// Add this line to import the class.
use CodeIgniter\Exceptions\PageNotFoundException;

class Users extends BaseController
{
    public function index()
    {
        $model = new UserModel();

        $data = [
            'user_list' => $model->getUser(),
            'title'     => 'Data User',
        ];

        // Tampilkan view dengan data yang telah didapatkan
        return view('templates/header', $data)
            . view('templates/sidebar')
            . view('admin/user/dataUser')
            . view('templates/footer');
    }

    public function tambahUser(): string
    {
        helper('form');
        $model = new UserModel();
        $penghuni = new PenghuniModel();
        $data = [
            'user_list' => $model->getUser(),
            'penghuni_list' => $penghuni->getPenghuni(),
            'title'     => 'Tambah User',
        ];
        return view('templates/header', $data)
            . view('templates/sidebar')
            . view('user/tambahUser')
            . view('templates/footer');
    }


    public function detailUser($id)
    {
        $model = model(UserModel::class);

        $data = [
            'user_list' => $model->getDetailUser($id),
            'title'     => 'Data User',
        ];

        return view('templates/header', $data)
            . view('templates/sidebar')
            . view('admin/user/editUser')
            . view('templates/footer');
    }

    public function editUser()
    {
        helper('form');

        // Ambil data dari POST termasuk nomor_kamar
        $data = $this->request->getPost(['id', 'nama', 'password', 'role']);

        // Validasi data
        if (!$this->validateData($data, [
            'id' => 'required|min_length[1]',
            'nama' => 'required',
            'password' => 'required|max_length[255]|min_length[3]',
            'role' => 'required|max_length[255]|min_length[3]',
        ])) {
            // The validation fails, so returns the form.
            return $this->editUser();
        }

        // Dapatkan data yang divalidasi
        $validatedData = $this->validator->getValidated();

        // Cek apakah data dengan nomor_kamar tersebut ada
        $model = model(UserModel::class);

        // Update data kamar
        $model->update($validatedData['id'], [
            'password' => $validatedData['password'],
            'role' => $validatedData['role'],
        ]);
        session()->setFlashdata('success', 'Data berhasil diupdate.');
        // Redirect atau tampilkan view setelah berhasil update
        return redirect()->to('data-user')->with('success', 'Data kamar berhasil diupdate');
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
