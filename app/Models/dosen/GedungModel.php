<?php

namespace App\Models\dosen;

use CodeIgniter\Model;

class GedungModel extends Model
{
    protected $table = 't_gedung';
    protected $primaryKey = 'id_gedung';
    protected $allowedFields = ['nama_gedung'];
}
