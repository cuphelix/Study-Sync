<?php

namespace App\Models\dosen;

use CodeIgniter\Model;

class MahasiswaModel extends Model
{
    protected $table = 't_mahasiswa';
    protected $primaryKey = 'id_mahasiswa';
    protected $allowedFields = [
        'nim',
        'nama_mahasiswa',
        'email',
        'password',
        'tahun_masuk',
        'semester',
        'id_prodi'
    ];
}
