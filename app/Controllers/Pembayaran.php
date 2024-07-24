<?php

namespace App\Controllers;

use App\Models\PembayaranModel;

class Pembayaran extends BaseController
{
    public function index(): string
    {

        $model = model(PembayaranModel::class);

        $data = [
            'pembayaran_list' => $model->getDataPembayaran(),
            'title'     => 'Data Pembayaran',
        ];

        return view('templates/header', $data)
            . view('templates/sidebar')
            . view('admin/pembayaran/dataPembayaran')
            . view('templates/footer');
    }

    public function tambahPembayaran(): string
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

        $data = $this->request->getPost(['id_tagihan', 'bukti']);

        // Checks whether the submitted data passed the validation rules.
        if (!$this->validateData($data, [
            'id_tagihan' => 'required|max_length[255]|min_length[1]',
            'bukti' => 'uploaded[bukti]|max_size[bukti,1024]|is_image[bukti]',
        ])) {
            // The validation fails, so returns the form.
            return $this->tambahPembayaran();
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
            'id_tagihan' => $post['id_tagihan'],
            'status_pembayaran' => 'Belum disetujui',
            'bukti_pembayaran' => $nama_file_baru,
        ]);


        session()->setFlashdata('success', 'Data berhasil disimpan.');
        return redirect()->to('tagihan-user');
    }

    public function lihatBukti($id)
    {
        $model = model(PembayaranModel::class);

        $data = [
            'pembayaran_list' => $model->where('id', $id)->findAll(),
            'title'     => 'Bukti Pembayaran',
        ];

        return view('templates/header', $data)
            . view('templates/sidebar')
            . view('admin/pembayaran/bukti')
            . view('templates/footer');
    }

    public function setujuiPembayaran($id)
    {
        helper('form');

        // Cek apakah data dengan nomor_kamar tersebut ada
        $model = model(PembayaranModel::class);

        // Update data kamar
        $model->update($id, [
            'status_pembayaran' => 'disetujui',
        ]);
        session()->setFlashdata('success', 'Data berhasil diupdate.');
        // Redirect atau tampilkan view setelah berhasil update
        return redirect()->to('/data-pembayaran')->with('success', 'Data pembayaran berhasil diupdate');
    }

    public function tolakPembayaran($id)
    {
        helper('form');

        // Cek apakah data dengan nomor_kamar tersebut ada
        $model = model(PembayaranModel::class);

        // Update data kamar
        $model->update($id, [
            'status_pembayaran' => 'ditolak',
        ]);
        session()->setFlashdata('success', 'Data berhasil diupdate.');
        // Redirect atau tampilkan view setelah berhasil update
        return redirect()->to('/data-pembayaran')->with('success', 'Data pembayaran berhasil diupdate');
    }
}
