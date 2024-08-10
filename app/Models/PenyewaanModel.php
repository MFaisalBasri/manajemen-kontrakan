<?php

namespace App\Models;

use CodeIgniter\Model;

class PenyewaanModel extends Model
{
    protected $table = 'tb_penyewaan';
    protected $allowedFields = ['id_penghuni', 'id_kamar', 'id_pemilik', 'tanggal_penyewaan', 'status_pembayaraan', 'status'];

    public function getPenyewaanAdmin()
    {
        return $this->select('tb_penyewaan.id, tb_penyewaan.tanggal_penyewaan, tb_penyewaan.id_kamar, tb_penyewaan.status, tb_penghuni.nama, tb_penghuni.nik, tb_penghuni.tgl_lahir, tb_penghuni.no_hp, tb_penghuni.pekerjaan, tb_penghuni.tujuan, tb_kamar.nomor_kamar, tb_kamar.harga')
            ->join('tb_penghuni', 'tb_penghuni.id = tb_penyewaan.id_penghuni')
            ->join('tb_kamar', 'tb_kamar.id = tb_penyewaan.id_kamar') // Bergabung dengan tb_kamar berdasarkan id_kamar
            ->findAll(); // Mengambil semua data tanpa filter

    }

    public function getPenyewaan($id_pemilik)
    {
        return $this->select('tb_penyewaan.id, tb_penyewaan.tanggal_penyewaan, tb_penyewaan.id_kamar,tb_penyewaan.status, tb_penghuni.nama, tb_penghuni.nik, tb_penghuni.tgl_lahir, tb_penghuni.no_hp, tb_penghuni.pekerjaan, tb_penghuni.tujuan, tb_kamar.nomor_kamar, tb_kamar.harga')
            ->join('tb_penghuni', 'tb_penghuni.id = tb_penyewaan.id_penghuni')
            ->join('tb_kamar', 'tb_kamar.id = tb_penyewaan.id_kamar') // Bergabung dengan tb_kamar berdasarkan id_kamar
            ->where('tb_penyewaan.id_pemilik', $id_pemilik) // Filter berdasarkan id_pemilik
            ->findAll();
    }

    public function getPenyewaanTagihan($id_pemilik)
    {
        return $this->select('tb_penyewaan.id, tb_penyewaan.tanggal_penyewaan, tb_penyewaan.id_kamar,tb_penyewaan.status, tb_penghuni.nama, tb_kamar.nomor_kamar, tb_kamar.harga')
            ->join('tb_penghuni', 'tb_penghuni.id = tb_penyewaan.id_penghuni')
            ->join('tb_kamar', 'tb_kamar.id = tb_penyewaan.id_kamar') // Bergabung dengan tb_kamar berdasarkan id_kamar
            ->where('tb_penyewaan.id_pemilik', $id_pemilik) // Filter berdasarkan id_pemilik
            ->findAll();
    }

    public function totalPenyewaan($id_pemilik)
    {
        // Menggunakan query builder untuk memfilter data berdasarkan id_pemilik
        return $this->where('id_pemilik', $id_pemilik)->countAllResults();
    }


    public function getDetailPenyewaan($id)
    {
        return $this->select('tb_penyewaan.id, tb_penyewaan.tanggal_penyewaan, tb_penyewaan.id_kamar, tb_penghuni.nama, tb_kamar.nomor_kamar, tb_kamar.harga')
            ->join('tb_penghuni', 'tb_penghuni.id = tb_penyewaan.id_penghuni')
            ->join('tb_kamar', 'tb_kamar.id = tb_penyewaan.id_kamar')
            ->where('tb_penyewaan.id', $id)
            ->first();
    }

    public function getDetailKamar($id)
    {
        return $this->select('tb_penyewaan.id, tb_penyewaan.tanggal_penyewaan, tb_penyewaan.id_kamar, tb_penghuni.nama, tb_kamar.*')
            ->join('tb_penghuni', 'tb_penghuni.id = tb_penyewaan.id_penghuni')
            ->join('tb_kamar', 'tb_kamar.id = tb_penyewaan.id_kamar')
            ->where('tb_penyewaan.id_penghuni', $id)
            ->findAll();
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

    public function getTotalPenyewaan()
    {
        return count($this->findAll());
    }
}
