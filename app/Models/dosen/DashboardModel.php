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

        return $this->db->table('jadwal_kuliah jk')
            ->select('
                tm.nama_matakuliah,
                jk.jam_mulai,
                jk.jam_selesai,
                tk.kode_kelas,
                jk.minggu_ke
            ')
            ->join('t_matakuliah tm', 'tm.id_matakuliah = jk.id_mk')
            ->join('t_kelas tk', 'tk.id_kelas = jk.id_ruangan')
            ->where('jk.id_dosen', $idDosen)
            ->where('jk.hari', $mapHari[$hari])
            ->orderBy('jk.jam_mulai', 'ASC')
            ->get()->getResult();
    }

    // Pengingat dosen
    public function pengingat($idDosen)
    {
        return $this->db->table('pengingat')
            ->where('id_user', $idDosen)
            ->where('aktif', 1)
            ->orderBy('tanggal', 'ASC')
            ->get()->getResult();
    }

    // Profil dosen
    public function profil($idDosen)
    {
        return $this->db->table('t_dosen')
            ->where('id_dosen', $idDosen)
            ->get()->getRow();
    }
}
