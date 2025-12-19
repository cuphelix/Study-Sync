<?php

namespace App\Models;

use CodeIgniter\Model;

class JadwalKuliahModel extends Model
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

    public function getJadwalHariIni($hari)
    {
        return $this->select('
                jadwal_kuliah.*,
                t_matakuliah.kode_matakuliah,
                t_matakuliah.nama_matakuliah,
                t_dosen.nama_dosen,
                t_kelas.kode_kelas
            ')
            ->join('t_matakuliah', 't_matakuliah.id_matakuliah = jadwal_kuliah.id_mk', 'left')
            ->join('t_dosen', 't_dosen.id_dosen = jadwal_kuliah.id_dosen', 'left')
            ->join('t_kelas', 't_kelas.id_kelas = jadwal_kuliah.id_ruangan', 'left')
            ->where('jadwal_kuliah.hari', $hari)
            ->orderBy('jadwal_kuliah.jam_mulai', 'ASC')
            ->findAll();
    }

    public function getJadwalWithDetails()
    {
        return $this->select('
                jadwal_kuliah.*,
                t_matakuliah.kode_matakuliah,
                t_matakuliah.nama_matakuliah as nama_mk,
                t_dosen.nama_dosen,
                t_kelas.kode_kelas as nama_ruangan
            ')
            ->join('t_matakuliah', 't_matakuliah.id_matakuliah = jadwal_kuliah.id_mk', 'left')
            ->join('t_dosen', 't_dosen.id_dosen = jadwal_kuliah.id_dosen', 'left')
            ->join('t_kelas', 't_kelas.id_kelas = jadwal_kuliah.id_ruangan', 'left')
            ->orderBy("FIELD(jadwal_kuliah.hari, 'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu')", '', false)
            ->orderBy('jadwal_kuliah.jam_mulai', 'ASC')
            ->findAll();
    }
}
