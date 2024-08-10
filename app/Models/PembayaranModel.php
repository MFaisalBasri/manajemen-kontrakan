<?php

namespace App\Models;

use CodeIgniter\Model;

class PembayaranModel extends Model
{
    protected $table = 'tb_pembayaran';
    protected $allowedFields = ['tanggal_pembayaran', 'id_penghuni', 'id_tagihan', 'bayar', 'bulan', 'bukti_pembayaran', 'status_pembayaran'];

    public function getPembayaran()
    {
        return $this->findAll();
    }

    public function getDataPembayaran($id_pemilik)
    {
        return $this
            ->select('tb_pembayaran.*, 
                  tb_penyewaan.id AS id_penyewaan, 
                  tb_penyewaan.tanggal_penyewaan, 
                  tb_penyewaan.id_kamar, 
                  tb_penghuni.nama AS nama_penghuni, 
                  tb_kamar.nomor_kamar, 
                  tb_kamar.harga')
            ->join('tb_tagihan', 'tb_pembayaran.id_tagihan = tb_tagihan.id')
            ->join('tb_penyewaan', 'tb_tagihan.id_penyewaan = tb_penyewaan.id')
            ->join('tb_penghuni', 'tb_penyewaan.id_penghuni = tb_penghuni.id')
            ->join('tb_kamar', 'tb_penyewaan.id_kamar = tb_kamar.id')
            ->where('tb_tagihan.id_pemilik', $id_pemilik)
            ->findAll();
    }

    public function getLaporan()
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
            ->where('tb_pembayaran.status_pembayaran', 'disetujui') // Menambahkan kondisi untuk status pembayaran disetujui
            ->findAll();
    }

    public function getLaporanPemilik($id_pemilik)
    {
        return $this
            ->select('tb_pembayaran.*, 
                  tb_penyewaan.id AS id_penyewaan, 
                  tb_penyewaan.tanggal_penyewaan, 
                  tb_penyewaan.id_kamar, 
                  tb_penghuni.nama AS nama_penghuni, 
                  tb_kamar.nomor_kamar, 
                  tb_kamar.harga')
            ->join('tb_tagihan', 'tb_pembayaran.id_tagihan = tb_tagihan.id')
            ->join('tb_penyewaan', 'tb_tagihan.id_penyewaan = tb_penyewaan.id')
            ->join('tb_penghuni', 'tb_penyewaan.id_penghuni = tb_penghuni.id')
            ->join('tb_kamar', 'tb_penyewaan.id_kamar = tb_kamar.id')
            ->where('tb_tagihan.id_pemilik', $id_pemilik) // Filter berdasarkan id_pemilik
            ->where('tb_pembayaran.status_pembayaran', 'disetujui') // Filter status pembayaran
            ->findAll();
    }

    public function countLaporanPemilik($id_pemilik)
    {
        return $this
            ->join('tb_tagihan', 'tb_pembayaran.id_tagihan = tb_tagihan.id')
            ->join('tb_penyewaan', 'tb_tagihan.id_penyewaan = tb_penyewaan.id')
            ->join('tb_penghuni', 'tb_penyewaan.id_penghuni = tb_penghuni.id')
            ->join('tb_kamar', 'tb_penyewaan.id_kamar = tb_kamar.id')
            ->where('tb_tagihan.id_pemilik', $id_pemilik) // Filter berdasarkan id_pemilik
            ->where('tb_pembayaran.status_pembayaran', 'disetujui') // Filter status pembayaran
            ->countAllResults(); // Menghitung jumlah hasil
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
            ->where('tb_penghuni.id_pengguna', $id_penghuni)
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
