<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\PenghuniModel;
use App\Models\RegistrasiModel;

// Add this line to import the class.
use CodeIgniter\Exceptions\PageNotFoundException;

class Users extends BaseController
{
    public function index()
    {
        $model = new RegistrasiModel();

        $data = [
            'user_list' => $model->findAll(),
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
            . view('admin/user/tambahUser')
            . view('templates/footer');
    }

    public function create()
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
            return $this->tambahUser();
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

        session()->setFlashdata('success', 'Data berhasil disimpan.');
        return redirect()->to('data-user');
    }


    public function detailUser($id)
    {
        helper('form');
        $model = model(RegistrasiModel::class);

        $data = [
            'user_list' => $model->where('id', $id)->findAll(),
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
        $data = $this->request->getPost(['id', 'nama', 'no_hp', 'email', 'password', 'status']);

        // Validasi data
        if (!$this->validateData($data, [
            'id' => 'required',
            'nama' => 'required',
            'no_hp' => 'required|max_length[255]|min_length[3]',
            'email' => 'required|max_length[255]|min_length[3]',
            'password' => 'required|max_length[255]|min_length[3]',
            'status' => 'required|max_length[255]|min_length[3]',
        ])) {
            // The validation fails, so returns the form.
            return $this->editUser();
        }

        // Dapatkan data yang divalidasi
        $validatedData = $this->validator->getValidated();

        // Cek apakah data dengan nomor_kamar tersebut ada
        $model = model(RegistrasiModel::class);

        // Update data kamar
        $model->update($validatedData['id'], [
            'nama' => $validatedData['nama'],
            'no_hp' => $validatedData['no_hp'],
            'email' => $validatedData['email'],
            'password' => $validatedData['password'],
            'status' => $validatedData['status'],
        ]);
        session()->setFlashdata('success', 'Data berhasil diupdate.');
        // Redirect atau tampilkan view setelah berhasil update
        return redirect()->to('data-user')->with('success', 'Data pengguna berhasil diupdate');
    }

    public function hapusUser($id)
    {
        $model = model(RegistrasiModel::class);

        // Ambil data kamar berdasarkan nomor kamar
        $user = $model->where('id', $id)->first();

        if (!$user) {
            session()->setFlashdata('error', 'Data User tidak ditemukan.');
            return redirect()->to('data-tagihan');
        }

        // Hapus entri data kamar dari basis data
        $model->where('id', $id)->delete();


        session()->setFlashdata('success', 'Data berhasil dihapus.');
        return redirect()->to('data-user');
    }
}
