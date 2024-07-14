<?php

namespace App\Models;

use CodeIgniter\Model;

class TagihanModel extends Model
{
    protected $table = 'tb_tagihan';
    protected $allowedFields = ['id_penyewaan', 'bulan', 'status'];

    public function getTagihan()
    {
        return $this->findAll();
    }
}
