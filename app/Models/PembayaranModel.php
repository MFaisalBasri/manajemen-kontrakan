<?php

namespace App\Models;

use CodeIgniter\Model;

class PembayaranModel extends Model
{
    protected $table = 'tb_pembayaran';
    protected $allowedFields = ['id_penghuni', 'id_tagihan', 'bayar', 'bukti_pembayaran', 'status_pembayaran'];

    public function getPembayaran()
    {
        return $this->findAll();
    }

    public function getDataPembayaran()
    {
        return $this
            ->select('tb_pembayaran.*,
                  tb_penyewaan.id as id_penyewaan, 
                  tb_penyewaan.tanggal_penyewaan, 
                  tb_penyewaan.id_kamar, 
                  tb_penghuni.nama as nama_penghuni, 
                  tb_kamar.nomor_kamar, 
                  tb_kamar.harga')
            ->join('tb_tagihan', 'tb_pembayaran.id_tagihan = tb_tagihan.id')
            ->join('tb_penyewaan', 'tb_tagihan.id_penyewaan = tb_penyewaan.id')
            ->join('tb_penghuni', 'tb_penyewaan.id_penghuni = tb_penghuni.id')
            ->join('tb_kamar', 'tb_penyewaan.id_kamar = tb_kamar.id')
            ->findAll();
    }

    public function getDataPembayaranByIdPenghuni($id_penghuni)
    {
        return $this
            ->select('tb_pembayaran.*,
              tb_tagihan.bulan, 
              tb_penyewaan.id as id_penyewaan, 
              tb_penyewaan.tanggal_penyewaan, 
              tb_penyewaan.id_kamar, 
              tb_penghuni.nama as nama_penghuni, 
              tb_kamar.nomor_kamar, 
              tb_kamar.harga')
            ->join('tb_tagihan', 'tb_pembayaran.id_tagihan = tb_tagihan.id')
            ->join('tb_penyewaan', 'tb_tagihan.id_penyewaan = tb_penyewaan.id')
            ->join('tb_penghuni', 'tb_penyewaan.id_penghuni = tb_penghuni.id')
            ->join('tb_kamar', 'tb_penyewaan.id_kamar = tb_kamar.id')
            ->where('tb_penghuni.id', $id_penghuni)
            ->findAll();
    }

    public function getCountDataPembayaran($id_penghuni)
    {
        return $this
            ->select('COUNT(*) as total_pembayaran')
            ->join('tb_tagihan', 'tb_pembayaran.id_tagihan = tb_tagihan.id')
            ->join('tb_penyewaan', 'tb_tagihan.id_penyewaan = tb_penyewaan.id')
            ->join('tb_penghuni', 'tb_penyewaan.id_penghuni = tb_penghuni.id')
            ->join('tb_kamar', 'tb_penyewaan.id_kamar = tb_kamar.id')
            ->where('tb_penghuni.id', $id_penghuni)
            ->countAllResults();
    }
}
