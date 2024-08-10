<?php

namespace App\Models;

use CodeIgniter\Model;

class TagihanModel extends Model
{
    protected $table = 'tb_tagihan';
    protected $allowedFields = ['id_pemilik', 'id_penyewaan', 'bulan', 'status'];

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

    public function getTagihanByPemilik($id_pemilik)
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
            ->where('tb_tagihan.id_pemilik', $id_pemilik)
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
            ->where('tb_penghuni.id_pengguna', $id_penghuni)
            ->findAll();
    }

    public function getCountTagihanByPenghuni($id_penghuni, $status = 'belum lunas')
    {
        return $this->select('COUNT(*) as total_tagihan')
            ->join('tb_penyewaan', 'tb_tagihan.id_penyewaan = tb_penyewaan.id')
            ->join('tb_penghuni', 'tb_penyewaan.id_penghuni = tb_penghuni.id')
            ->where('tb_penghuni.id', $id_penghuni)
            ->where('tb_tagihan.status', $status)
            ->countAllResults();
    }


    public function detailTagihan($id_tagihan)
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
            ->where('tb_tagihan.id', $id_tagihan)
            ->findAll();
    }

    public function updateStatusLunas($id, $status)
    {
        $builder = $this->db->table($this->table);
        $builder->where('id', $id)
            ->update(['status' => $status]);
    }
}
