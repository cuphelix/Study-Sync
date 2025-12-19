<?php

namespace App\Models\dosen;

use CodeIgniter\Model;

class PengingatModel extends Model
{
    protected $table = 'pengingat';

    public function getByDosen($id_dosen)
    {
        return $this->where('id_dosen', $id_dosen)
            ->orderBy('tanggal', 'ASC')
            ->findAll();
    }
}
