<?php

namespace App\Models;

use CodeIgniter\Model;

class KamarModel extends Model
{
    protected $table = 'tb_kamar';
    // protected $primaryKey = 'nomor_kamar';
    protected $allowedFields = ['kode_kamar', 'nomor_kamar', 'nama_kamar', 'alamat', 'fasilitas', 'harga', 'status', 'gambar'];

    public function getKamar()
    {
        return $this->findAll();
    }

    public function updateStatus($idKamar, $status)
    {
        $builder = $this->db->table($this->table);
        $builder->where('id', $idKamar)
            ->update(['status' => $status]);
    }
}
