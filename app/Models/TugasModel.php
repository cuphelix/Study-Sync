<?php

namespace App\Models;

use CodeIgniter\Model;

class TugasModel extends Model
{
    protected $table = 'tugas';
    protected $primaryKey = 'id_tugas';
    protected $allowedFields = [
        'id_mk',
        'id_kelas',
        'judul_tugas',
        'deskripsi',
        'tanggal_diberikan',
        'deadline',
        'tipe_tugas'
    ];

    public function getTugasByMahasiswa($id_mahasiswa)
    {
        return $this->select('
                tugas.*,
                t_matakuliah.kode_matakuliah,
                t_matakuliah.nama_matakuliah,
                t_kelas.kode_kelas
            ')
            ->join('t_matakuliah', 't_matakuliah.id_matakuliah = tugas.id_mk', 'left')
            ->join('t_kelas', 't_kelas.id_kelas = tugas.id_kelas', 'left')
            ->join('jadwal_kuliah', 'jadwal_kuliah.id_mk = tugas.id_mk', 'left')
            ->where('jadwal_kuliah.id_mahasiswa', $id_mahasiswa)
            ->orderBy('tugas.deadline', 'ASC')
            ->findAll();
    }

    public function getTugasByDosen($id_dosen)
    {
        return $this->select('
                tugas.*,
                t_matakuliah.kode_matakuliah,
                t_matakuliah.nama_matakuliah,
                t_kelas.kode_kelas
            ')
            ->join('t_matakuliah', 't_matakuliah.id_matakuliah = tugas.id_mk', 'left')
            ->join('t_kelas', 't_kelas.id_kelas = tugas.id_kelas', 'left')
            ->where('t_matakuliah.id_dosen', $id_dosen)
            ->orderBy('tugas.deadline', 'ASC')
            ->findAll();
    }

    public function getTugasMendekatiDeadline($id_mahasiswa, $days = 7)
    {
        $deadline = date('Y-m-d H:i:s', strtotime("+{$days} days"));
        return $this->getTugasByMahasiswa($id_mahasiswa)
            ->where('tugas.deadline <=', $deadline)
            ->where('tugas.deadline >=', date('Y-m-d H:i:s'))
            ->findAll();
    }
}

