<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdiModel extends Model
{
    protected $table = 't_prodi';
    protected $primaryKey = 'id_prodi';
    protected $allowedFields = ['kode_prodi', 'nama_prodi', 'id_jurusan'];
}
