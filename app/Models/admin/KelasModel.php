<?php

namespace App\Models\admin;

use CodeIgniter\Model;

class KelasModel extends Model
{
    protected $table      = 't_kelas';
    protected $primaryKey = 'id_kelas';
    protected $allowedFields = ['kode_kelas', 'lantai', 'id_gedung'];

    public function withGedung()
    {
        return $this->select('t_kelas.*, t_gedung.nama_gedung, t_gedung.kode_gedung')
            ->join('t_gedung', 't_gedung.id_gedung = t_kelas.id_gedung', 'left');
    }

    public function search($keyword)
    {
        if (!$keyword) return $this;

        return $this->groupStart()
            ->like('t_kelas.kode_kelas', $keyword)
            ->orLike('t_gedung.nama_gedung', $keyword)
            ->orLike('t_gedung.kode_gedung', $keyword)
            ->groupEnd();
    }

    public function findWithGedung($id)
    {
        return $this->withGedung()
            ->where('t_kelas.id_kelas', $id)
            ->first();
    }
}
