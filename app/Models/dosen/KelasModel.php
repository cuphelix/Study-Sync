<?php

namespace App\Models\dosen;

use CodeIgniter\Model;

class KelasModel extends Model
{
    protected $table = 't_kelas';
    protected $primaryKey = 'id_kelas';
    protected $allowedFields = ['kode_kelas', 'lantai', 'id_gedung'];
}
