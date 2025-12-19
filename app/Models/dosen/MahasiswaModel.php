<?php

namespace App\Models\dosen;

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
        'id_prodi',
        'status'
    ];
    
    public function getMahasiswaWithProdi($idDosen = null)
    {
        $builder = $this->db->table('t_mahasiswa tm')
            ->select('tm.*, tp.nama_prodi')
            ->join('t_prodi tp', 'tp.id_prodi = tm.id_prodi', 'left');
        
        if ($idDosen) {
            $builder->join('t_matakuliah tmk', 'tmk.id_prodi = tp.id_prodi', 'left')
                ->where('tmk.id_dosen', $idDosen)
                ->groupBy('tm.id_mahasiswa');
        }
        
        return $builder->orderBy('tm.nama_mahasiswa', 'ASC')
            ->get()->getResultArray();
    }
    
    public function getMahasiswaAktif($idDosen = null)
    {
        $builder = $this->where('status', 'Aktif');
        
        if ($idDosen) {
            return $this->getMahasiswaWithProdi($idDosen);
        }
        
        return $builder->findAll();
    }
}
