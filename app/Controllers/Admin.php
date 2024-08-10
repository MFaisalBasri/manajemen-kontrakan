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

    public function setting()
    {
        helper('form');
        $model = new AdminModel();
        $session = session();
        $data = [
            'id' => $session->get('id'),
            'id_penghuni' => $session->get('id_penghuni'),
            'nama' => $session->get('nama'),
            'password' => $session->get('password'),
            'role' => $session->get('role'),
            'admin' => $model->where('id', $session->get('id'))->first(),
            'title' => 'Akun Saya',
        ];


        // Tampilkan view dengan data yang telah didapatkan
        return view('templates/header', $data)
            . view('templates/sidebar')
            . view('admin/admin/setting')
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


    public function detailAdmin($id)
    {
        helper('form');
        $model = model(AdminModel::class);

        $data = [
            'admin_list' => $model->where('id', $id)->findAll(),
            'title'     => 'Data Admin',
        ];

        return view('templates/header', $data)
            . view('templates/sidebar')
            . view('admin/admin/editAdmin')
            . view('templates/footer');
    }

    public function editAdmin()
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
            return $this->editAdmin();
        }

        // Dapatkan data yang divalidasi
        $validatedData = $this->validator->getValidated();

        // Cek apakah data dengan nomor_kamar tersebut ada
        $model = model(AdminModel::class);

        // Update data kamar
        $model->update($validatedData['id'], [
            'nama' => $validatedData['nama'],
            'password' => $validatedData['password'],
            'role' => $validatedData['role'],
        ]);
        session()->setFlashdata('success', 'Data berhasil diupdate.');
        // Redirect atau tampilkan view setelah berhasil update
        return redirect()->to('data-admin')->with('success', 'Data Admin berhasil diupdate');
    }

    public function ubahPasswordAdmin()
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
            return $this->setting();
        }

        // Dapatkan data yang divalidasi
        $validatedData = $this->validator->getValidated();

        // Cek apakah data dengan nomor_kamar tersebut ada
        $model = model(AdminModel::class);

        // Update data User
        $model->update($validatedData['id'], [
            'password' => $validatedData['password'],
        ]);
        session()->setFlashdata('success', 'Password berhasil diupdate.');
        // Redirect atau tampilkan view setelah berhasil update
        return redirect()->to('/setting-admin')->with('success', 'Password berhasil diupdate');
    }

    public function hapus($id)
    {
        $model = model(AdminModel::class);

        // Ambil data kamar berdasarkan nomor kamar
        $admin = $model->where('id', $id)->first();

        if (!$admin) {
            session()->setFlashdata('error', 'Data Admin tidak ditemukan.');
            return redirect()->to('data-admin');
        }

        // Hapus entri data kamar dari basis data
        $model->where('id', $id)->delete();


        session()->setFlashdata('success', 'Data berhasil dihapus.');
        return redirect()->to('data-admin');
    }
}
