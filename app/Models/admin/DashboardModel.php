<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class DashboardModel extends Model
{
    protected $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = db_connect();
    }

    public function getSummaryCards()
    {
        return [
            'total_mahasiswa'  => $this->db->table('t_mahasiswa')->countAllResults(),
            'total_dosen'      => $this->db->table('t_dosen')->countAllResults(),
            'total_matakuliah' => $this->db->table('t_matakuliah')->countAllResults(),
            'total_ruangan'    => $this->db->table('t_kelas')->countAllResults(),
            'total_jadwal'     => $this->db->table('jadwal_kuliah')->countAllResults(),
            'total_event'      => $this->db->table('kalender_akademik')->countAllResults(),
        ];
    }

    public function getActiveSemesterInfo()
    {
        return [
            'label_semester'  => 'Ganjil 2025/2026',
            'mahasiswa_aktif' => 0,
            'kelas_berjalan'  => 0,
            'ujian_mendatang' => 0,
        ];
    }

    public function getUpcomingExamCount()
    {
        return 0;
    }

    public function getRecentActivities()
    {
        return [];
    }
}
