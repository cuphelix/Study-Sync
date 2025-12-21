<?php

namespace App\Models;

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

    public function getJadwalHariIni($hari, $id_mahasiswa = null)
    {
        $query = $this->select('
                jadwal_kuliah.*,
                t_matakuliah.kode_matakuliah,
                t_matakuliah.nama_matakuliah,
                t_dosen.nama_dosen,
                t_kelas.kode_kelas
            ')
            ->join('t_matakuliah', 't_matakuliah.id_matakuliah = jadwal_kuliah.id_mk', 'left')
            ->join('t_dosen', 't_dosen.id_dosen = jadwal_kuliah.id_dosen', 'left')
            ->join('t_kelas', 't_kelas.id_kelas = jadwal_kuliah.id_ruangan', 'left')
            ->where('jadwal_kuliah.hari', $hari);
        
        if ($id_mahasiswa !== null) {
            // PERBAIKAN: Filter berdasarkan mata kuliah yang diikuti mahasiswa
            $query->join('t_kelas_mahasiswa', 
                't_kelas_mahasiswa.id_matakuliah = jadwal_kuliah.id_mk AND t_kelas_mahasiswa.id_mahasiswa = ' . $id_mahasiswa, 
                'inner')
                ->where('t_kelas_mahasiswa.status', 'Aktif');
        }
        
        return $query->orderBy('jadwal_kuliah.jam_mulai', 'ASC')
            ->findAll();
    }

    public function getJadwalWithDetails($id_mahasiswa = null)
    {
        // PERBAIKAN: Query dengan filter berdasarkan t_kelas_mahasiswa
        $query = $this->select('
                jadwal_kuliah.id_jadwal,
                jadwal_kuliah.id_mahasiswa,
                jadwal_kuliah.id_mk,
                jadwal_kuliah.id_dosen,
                jadwal_kuliah.id_ruangan,
                jadwal_kuliah.hari,
                jadwal_kuliah.jam_mulai,
                jadwal_kuliah.jam_selesai,
                jadwal_kuliah.minggu_ke,
                jadwal_kuliah.tahun_ajaran,
                jadwal_kuliah.semester,
                t_matakuliah.kode_matakuliah,
                t_matakuliah.nama_matakuliah as nama_mk,
                t_dosen.nama_dosen,
                t_kelas.kode_kelas as nama_ruangan
            ')
            ->join('t_matakuliah', 't_matakuliah.id_matakuliah = jadwal_kuliah.id_mk', 'left')
            ->join('t_dosen', 't_dosen.id_dosen = jadwal_kuliah.id_dosen', 'left')
            ->join('t_kelas', 't_kelas.id_kelas = jadwal_kuliah.id_ruangan', 'left');
        
        if ($id_mahasiswa !== null) {
            // PERBAIKAN: Filter berdasarkan mata kuliah yang diikuti mahasiswa
            // BUKAN berdasarkan id_mahasiswa di tabel jadwal_kuliah
            $query->join('t_kelas_mahasiswa', 
                't_kelas_mahasiswa.id_matakuliah = jadwal_kuliah.id_mk AND t_kelas_mahasiswa.id_mahasiswa = ' . $id_mahasiswa, 
                'inner')
                ->where('t_kelas_mahasiswa.status', 'Aktif');
        }
        
        // Pastikan tidak ada duplikasi dengan GROUP BY
        $query->groupBy('jadwal_kuliah.id_jadwal');
        
        return $query->orderBy("FIELD(jadwal_kuliah.hari, 'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu')", '', false)
            ->orderBy('jadwal_kuliah.jam_mulai', 'ASC')
            ->findAll();
    }
}