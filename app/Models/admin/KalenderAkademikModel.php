<?php

namespace App\Models\admin;

use CodeIgniter\Model;

class KalenderAkademikModel extends Model
{
    protected $table      = 'kalender_akademik';
    protected $primaryKey = 'id_kalender';

    protected $allowedFields = [
        'nama_kegiatan',
        'tanggal_mulai',
        'tanggal_selesai',
        'deskripsi',
        'tipe_event',   // baru
        'semester',     // baru
    ];

    /**
     * Ambil semua event yang jatuh di bulan & tahun tertentu
     * (event yang melintasi beberapa hari juga ikut).
     */
    public function getEventsByMonth(int $year, int $month): array
    {
        $start = "$year-" . sprintf('%02d', $month) . "-01";
        $end   = date('Y-m-t', strtotime($start)); // last day of month

        return $this->where('tanggal_mulai <=', $end)
            ->where('tanggal_selesai >=', $start)
            ->orderBy('tanggal_mulai', 'ASC')
            ->findAll();
    }

    /**
     * Upcoming events (panel kanan).
     */
    public function getUpcomingEvents(int $limit = 5): array
    {
        $today = date('Y-m-d');

        return $this->where('tanggal_mulai >=', $today)
            ->orderBy('tanggal_mulai', 'ASC')
            ->limit($limit)
            ->findAll();
    }
}
