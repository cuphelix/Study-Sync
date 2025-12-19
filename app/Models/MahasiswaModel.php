<?php

namespace App\Models;

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

    public function getMahasiswaDetail($id_mahasiswa)
    {
        return $this->select('
                t_mahasiswa.*,
                t_prodi.nama_prodi,
                t_prodi.kode_prodi,
                t_jurusan.nama_jurusan
            ')
            ->join('t_prodi', 't_prodi.id_prodi = t_mahasiswa.id_prodi', 'left')
            ->join('t_jurusan', 't_jurusan.id_jurusan = t_prodi.id_jurusan', 'left')
            ->where('t_mahasiswa.id_mahasiswa', $id_mahasiswa)
            ->first();
    }

    public function getMahasiswaByNim($nim)
    {
        return $this->where('nim', $nim)->first();
    }
}
