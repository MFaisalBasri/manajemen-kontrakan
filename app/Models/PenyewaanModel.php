<?php

namespace App\Models;

use CodeIgniter\Model;

class PenyewaanModel extends Model
{
    protected $table = 'tb_penyewaan';
    protected $allowedFields = ['id_penghuni', 'id_kamar', 'tanggal_penyewaan', 'status_pembayaraan'];

    public function getPenyewaan()
    {
        return $this->select('tb_penyewaan.id, tb_penyewaan.tanggal_penyewaan, tb_penyewaan.id_kamar,tb_penyewaan.status_pembayaran, tb_penghuni.nama, tb_kamar.nomor_kamar, tb_kamar.harga')
            ->join('tb_penghuni', 'tb_penghuni.id = tb_penyewaan.id_penghuni')
            ->join('tb_kamar', 'tb_kamar.id = tb_penyewaan.id_kamar')
            ->findAll();
    }

    public function getDetailPenyewaan($id)
    {
        return $this->select('tb_penyewaan.id, tb_penyewaan.tanggal_penyewaan, tb_penyewaan.id_kamar, tb_penyewaan.status_pembayaran, tb_penghuni.nama, tb_kamar.nomor_kamar, tb_kamar.harga')
            ->join('tb_penghuni', 'tb_penghuni.id = tb_penyewaan.id_penghuni')
            ->join('tb_kamar', 'tb_kamar.id = tb_penyewaan.id_kamar')
            ->where('tb_penyewaan.id', $id)
            ->first();
    }
}
