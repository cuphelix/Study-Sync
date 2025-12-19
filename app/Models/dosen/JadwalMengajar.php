<?php

namespace App\Models\dosen;

use CodeIgniter\Model;

class JadwalModel extends Model
{
    protected $table = 'jadwal_kuliah';


    public function jadwalHariIni($id_dosen)
    {
        $hari = date('l'); // Monday, Tuesday...

        return $this->select('jadwal_kuliah.*, t_matakuliah.nama_matakuliah, t_kelas.nama_kelas, t_kelas.lokasi')
            ->join('t_matakuliah', 't_matakuliah.id_matakuliah = jadwal_kuliah.id_mk')
            ->join('t_kelas', 't_kelas.id_kelas = jadwal_kuliah.id_ruangan')
            ->where('jadwal_kuliah.id_dosen', $id_dosen)
            ->where('jadwal_kuliah.hari', $hari)
            ->findAll();
    }
}
