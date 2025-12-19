<?php

namespace App\Models\dosen;

use CodeIgniter\Model;

class DosenModel extends Model
{
    protected $table      = 't_dosen';
    protected $primaryKey = 'id_dosen';
    protected $allowedFields = ['nama_dosen', 'nip', 'email', 'no_wa', 'id_prodi'];
}
