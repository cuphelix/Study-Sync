<?php

namespace App\Models\admin;

use CodeIgniter\Model;

class MatakuliahModel extends Model
{
    protected $table      = 't_matakuliah';
    protected $primaryKey = 'id_matakuliah';

    protected $allowedFields = [
        'kode_matakuliah',
        'nama_matakuliah',
        'sks',
        'id_prodi',
        'id_dosen',
        'id_kelas',
        'jenis'
    ];

    // Join ke prodi
    public function getAll($keyword = null)
    {
        $builder = $this->select('t_matakuliah.*, t_prodi.nama_prodi')
            ->join('t_prodi', 't_prodi.id_prodi = t_matakuliah.id_prodi', 'left');

        if ($keyword) {
            $builder->groupStart()
                ->like('kode_matakuliah', $keyword)
                ->orLike('nama_matakuliah', $keyword)
                ->orLike('t_prodi.nama_prodi', $keyword)
                ->groupEnd();
        }

        return $builder->orderBy('kode_matakuliah', 'ASC')->findAll();
    }

    public function countWajib()
    {
        return $this->where('jenis', 'Wajib')->countAllResults();
    }

    public function totalSKS()
    {
        return $this->selectSum('sks')->get()->getRow()->sks ?? 0;
    }
}
