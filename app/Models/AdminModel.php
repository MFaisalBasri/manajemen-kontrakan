<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table = 'tb_admin'; // Nama tabel dalam database
    protected $allowedFields = ['nama', 'password', 'role'];


    public function getAllAdmin()
    {
        return $this->findAll(); // Mengambil semua data admin dari tabel
    }

    public function getTotalAdmin()
    {
        return count($this->findAll());
    }
}
