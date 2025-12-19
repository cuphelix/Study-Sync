<?php

namespace App\Models\dosen;

use CodeIgniter\Model;

class NilaiModel extends Model
{
    protected $table = 't_nilai';
    protected $primaryKey = 'id_nilai';
    protected $allowedFields = [
        'id_mahasiswa',
        'id_matakuliah',
        'id_dosen',
        'nilai',
        'grade',
        'semester',
        'tahun_ajaran',
        'keterangan'
    ];
    
    public function getNilaiByMahasiswa($id_mahasiswa)
    {
        return $this->select('
                t_nilai.*,
                t_matakuliah.kode_matakuliah,
                t_matakuliah.nama_matakuliah,
                t_matakuliah.sks,
                t_dosen.nama_dosen
            ')
            ->join('t_matakuliah', 't_matakuliah.id_matakuliah = t_nilai.id_matakuliah', 'left')
            ->join('t_dosen', 't_dosen.id_dosen = t_nilai.id_dosen', 'left')
            ->where('t_nilai.id_mahasiswa', $id_mahasiswa)
            ->orderBy('t_nilai.semester', 'DESC')
            ->orderBy('t_nilai.tahun_ajaran', 'DESC')
            ->findAll();
    }
    
    public function getNilaiByDosen($id_dosen)
    {
        return $this->select('
                t_nilai.*,
                t_mahasiswa.nim,
                t_mahasiswa.nama_mahasiswa,
                t_matakuliah.kode_matakuliah,
                t_matakuliah.nama_matakuliah
            ')
            ->join('t_mahasiswa', 't_mahasiswa.id_mahasiswa = t_nilai.id_mahasiswa', 'left')
            ->join('t_matakuliah', 't_matakuliah.id_matakuliah = t_nilai.id_matakuliah', 'left')
            ->where('t_nilai.id_dosen', $id_dosen)
            ->orderBy('t_nilai.semester', 'DESC')
            ->orderBy('t_nilai.tahun_ajaran', 'DESC')
            ->findAll();
    }
    
    public function getIPK($id_mahasiswa)
    {
        $result = $this->select('AVG(nilai) as ipk')
            ->where('id_mahasiswa', $id_mahasiswa)
            ->first();
        return $result ? (float)$result['ipk'] : 0.00;
    }
    
    public function getRataRataIPK()
    {
        $result = $this->select('AVG(nilai) as avg_ipk')->first();
        return $result ? (float)$result['avg_ipk'] : 0.00;
    }
}

