<?php

namespace App\Models;

use CodeIgniter\Model;

class PembayaranModel extends Model
{
    protected $table = 'tb_pembayaran';
    protected $allowedFields = ['id_tagihan', 'bukti_pembayaran'];

    public function getPembayaran()
    {
        return $this->findAll();
    }
}
