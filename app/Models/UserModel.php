<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'tb_user';
    protected $allowedFields = ['id_penghuni', 'password', 'role'];

    public function getUser()
    {
        return $this->join('tb_penghuni', 'tb_user.id_penghuni = tb_penghuni.id')
            ->select('tb_user.*, tb_penghuni.nama')
            ->findAll();
    }

    public function getUserWithNama()
    {
        return $this->join('tb_penghuni', 'tb_user.id_penghuni = tb_penghuni.id')
            ->select('tb_user.*, tb_penghuni.nama')
            ->findAll();
    }

    public function getDetailUser($userId)
    {
        // Ambil detail user berdasarkan $userId
        return $this->join('tb_penghuni', 'tb_user.id_penghuni = tb_penghuni.id')
            ->where('tb_user.id', $userId)
            ->select('tb_user.*, tb_penghuni.nama')
            ->first();
    }
}
