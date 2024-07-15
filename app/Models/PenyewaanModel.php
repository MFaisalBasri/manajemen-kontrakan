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
    public function getAvailableRooms()
    {
        $db = \Config\Database::connect();

        // Query to get rooms that are not in tb_penyewaan or have status other than "Digunakan"
        $query = $db->table('tb_kamar')
            ->select('tb_kamar.id, tb_kamar.nomor_kamar')
            ->join('tb_penyewaan', 'tb_kamar.id = tb_penyewaan.id_kamar', 'left')
            ->where('tb_penyewaan.id_kamar IS NULL')
            ->orWhere('tb_kamar.status !=', 'Digunakan')
            ->groupBy('tb_kamar.id'); // Group by to ensure distinct rooms

        return $query->get()->getResultArray();
    }
}
