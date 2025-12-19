<?php

namespace App\Controllers\dosen;

use App\Controllers\BaseController;
use App\Models\dosen\DosenModel;
use App\Models\dosen\MatakuliahModel;
use App\Models\dosen\ProdiModel;
use App\Models\dosen\PublikasiModel;
use App\Models\dosen\KelasMahasiswaModel;

class Profile extends BaseController
{
    protected $dosenModel;
    protected $matakuliahModel;
    protected $prodiModel;
    protected $publikasiModel;
    protected $kelasMahasiswaModel;
    protected $db;

    public function __construct()
    {
        $this->dosenModel = new DosenModel();
        $this->matakuliahModel = new MatakuliahModel();
        $this->prodiModel = new ProdiModel();
        $this->publikasiModel = new PublikasiModel();
        $this->kelasMahasiswaModel = new KelasMahasiswaModel();
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        if (!session()->get('logged_in_dosen')) {
            return redirect()->to('/login/dosen');
        }

        $idDosen = session()->get('id_dosen');

        // Ambil data dosen dengan prodi
        $dosen = $this->dosenModel->find($idDosen);
        if (!$dosen) {
            return redirect()->to('/dosen/dashboard')->with('error', 'Data dosen tidak ditemukan');
        }

        // Convert ke array jika masih object
        if (is_object($dosen)) {
            $dosen = (array) $dosen;
        }

        $prodi = null;
        if (!empty($dosen['id_prodi'])) {
            $prodi = $this->prodiModel->find($dosen['id_prodi']);
            if (is_object($prodi)) {
                $prodi = (array) $prodi;
            }
        }

        // Ambil mata kuliah yang diajar
        $matakuliah = $this->matakuliahModel
            ->select('
                t_matakuliah.id_matakuliah,
                t_matakuliah.kode_matakuliah,
                t_matakuliah.nama_matakuliah,
                t_matakuliah.semester,
                t_matakuliah.sks,
                t_matakuliah.id_dosen,
                t_matakuliah.id_prodi as mk_id_prodi,
                t_matakuliah.id_kelas,
                t_matakuliah.jenis,
                t_prodi.nama_prodi
            ')
            ->join('t_prodi', 't_prodi.id_prodi = t_matakuliah.id_prodi', 'left')
            ->where('t_matakuliah.id_dosen', $idDosen)
            ->findAll();
        
        // Convert matakuliah ke array jika masih object
        foreach ($matakuliah as &$mk) {
            if (is_object($mk)) {
                $mk = (array) $mk;
            }
        }

        // Hitung statistik
        $totalMatkul = count($matakuliah);
        
        // Hitung total kelas unik
        $totalKelas = $this->db->table('jadwal_kuliah')
            ->select('COUNT(DISTINCT id_ruangan) as total')
            ->where('id_dosen', $idDosen)
            ->get()->getRow()->total ?? 0;

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

        // Group matakuliah untuk tabel dan hitung jumlah mahasiswa per matakuliah
        $matkulGrouped = [];
        foreach ($matakuliah as $mk) {
            $kode = $mk['kode_matakuliah'] ?? '';
            $idMatkul = $mk['id_matakuliah'] ?? null;
            
            if (!isset($matkulGrouped[$kode])) {
                $jumlahMahasiswa = 0;
                if ($idMatkul) {
                    $jumlahMahasiswa = $this->kelasMahasiswaModel->countMahasiswaByMatakuliah($idMatkul);
                }
                
                $matkulGrouped[$kode] = [
                    'kode' => $kode,
                    'nama' => $mk['nama_matakuliah'] ?? '',
                    'jumlah_kelas' => 0,
                    'jumlah_mahasiswa' => $jumlahMahasiswa
                ];
            }
            $matkulGrouped[$kode]['jumlah_kelas']++;
        }
        
        // Ambil publikasi dosen
        $publikasi = $this->publikasiModel->getByDosen($idDosen);
        
        // Hitung masa kerja jika ada tanggal_mulai
        $masaKerja = 0;
        if (!empty($dosen['tanggal_mulai'])) {
            $tanggalMulai = new \DateTime($dosen['tanggal_mulai']);
            $sekarang = new \DateTime();
            $masaKerja = $tanggalMulai->diff($sekarang)->y;
        }

        $data = [
            'title' => 'Profil Dosen',
            'dosen' => $dosen,
            'prodi' => $prodi,
            'matakuliah' => $matakuliah,
            'matkulGrouped' => $matkulGrouped,
            'publikasi' => $publikasi,
            'totalMatkul' => $totalMatkul,
            'totalKelas' => $totalKelas,
            'totalMahasiswa' => $totalMahasiswa,
            'masaKerja' => $masaKerja
        ];

        return view('dosen/profile', $data);
    }
}
