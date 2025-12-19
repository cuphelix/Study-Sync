<?php

namespace App\Models\dosen;

use CodeIgniter\Model;

class PengingatModel extends Model
{
    protected $table = 'pengingat';
    protected $primaryKey = 'id_pengingat';
    protected $allowedFields = [
        'id_user',
        'judul',
        'deskripsi',
        'tanggal',
        'waktu',
        'id_kalender',
        'aktif',
        'prioritas'
    ];

    public function getByDosen($id_dosen)
    {
        return $this->where('id_user', $id_dosen)
            ->where('aktif', 1)
            ->orderBy('tanggal', 'ASC')
            ->orderBy('waktu', 'ASC')
            ->findAll();
    }
    
    public function getByPrioritas($id_dosen, $prioritas = 'Tinggi')
    {
        return $this->where('id_user', $id_dosen)
            ->where('aktif', 1)
            ->where('prioritas', $prioritas)
            ->orderBy('tanggal', 'ASC')
            ->orderBy('waktu', 'ASC')
            ->findAll();
    }
    
    public function getUpcoming($id_dosen, $limit = 5)
    {
        return $this->where('id_user', $id_dosen)
            ->where('aktif', 1)
            ->where('tanggal >=', date('Y-m-d'))
            ->orderBy('tanggal', 'ASC')
            ->orderBy('waktu', 'ASC')
            ->limit($limit)
            ->findAll();
    }
}
