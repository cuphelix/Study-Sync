<?php

namespace App\Models\dosen;

use CodeIgniter\Model;

class KelasMahasiswaModel extends Model
{
    protected $table = 't_kelas_mahasiswa';
    protected $primaryKey = 'id_kelas_mahasiswa';
    protected $allowedFields = [
        'id_mahasiswa',
        'id_kelas',
        'id_matakuliah',
        'semester',
        'tahun_ajaran',
        'status'
    ];
    
    public function getMahasiswaByKelas($id_kelas)
    {
        return $this->select('
                t_kelas_mahasiswa.*,
                t_mahasiswa.nim,
                t_mahasiswa.nama_mahasiswa,
                t_mahasiswa.email,
                t_matakuliah.nama_matakuliah
            ')
            ->join('t_mahasiswa', 't_mahasiswa.id_mahasiswa = t_kelas_mahasiswa.id_mahasiswa', 'left')
            ->join('t_matakuliah', 't_matakuliah.id_matakuliah = t_kelas_mahasiswa.id_matakuliah', 'left')
            ->where('t_kelas_mahasiswa.id_kelas', $id_kelas)
            ->where('t_kelas_mahasiswa.status', 'Aktif')
            ->findAll();
    }
    
    public function getMahasiswaByMatakuliah($id_matakuliah, $semester = null, $tahun_ajaran = null)
    {
        $builder = $this->select('
                t_kelas_mahasiswa.*,
                t_mahasiswa.nim,
                t_mahasiswa.nama_mahasiswa,
                t_mahasiswa.email,
                t_kelas.kode_kelas
            ')
            ->join('t_mahasiswa', 't_mahasiswa.id_mahasiswa = t_kelas_mahasiswa.id_mahasiswa', 'left')
            ->join('t_kelas', 't_kelas.id_kelas = t_kelas_mahasiswa.id_kelas', 'left')
            ->where('t_kelas_mahasiswa.id_matakuliah', $id_matakuliah)
            ->where('t_kelas_mahasiswa.status', 'Aktif');
        
        if ($semester) {
            $builder->where('t_kelas_mahasiswa.semester', $semester);
        }
        
        if ($tahun_ajaran) {
            $builder->where('t_kelas_mahasiswa.tahun_ajaran', $tahun_ajaran);
        }
        
        return $builder->orderBy('t_mahasiswa.nama_mahasiswa', 'ASC')
            ->findAll();
    }
    
    public function getKelasByMahasiswa($id_mahasiswa)
    {
        return $this->select('
                t_kelas_mahasiswa.*,
                t_matakuliah.kode_matakuliah,
                t_matakuliah.nama_matakuliah,
                t_kelas.kode_kelas
            ')
            ->join('t_matakuliah', 't_matakuliah.id_matakuliah = t_kelas_mahasiswa.id_matakuliah', 'left')
            ->join('t_kelas', 't_kelas.id_kelas = t_kelas_mahasiswa.id_kelas', 'left')
            ->where('t_kelas_mahasiswa.id_mahasiswa', $id_mahasiswa)
            ->where('t_kelas_mahasiswa.status', 'Aktif')
            ->findAll();
    }
    
    public function countMahasiswaByMatakuliah($id_matakuliah)
    {
        return $this->where('id_matakuliah', $id_matakuliah)
            ->where('status', 'Aktif')
            ->countAllResults();
    }
}

