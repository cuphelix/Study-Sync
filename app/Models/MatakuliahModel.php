<?php

namespace App\Models;

use CodeIgniter\Model;

class MatakuliahModel extends Model
{
    protected $table = 't_matakuliah';
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

    public function getMatakuliahByMahasiswa($id_mahasiswa)
    {
        return $this->select('
                t_matakuliah.*,
                t_dosen.nama_dosen,
                t_kelas.kode_kelas
            ')
            ->join('t_dosen', 't_dosen.id_dosen = t_matakuliah.id_dosen', 'left')
            ->join('t_kelas', 't_kelas.id_kelas = t_matakuliah.id_kelas', 'left')
            ->join('t_mahasiswa', 't_mahasiswa.id_prodi = t_matakuliah.id_prodi', 'left')
            ->where('t_mahasiswa.id_mahasiswa', $id_mahasiswa)
            ->findAll();
    }

    public function getMatakuliahDetailWithJadwal($id_matakuliah)
    {
        $matakuliah = $this->select('
                t_matakuliah.*,
                t_dosen.nama_dosen,
                t_dosen.nip,
                t_dosen.email,
                t_dosen.no_wa,
                t_kelas.kode_kelas,
                t_gedung.nama_gedung,
                t_kelas.lantai,
                t_prodi.nama_prodi
            ')
            ->join('t_dosen', 't_dosen.id_dosen = t_matakuliah.id_dosen', 'left')
            ->join('t_kelas', 't_kelas.id_kelas = t_matakuliah.id_kelas', 'left')
            ->join('t_gedung', 't_gedung.id_gedung = t_kelas.id_gedung', 'left')
            ->join('t_prodi', 't_prodi.id_prodi = t_matakuliah.id_prodi', 'left')
            ->where('t_matakuliah.id_matakuliah', $id_matakuliah)
            ->first();

        if ($matakuliah) {
            // Ambil jadwal kuliah
            $jadwalModel = new \App\Models\JadwalKuliahModel();
            $matakuliah['jadwal'] = $jadwalModel->where('id_mk', $id_matakuliah)->first();
        }

        return $matakuliah;
    }
}
