<?php

namespace App\Models\Admin;  // ✅ UBAH INI - karena file ada di folder admin/

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table      = 't_admin';
    protected $primaryKey = 'id_admin';

    protected $allowedFields = [
        'nama_admin',
        'email',
        'password',
        'no_wa',
        'id_prodi',
    ];
}
