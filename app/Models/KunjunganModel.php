<?php

namespace App\Models;

use CodeIgniter\Model;

class KunjunganModel extends Model
{
    protected $table = 'tb_jadwal';
    // protected $primaryKey = 'nomor_kamar';
    protected $allowedFields = ['id_pemilik', 'nama_kontrakan', 'waktu', 'nama', 'no_hp'];

    public function getKunjungan()
    {
        return $this->findAll();
    }

    public function getKunjunganPemilik($id_pemilik)
    {
        // Menggunakan query builder untuk memfilter data berdasarkan id_pemilik
        return $this->where('id_pemilik', $id_pemilik)->findAll();
    }
}
