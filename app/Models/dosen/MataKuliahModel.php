<?php

namespace App\Models\dosen;

use CodeIgniter\Model;

class MatakuliahModel extends Model
{
    protected $table      = 't_matakuliah';
    protected $primaryKey = 'id_matakuliah';
    protected $allowedFields = [
        'kode_matakuliah',
        'nama_matakuliah',
        'semester',
        'sks',
        'id_dosen',
        'id_prodi',
        'id_kelas',
        'jenis'
    ];
}
