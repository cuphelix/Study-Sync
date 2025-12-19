<?php

namespace App\Models\dosen;

use CodeIgniter\Model;

class DosenModel extends Model
{
    protected $table      = 't_dosen';
    protected $primaryKey = 'id_dosen';
    protected $allowedFields = [
        'nama_dosen',
        'nip',
        'nidn',
        'email',
        'password',
        'no_wa',
        'id_prodi',
        'jabatan_fungsional',
        'pendidikan_terakhir',
        'bidang_keahlian',
        'jam_kantor',
        'tanggal_mulai',
        'foto'
    ];
}
