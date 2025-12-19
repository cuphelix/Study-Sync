<?php

namespace App\Models;

use CodeIgniter\Model;

class JadwalPenggantiModel extends Model
{
    protected $table = 'jadwal_pengganti';
    protected $primaryKey = 'id_pengganti';
    protected $allowedFields = [
        'id_jadwal',
        'tanggal_pengganti',
        'jam_mulai',
        'jam_selesai',
        'alasan',
        'status',
        'disetujui_oleh'
    ];

    public function getPenggantiByJadwal($id_jadwal)
    {
        return $this->where('id_jadwal', $id_jadwal)
            ->orderBy('tanggal_pengganti', 'ASC')
            ->findAll();
    }

    public function getPenggantiByStatus($status)
    {
        return $this->select('
                jadwal_pengganti.*,
                jadwal_kuliah.hari,
                jadwal_kuliah.jam_mulai as jam_mulai_awal,
                jadwal_kuliah.jam_selesai as jam_selesai_awal,
                t_matakuliah.nama_matakuliah,
                t_dosen.nama_dosen,
                t_kelas.kode_kelas
            ')
            ->join('jadwal_kuliah', 'jadwal_kuliah.id_jadwal = jadwal_pengganti.id_jadwal', 'left')
            ->join('t_matakuliah', 't_matakuliah.id_matakuliah = jadwal_kuliah.id_mk', 'left')
            ->join('t_dosen', 't_dosen.id_dosen = jadwal_kuliah.id_dosen', 'left')
            ->join('t_kelas', 't_kelas.id_kelas = jadwal_kuliah.id_ruangan', 'left')
            ->where('jadwal_pengganti.status', $status)
            ->orderBy('jadwal_pengganti.tanggal_pengganti', 'ASC')
            ->findAll();
    }

    public function getPenggantiByDosen($id_dosen)
    {
        return $this->select('
                jadwal_pengganti.*,
                jadwal_kuliah.hari,
                t_matakuliah.nama_matakuliah,
                t_kelas.kode_kelas
            ')
            ->join('jadwal_kuliah', 'jadwal_kuliah.id_jadwal = jadwal_pengganti.id_jadwal', 'left')
            ->join('t_matakuliah', 't_matakuliah.id_matakuliah = jadwal_kuliah.id_mk', 'left')
            ->join('t_kelas', 't_kelas.id_kelas = jadwal_kuliah.id_ruangan', 'left')
            ->where('jadwal_kuliah.id_dosen', $id_dosen)
            ->orderBy('jadwal_pengganti.tanggal_pengganti', 'ASC')
            ->findAll();
    }
}

