<?php

namespace App\Models;

use CodeIgniter\Model;

class PenghuniModel extends Model
{
    protected $table = 'tb_penghuni';
    protected $allowedFields = ['nik', 'nama', 'tgl_lahir', 'no_hp', 'pekerjaan', 'tujuan'];

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

    public function getTotalPenghuni()
    {
        return count($this->findAll());
    }

    public function getAvailableTenants()
    {
        return $this->select('tb_penghuni.id, nama')
            ->join('tb_penyewaan', 'tb_penghuni.id = tb_penyewaan.id_penghuni', 'left')
            ->where('tb_penyewaan.id_penghuni IS NULL', null, false)
            ->findAll();
    }
}
