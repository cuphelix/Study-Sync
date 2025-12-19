<?php

namespace App\Models\admin;

use CodeIgniter\Model;

class JadwalModel extends Model
{
    protected $table = 'jadwal_kuliah';
    protected $primaryKey = 'id_jadwal';
    protected $allowedFields = [
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

    // ambil data lengkap: join matakuliah, dosen, kelas/ruangan
    public function withRelations()
    {
        return $this->select('jadwal_kuliah.*, t_matakuliah.kode_matakuliah, t_matakuliah.nama_matakuliah, t_dosen.nama_dosen, t_kelas.kode_kelas, t_gedung.nama_gedung, t_kelas.lantai')
            ->join('t_matakuliah', 't_matakuliah.id_matakuliah = jadwal_kuliah.id_mk', 'left')
            ->join('t_dosen', 't_dosen.id_dosen = jadwal_kuliah.id_dosen', 'left')
            ->join('t_kelas', 't_kelas.id_kelas = jadwal_kuliah.id_ruangan', 'left')
            ->join('t_gedung', 't_gedung.id_gedung = t_kelas.id_gedung', 'left');
    }

    // pencarian: kode/nama mk, dosen, kode kelas
    public function search($keyword)
    {
        if (!$keyword) return $this->withRelations();

        $k = trim($keyword);
        return $this->withRelations()
            ->groupStart()
            ->like('t_matakuliah.kode_matakuliah', $k)
            ->orLike('t_matakuliah.nama_matakuliah', $k)
            ->orLike('t_dosen.nama_dosen', $k)
            ->orLike('t_kelas.kode_kelas', $k)
            ->groupEnd();
    }
}
