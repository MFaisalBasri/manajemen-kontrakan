<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\PenghuniModel;
use App\Models\AdminModel;

// Add this line to import the class.
use CodeIgniter\Exceptions\PageNotFoundException;

class Admin extends BaseController
{
    public function index()
    {
        $model = new AdminModel();

        $data = [
            'admin_list' => $model->getAllAdmin(),
            'title'     => 'Data Admin',
        ];

        // Tampilkan view dengan data yang telah didapatkan
        return view('templates/header', $data)
            . view('templates/sidebar')
            . view('admin/admin/dataAdmin')
            . view('templates/footer');
    }

    public function tambahAdmin(): string
    {
        helper('form');
        $data = [
            'title' => 'Tambah Admin',
        ];
        return view('templates/header', $data)
            . view('templates/sidebar')
            . view('admin/admin/tambahAdmin')
            . view('templates/footer');
    }

    public function create()
    {
        helper('form');

        $data = $this->request->getPost(['nama', 'password', 'role']);

        // Checks whether the submitted data passed the validation rules.
        if (!$this->validateData($data, [
            'nama' => 'required|max_length[255]|min_length[3]',
            'password'  =>  'max_length[255]|min_length[3]',
            'role' => 'max_length[255]|min_length[3]',
        ])) {
            // The validation fails, so returns the form.
            return $this->tambahAdmin();
        }

        // Gets the validated data.
        $post = $this->validator->getValidated();

        $model = model(AdminModel::class);
        $model->insert([
            'nama' => $post['nama'],
            'password'  => $post['password'],
            'role'  => $post['role'],
        ]);

        session()->setFlashdata('success', 'Data berhasil disimpan.');
        return redirect()->to('data-admin');
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
