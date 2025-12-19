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
        $semesterAktif = $this->db->table('t_semester_aktif')
            ->where('status', 'Aktif')
            ->get()->getRowArray();
        
        if (!$semesterAktif) {
            return [
                'label_semester'  => 'Belum ada semester aktif',
                'mahasiswa_aktif' => 0,
                'kelas_berjalan'  => 0,
                'ujian_mendatang' => 0,
            ];
        }
        
        $semester = $semesterAktif['semester'];
        $tahunAjaran = $semesterAktif['tahun_ajaran'];
        
        // Hitung mahasiswa aktif
        $mahasiswaAktif = $this->db->table('t_mahasiswa')
            ->where('status', 'Aktif')
            ->countAllResults();
        
        // Hitung kelas berjalan berdasarkan jadwal aktif
        $kelasBerjalan = $this->db->table('jadwal_kuliah')
            ->where('semester', $semester)
            ->where('tahun_ajaran', $tahunAjaran)
            ->select('COUNT(DISTINCT id_ruangan) as total')
            ->get()->getRow()->total ?? 0;
        
        // Hitung ujian mendatang
        $ujianMendatang = $this->db->table('kalender_akademik')
            ->where('tipe_event', 'Ujian')
            ->where('tanggal_mulai >=', date('Y-m-d'))
            ->countAllResults();
        
        return [
            'label_semester'  => $semester . ' ' . $tahunAjaran,
            'mahasiswa_aktif' => $mahasiswaAktif,
            'kelas_berjalan'  => $kelasBerjalan,
            'ujian_mendatang' => $ujianMendatang,
        ];
    }

    public function getUpcomingExamCount()
    {
        return $this->db->table('kalender_akademik')
            ->where('tipe_event', 'Ujian')
            ->where('tanggal_mulai >=', date('Y-m-d'))
            ->countAllResults();
    }

    public function getRecentActivities()
    {
        $activities = $this->db->table('t_log_aktivitas')
            ->orderBy('created_at', 'DESC')
            ->limit(5)
            ->get()->getResultArray();
        
        $result = [];
        foreach ($activities as $act) {
            $result[] = [
                'judul' => $act['description'] ?? ucfirst($act['action']),
                'jumlah' => $act['table_name'] ?? '-',
                'tanggal' => date('d M Y H:i', strtotime($act['created_at'])),
                'status' => ucfirst($act['action'])
            ];
        }
        
        return $result;
    }
}
