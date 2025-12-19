<?php

namespace App\Models\dosen;

use CodeIgniter\Model;

class JadwalKuliahModel extends Model
{
    protected $table = 'jadwal_kuliah';
    protected $primaryKey = 'id_jadwal';
    protected $allowedFields = [
        'id_mahasiswa',
        'id_mk',
        'id_dosen',
        'id_ruangan',
        'hari',
        'jam_mulai',
        'jam_selesai',
        'minggu_ke',
        'tahun_ajaran',
        'semester'
    ];
}
