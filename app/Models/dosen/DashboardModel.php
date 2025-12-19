<?php

namespace App\Models\dosen;

use CodeIgniter\Model;

class DashboardModel extends Model
{
    protected $table = 'jadwal_kuliah';

    // Jadwal hari ini (untuk dosen login)
    public function jadwalHariIni($idDosen)
    {
        $hari = date('l');
        $mapHari = [
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu'
        ];

        $hariIndonesia = $mapHari[$hari] ?? 'Senin';

        return $this->db->table('jadwal_kuliah jk')
            ->select('
                jk.id_jadwal,
                tm.id_matakuliah,
                tm.kode_matakuliah,
                tm.nama_matakuliah,
                jk.jam_mulai,
                jk.jam_selesai,
                tk.kode_kelas,
                tk.id_kelas,
                tg.nama_gedung,
                jk.minggu_ke,
                jk.hari
            ')
            ->join('t_matakuliah tm', 'tm.id_matakuliah = jk.id_mk', 'left')
            ->join('t_kelas tk', 'tk.id_kelas = jk.id_ruangan', 'left')
            ->join('t_gedung tg', 'tg.id_gedung = tk.id_gedung', 'left')
            ->where('jk.id_dosen', $idDosen)
            ->where('jk.hari', $hariIndonesia)
            ->orderBy('jk.jam_mulai', 'ASC')
            ->get()->getResultArray();
    }

    // Pengingat dosen
    public function pengingat($idDosen)
    {
        return $this->db->table('pengingat')
            ->where('id_user', $idDosen)
            ->where('aktif', 1)
            ->orderBy('tanggal', 'ASC')
            ->orderBy('waktu', 'ASC')
            ->get()->getResultArray();
    }

    // Profil dosen
    public function profil($idDosen)
    {
        return $this->db->table('t_dosen')
            ->where('id_dosen', $idDosen)
            ->get()->getRow();
    }
}
