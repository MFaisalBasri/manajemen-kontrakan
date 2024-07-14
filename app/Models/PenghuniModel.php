<?php

namespace App\Models;

use CodeIgniter\Model;

class PenghuniModel extends Model
{
    protected $table = 'tb_penghuni';
    protected $allowedFields = ['nama', 'tgl_lahir', 'pekerjaan'];

    public function getPenghuni()
    {
        return $this->findAll();
    }

    public function getPenghuniWithPenyewaan()
    {
        return $this->join('tb_penyewaan', 'tb_penyewaan.id_penghuni = tb_penghuni.id')
            ->join('tb_kamar', 'tb_kamar.id = tb_penyewaan.id_kamar')
            ->select('tb_penghuni.*, tb_kamar.nomor_kamar')
            ->findAll();
    }
}
