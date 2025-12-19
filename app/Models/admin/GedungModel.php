<?php
// app/Models/GedungModel.php
namespace App\Models\admin;

use CodeIgniter\Model;

class GedungModel extends Model
{
    protected $table      = 't_gedung';
    protected $primaryKey = 'id_gedung';
    protected $allowedFields = ['kode_gedung', 'nama_gedung'];
}
