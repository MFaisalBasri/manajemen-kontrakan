<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\PenghuniModel;
use App\Models\TagihanModel;
use App\Models\PembayaranModel;

// Add this line to import the class.
use CodeIgniter\Exceptions\PageNotFoundException;

class DashboardUser extends BaseController
{
    public function index()
    {
        $model = new UserModel();
        $modelTagihan = new TagihanModel();
        $modelPembayaran = new PembayaranModel();

        $session = session();
        $data = [
            'id' => $session->get('id'),
            'id_penghuni' => $session->get('id_penghuni'),
            'nama' => $session->get('nama'),
            'role' => $session->get('role'),
            'totalTagihan' => $modelTagihan->getCountTagihanByPenghuni($session->get('id_penghuni')),
            'totalPembayaran' => $modelPembayaran->getCountDataPembayaran($session->get('id_penghuni')),
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

    public function pembayaran($id)
    {
        helper('form');
        $model = new TagihanModel();

        $session = session();
        // Ambil id_penghuni dari session
        $id_penghuni = $session->get('id_penghuni');

        // Ambil data tagihan berdasarkan id_penghuni
        $data = [
            'tagihan_list' => $model->detailTagihan($id),
            'id_penghuni' => $id_penghuni,
            'title'     => 'Bayar Tagihan',
        ];

        return view('templates/header', $data)
            . view('user/templates/sidebar')
            . view('user/pembayaran')
            . view('templates/footer');
    }

    public function createPembayaran()
    {
        helper('form');

        $data = $this->request->getPost(['id_penghuni', 'id_tagihan', 'bukti']);

        // Checks whether the submitted data passed the validation rules.
        if (!$this->validateData($data, [
            'id_penghuni' => 'required|max_length[255]|min_length[1]',
            'id_tagihan' => 'required|max_length[255]|min_length[1]',
            'bukti' => 'uploaded[bukti]|max_size[bukti,1024]|is_image[bukti]',
        ])) {
            // The validation fails, so returns the form.
            return $this->createPembayaran();
        }

        // Gets the validated data.
        $post = $this->validator->getValidated();

        // Handle file upload
        $gambar = $this->request->getFile('bukti');
        $nama_file_asli = $gambar->getName();
        $nama_file_baru = uniqid() . '_' . $nama_file_asli;
        $gambar->move(ROOTPATH . 'public/uploads', $nama_file_baru);

        $model = model(PembayaranModel::class);
        $model->insert([
            'id_penghuni' => $post['id_penghuni'],
            'id_tagihan' => $post['id_tagihan'],
            'status_pembayaran' => 'Belum disetujui',
            'bukti_pembayaran' => $nama_file_baru,
        ]);


        session()->setFlashdata('success', 'Data berhasil disimpan.');
        return redirect()->to('tagihan-user');
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

    public function pembayaranUser()
    {

        $model = model(PembayaranModel::class);
        $session = session();
        $id = $session->get('id_penghuni');
        $data = [
            'pembayaran_list' =>  $model->getDataPembayaranByIdPenghuni($id),
            'title'     => 'Data Pembayaran',
        ];

        return view('templates/header', $data)
            . view('user/templates/sidebar')
            . view('user/dataPembayaran')
            . view('templates/footer');
    }

    public function hapusPembayaran($id)
    {
        helper('form');
        $model = model(PembayaranModel::class);

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
