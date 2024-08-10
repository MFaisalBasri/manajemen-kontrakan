<?php

namespace App\Models;

use CodeIgniter\Model;

class RegistrasiModel extends Model
{
    protected $table = 'tb_registrasi';
    protected $allowedFields = ['nama', 'no_hp', 'email', 'password', 'status'];
}
