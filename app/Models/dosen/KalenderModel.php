<?php

namespace App\Models\dosen;

use CodeIgniter\Model;

class KalenderModel extends Model
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

    public function getEventsByMonth($year, $month)
    {
        $start = "$year-" . sprintf('%02d', $month) . "-01";
        $end = date('Y-m-t', strtotime($start));

        return $this->where('tanggal_mulai <=', $end)
            ->where('tanggal_selesai >=', $start)
            ->orderBy('tanggal_mulai', 'ASC')
            ->findAll();
    }

    public function getUpcomingEvents($limit = 5)
    {
        $today = date('Y-m-d');
        return $this->where('tanggal_mulai >=', $today)
            ->orderBy('tanggal_mulai', 'ASC')
            ->limit($limit)
            ->findAll();
    }
}

