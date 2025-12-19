<?php

namespace App\Models;

use CodeIgniter\Model;

class JurusanModel extends Model
{
    protected $table = 't_jurusan';
    protected $primaryKey = 'id_jurusan';
    protected $allowedFields = ['kode_jurusan', 'nama_jurusan'];
}
