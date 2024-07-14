<?php

namespace App\Models;

use CodeIgniter\Model;

class FasilitasModel extends Model
{
    protected $table = 'tb_fasilitas';
    // protected $allowedFields = ['nomor_kamar'];

    public function getFasilitas()
    {
        return $this->findAll();
    }
}
