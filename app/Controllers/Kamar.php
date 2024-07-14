<?php

namespace App\Controllers;

use App\Models\KamarModel;

class Kamar extends BaseController
{
    public function index(): string
    {

        $model = model(KamarModel::class);

        $data = [
            'kamar_list' => $model->getKamar(),
            'title'     => 'Data Kamar',
        ];

        return view('templates/header', $data)
            . view('templates/sidebar')
            . view('admin/kamar/dataKamar')
            . view('templates/footer');
    }

    public function tambahKamar(): string
    {
        helper('form');
        $data = [
            'title'     => 'Tambah Kamar',
        ];

        return view('templates/header', $data)
            . view('templates/sidebar')
            . view('admin/kamar/tambahKamar')
            . view('templates/footer');
    }


    public function create()
    {
        helper('form');

        $data = $this->request->getPost(['kode_kamar', 'nomor_kamar', 'nama_kamar', 'alamat', 'fasilitas', 'harga', 'status', 'gambar']);

        // Checks whether the submitted data passed the validation rules.
        if (!$this->validateData($data, [
            'kode_kamar' => 'required|max_length[255]|min_length[3]',
            'nomor_kamar' => 'required|max_length[255]|min_length[3]',
            'nama_kamar' => 'required|max_length[255]|min_length[3]',
            'alamat' => 'required|max_length[255]|min_length[3]',
            'fasilitas'  =>  'max_length[255]|min_length[3]',
            'harga' => 'integer',
            'status' => 'max_length[255]|min_length[3]',
            'gambar' => 'uploaded[gambar]|max_size[gambar,1024]|is_image[gambar]',
        ])) {
            // The validation fails, so returns the form.
            return $this->tambahKamar();
        }

        // Gets the validated data.
        $post = $this->validator->getValidated();

        // Handle file upload
        $gambar = $this->request->getFile('gambar');
        $nama_file_asli = $gambar->getName();
        $nama_file_baru = uniqid() . '_' . $nama_file_asli;
        $gambar->move(ROOTPATH . 'public/uploads', $nama_file_baru);

        $model = model(KamarModel::class);

        if ($model->where('nomor_kamar', $post['nomor_kamar'])->first()) {
            // Nomor kamar sudah ada, beri pemberitahuan dan kembalikan ke form
            session()->setFlashdata('error', 'Nomor kamar sudah ada.');
            return redirect()->to('tambah-kamar')->withInput();
        }
        $model->insert([
            'kode_kamar' => $post['kode_kamar'],
            'nomor_kamar' => $post['nomor_kamar'],
            'nama_kamar' => $post['nama_kamar'],
            'alamat'  => $post['alamat'],
            'fasilitas'  => $post['fasilitas'],
            'harga'  => $post['harga'],
            'status'  => $post['status'],
            'gambar' => $nama_file_baru,
        ]);


        session()->setFlashdata('success', 'Data berhasil disimpan.');
        return redirect()->to('data-kamar');
    }

    public function hapusKamar($id)
    {
        $model = model(KamarModel::class);

        // Ambil data kamar berdasarkan nomor kamar
        $kamar = $model->where('id', $id)->first();

        if (!$kamar) {
            session()->setFlashdata('error', 'Data kamar tidak ditemukan.');
            return redirect()->to('data-kamar');
        }

        // Ambil nama file gambar dari data kamar
        $nama_file_gambar = $kamar['gambar'];

        // Hapus entri data kamar dari basis data
        $model->where('id', $id)->delete();

        // Hapus file gambar dari direktori uploads jika ada
        if (!empty($nama_file_gambar)) {
            $path_file_gambar = ROOTPATH . 'public/uploads/' . $nama_file_gambar;

            if (file_exists($path_file_gambar)) {
                unlink($path_file_gambar);
            }
        }

        session()->setFlashdata('success', 'Data berhasil dihapus.');
        return redirect()->to('data-kamar');
    }

    public function detailKamar($id)
    {
        $model = model(KamarModel::class);

        $data = [
            'kamar_list' => $model->where('id', $id)->findAll(),
            'title'     => 'Data Kamar',
        ];

        return view('templates/header', $data)
            . view('templates/sidebar')
            . view('admin/kamar/editKamar')
            . view('templates/footer');
    }

    public function editKamar()
    {
        helper('form');

        // Ambil data dari POST termasuk nomor_kamar
        $data = $this->request->getPost(['id', 'kode_kamar', 'nomor_kamar', 'nama_kamar', 'alamat', 'fasilitas', 'harga', 'status']);

        // Validasi data
        if (!$this->validateData($data, [
            'id' => 'required|min_length[1]',
            'kode_kamar' => 'required|max_length[255]|min_length[3]',
            'nomor_kamar' => 'required|max_length[255]|min_length[3]',
            'nama_kamar' => 'required|max_length[255]|min_length[3]',
            'alamat'  => 'max_length[255]|min_length[2]',
            'fasilitas'  => 'max_length[255]|min_length[2]',
            'harga' => 'integer',
            'status' => 'max_length[255]|min_length[3]',
            // 'gambar' => 'uploaded[gambar]|max_size[gambar,1024]|is_image[gambar]',
        ])) {
            // The validation fails, so returns the form.
            return $this->editKamar();
        }

        // Dapatkan data yang divalidasi
        $validatedData = $this->validator->getValidated();

        // Handle file upload
        // $gambar = $this->request->getFile('gambar');
        // $nama_file_asli = $gambar->getName();
        // $nama_file_baru = uniqid() . '_' . $nama_file_asli;
        // $gambar->move(ROOTPATH . 'public/uploads', $nama_file_baru);

        // Cek apakah data dengan nomor_kamar tersebut ada
        $model = model(KamarModel::class);
        $existingData = $model->where('id', $validatedData['id'])->first();

        if (!$existingData) {
            return redirect()->back()->with('error', 'Data kamar tidak ditemukan.'); // Tambahkan pesan error yang sesuai
        }

        // Update data kamar
        $model->update($existingData['id'], [
            'nama_kamar' => $validatedData['nama_kamar'],
            'alamat' => $validatedData['alamat'],
            'fasilitas' => $validatedData['fasilitas'],
            'harga' => $validatedData['harga'],
            'status' => $validatedData['status'],
            // 'gambar' => $nama_file_baru,
        ]);
        session()->setFlashdata('success', 'Data berhasil diupdate.');
        // Redirect atau tampilkan view setelah berhasil update
        return redirect()->to('/data-kamar')->with('success', 'Data kamar berhasil diupdate');
    }
}
