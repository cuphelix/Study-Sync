<?php

namespace App\Models\dosen;

use CodeIgniter\Model;

class MahasiswaModel extends Model
{
    protected $table = 't_mahasiswa';
    protected $primaryKey = 'id_mahasiswa';
    protected $allowedFields = ['nama', 'id_prodi'];
}
