<?php

namespace App\Models;

use CodeIgniter\Model;

class TagihanModel extends Model
{
    protected $table = 'tb_tagihan';
    protected $allowedFields = ['id_penyewaan', 'bulan', 'status'];

    public function getTagihan()
    {
        return $this->select('tb_tagihan.*, 
        tb_penyewaan.id as id_penyewaan, 
        tb_penyewaan.tanggal_penyewaan, 
        tb_penyewaan.id_kamar, 
        tb_penghuni.nama as nama_penghuni, 
        tb_kamar.nomor_kamar, 
        tb_kamar.harga')
            ->join('tb_penyewaan', 'tb_tagihan.id_penyewaan = tb_penyewaan.id')
            ->join('tb_penghuni', 'tb_penyewaan.id_penghuni = tb_penghuni.id')
            ->join('tb_kamar', 'tb_penyewaan.id_kamar = tb_kamar.id')
            ->findAll();
    }

    public function getTagihanByPenghuni($id_penghuni)
    {
        return $this->select('tb_tagihan.*, 
            tb_penyewaan.id as id_penyewaan, 
            tb_penyewaan.tanggal_penyewaan, 
            tb_penyewaan.id_kamar, 
            tb_penghuni.nama as nama_penghuni, 
            tb_kamar.nomor_kamar, 
            tb_kamar.harga')
            ->join('tb_penyewaan', 'tb_tagihan.id_penyewaan = tb_penyewaan.id')
            ->join('tb_penghuni', 'tb_penyewaan.id_penghuni = tb_penghuni.id')
            ->join('tb_kamar', 'tb_penyewaan.id_kamar = tb_kamar.id')
            ->where('tb_penghuni.id', $id_penghuni)
            ->findAll();
    }
}
