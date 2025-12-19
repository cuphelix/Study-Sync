<?php

namespace App\Controllers\Dosen;

use App\Controllers\BaseController;
use App\Models\dosen\MatakuliahModel;
use App\Models\dosen\JadwalKuliahModel;

class JadwalMengajar extends BaseController
{
    protected $matakuliahModel;
    protected $jadwalModel;
    protected $db;

    public function __construct()
    {
        $this->matakuliahModel = new MatakuliahModel();
        $this->jadwalModel = new JadwalKuliahModel();
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        if (!session()->get('logged_in_dosen')) {
            return redirect()->to('/login/dosen');
        }

        $idDosen = session()->get('id_dosen');

        // Ambil semua jadwal dosen dengan detail lengkap
        $jadwal = $this->db->table('jadwal_kuliah jk')
            ->select('
                jk.*,
                tm.kode_matakuliah,
                tm.nama_matakuliah,
                tk.kode_kelas,
                tg.nama_gedung,
                tk.lantai
            ')
            ->join('t_matakuliah tm', 'tm.id_matakuliah = jk.id_mk', 'left')
            ->join('t_kelas tk', 'tk.id_kelas = jk.id_ruangan', 'left')
            ->join('t_gedung tg', 'tg.id_gedung = tk.id_gedung', 'left')
            ->where('jk.id_dosen', $idDosen)
            ->orderBy("FIELD(jk.hari, 'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu')", '', false)
            ->orderBy('jk.jam_mulai', 'ASC')
            ->get()->getResultArray();

        // Hitung statistik
        $totalKelas = $this->db->table('jadwal_kuliah')
            ->select('COUNT(DISTINCT id_ruangan) as total')
            ->where('id_dosen', $idDosen)
            ->get()->getRow()->total ?? 0;

        $totalMatkul = $this->matakuliahModel
            ->where('id_dosen', $idDosen)
            ->countAllResults();

        // Hitung total mahasiswa dari prodi yang sama
        $totalMahasiswa = $this->db->table('t_mahasiswa tm')
            ->select('tm.id_mahasiswa')
            ->join('t_prodi tp', 'tp.id_prodi = tm.id_prodi')
            ->join('t_matakuliah tmk', 'tmk.id_prodi = tp.id_prodi')
            ->where('tmk.id_dosen', $idDosen)
            ->groupBy('tm.id_mahasiswa')
            ->countAllResults();

        if ($totalMahasiswa == 0) {
            $totalMahasiswa = $totalMatkul * 30; // estimasi
        }

        // Organisasi jadwal per hari dan jam
        $jadwalPerHari = [];
        $hariList = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        
        foreach ($jadwal as $j) {
            $hari = $j['hari'];
            if (!isset($jadwalPerHari[$hari])) {
                $jadwalPerHari[$hari] = [];
            }
            $jadwalPerHari[$hari][] = $j;
        }

        $data = [
            'title' => 'Jadwal Mengajar',
            'jadwal' => $jadwal,
            'jadwalPerHari' => $jadwalPerHari,
            'hariList' => $hariList,
            'totalKelas' => $totalKelas,
            'totalMahasiswa' => $totalMahasiswa,
            'totalMatkul' => $totalMatkul
        ];

        return view('dosen/jadwal_mengajar', $data);
    }
}
