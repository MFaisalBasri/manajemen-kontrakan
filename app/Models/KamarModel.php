<?php

namespace App\Models;

use CodeIgniter\Model;

class KamarModel extends Model
{
    protected $table = 'tb_kamar';
    // protected $primaryKey = 'nomor_kamar';
    protected $allowedFields = ['id_pemilik', 'kode_kamar', 'nomor_kamar', 'nama_kamar', 'alamat', 'fasilitas', 'luas', 'harga', 'status', 'kontak', 'gambar'];

    public function getKamar()
    {
        return $this->findAll();
    }

    public function getKontrakanPemilik($id_pemilik)
    {
        // Menggunakan query builder untuk memfilter data berdasarkan id_pemilik
        return $this->where('id_pemilik', $id_pemilik)->findAll();
    }

    public function totalKontrakan($id_pemilik)
    {
        // Menggunakan query builder untuk memfilter data berdasarkan id_pemilik
        return $this->where('id_pemilik', $id_pemilik)->countAllResults();
    }


    public function updateStatus($idKamar, $status)
    {
        $builder = $this->db->table($this->table);
        $builder->where('id', $idKamar)
            ->update(['status' => $status]);
    }

    public function getTotalKamar()
    {
        return count($this->findAll());
    }
}
