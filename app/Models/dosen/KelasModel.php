<?php

namespace App\Models\dosen;

use CodeIgniter\Model;

class KelasModel extends Model
{
    protected $table = 't_kelas';
    protected $primaryKey = 'id_kelas';
    protected $allowedFields = ['nama_kelas', 'id_gedung'];
}
