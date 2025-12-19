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
        'aktif'
    ];

    public function getByDosen($id_dosen)
    {
        return $this->where('id_user', $id_dosen)
            ->where('aktif', 1)
            ->orderBy('tanggal', 'ASC')
            ->orderBy('waktu', 'ASC')
            ->findAll();
    }
}
