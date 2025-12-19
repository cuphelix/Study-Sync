<?php

namespace App\Models\admin;

use CodeIgniter\Model;

class SemesterAktifModel extends Model
{
    protected $table = 't_semester_aktif';
    protected $primaryKey = 'id_semester_aktif';
    protected $allowedFields = [
        'semester',
        'tahun_ajaran',
        'tanggal_mulai',
        'tanggal_selesai',
        'status'
    ];
    
    public function getActiveSemester()
    {
        return $this->where('status', 'Aktif')->first();
    }
    
    public function setActiveSemester($id)
    {
        // Set semua menjadi non-aktif dulu
        $this->set('status', 'Non-aktif')->update();
        // Set yang dipilih menjadi aktif
        return $this->update($id, ['status' => 'Aktif']);
    }
}

