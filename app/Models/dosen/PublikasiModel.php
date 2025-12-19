<?php

namespace App\Models\dosen;

use CodeIgniter\Model;

class PublikasiModel extends Model
{
    protected $table = 't_publikasi';
    protected $primaryKey = 'id_publikasi';
    protected $allowedFields = [
        'id_dosen',
        'judul',
        'jenis',
        'penerbit',
        'tahun',
        'link',
        'deskripsi'
    ];
    
    public function getByDosen($id_dosen)
    {
        return $this->where('id_dosen', $id_dosen)
            ->orderBy('tahun', 'DESC')
            ->orderBy('id_publikasi', 'DESC')
            ->findAll();
    }
    
    public function getByJenis($id_dosen, $jenis)
    {
        return $this->where('id_dosen', $id_dosen)
            ->where('jenis', $jenis)
            ->orderBy('tahun', 'DESC')
            ->findAll();
    }
}

