<?php

namespace App\Models;

use CodeIgniter\Model;

class KalenderAkademikModel extends Model
{
    protected $table = 'kalender_akademik';
    protected $primaryKey = 'id_kalender';
    protected $allowedFields = [
        'nama_kegiatan',
        'tanggal_mulai',
        'tanggal_selesai',
        'deskripsi',
        'tipe_event',
        'semester'
    ];
}
