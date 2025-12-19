<?php

namespace App\Controllers\Dosen;

use App\Controllers\BaseController;
use App\Models\dosen\DashboardModel;
use App\Models\dosen\DosenModel;
use App\Models\dosen\MatakuliahModel;
use App\Models\dosen\KelasModel;
use App\Models\dosen\MahasiswaModel;
use App\Models\dosen\PengingatModel;
use App\Models\dosen\KelasMahasiswaModel;

class Dashboard extends BaseController
{
    protected $dashboardModel;
    protected $dosenModel;
    protected $matakuliahModel;
    protected $mahasiswaModel;
    protected $pengingatModel;
    protected $kelasMahasiswaModel;
    protected $db;

    public function __construct()
    {
        $this->dashboardModel = new DashboardModel();
        $this->dosenModel = new DosenModel();
        $this->matakuliahModel = new MatakuliahModel();
        $this->mahasiswaModel = new MahasiswaModel();
        $this->pengingatModel = new PengingatModel();
        $this->kelasMahasiswaModel = new KelasMahasiswaModel();
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        // Cek login
        if (!session()->get('logged_in_dosen')) {
            return redirect()->to('/login/dosen');
        }

        $idDosen = session()->get('id_dosen');

        // 1. Data Profil Dosen
        $dosen = $this->dashboardModel->profil($idDosen);

        // 2. Jadwal Hari Ini
        $jadwalHariIni = $this->dashboardModel->jadwalHariIni($idDosen);

        // 3. Total Mata Kuliah yang diampu
        $totalMataKuliah = $this->matakuliahModel
            ->where('id_dosen', $idDosen)
            ->countAllResults();

        // 4. Total Mahasiswa - gunakan tabel t_kelas_mahasiswa jika ada, fallback ke prodi
        $totalMahasiswa = $this->db->table('t_kelas_mahasiswa tkm')
            ->select('DISTINCT tkm.id_mahasiswa')
            ->join('t_matakuliah tm', 'tm.id_matakuliah = tkm.id_matakuliah', 'left')
            ->where('tm.id_dosen', $idDosen)
            ->where('tkm.status', 'Aktif')
            ->countAllResults();
        
        // Fallback jika tabel t_kelas_mahasiswa kosong
        if ($totalMahasiswa == 0) {
            $totalMahasiswa = $this->db->table('t_mahasiswa tm')
                ->select('tm.id_mahasiswa')
                ->join('t_prodi tp', 'tp.id_prodi = tm.id_prodi')
                ->join('t_matakuliah tmk', 'tmk.id_prodi = tp.id_prodi')
                ->where('tmk.id_dosen', $idDosen)
                ->where('tm.status', 'Aktif')
                ->groupBy('tm.id_mahasiswa')
                ->countAllResults();
            
            // Jika masih 0, gunakan estimasi
            if ($totalMahasiswa == 0) {
                $totalMahasiswa = $totalMataKuliah * 30; // estimasi
            }
        }

        // 5. Jumlah Kelas Hari Ini
        $jumlahKelasHariIni = count($jadwalHariIni);

        // 6. Pengingat Aktif
        $pengingat = $this->dashboardModel->pengingat($idDosen);
        $totalPengingat = count($pengingat);

        // 7. Format Tanggal Hari Ini
        $hariIni = $this->formatTanggalIndonesia(date('Y-m-d'));
        
        // 8. Ambil data prodi untuk nama prodi
        $prodi = null;
        if ($dosen && $dosen->id_prodi) {
            $prodi = $this->db->table('t_prodi')
                ->where('id_prodi', $dosen->id_prodi)
                ->get()->getRow();
        }

        $data = [
            'title' => 'Dashboard Dosen',
            'dosen' => $dosen,
            'prodi' => $prodi,
            'jadwalHariIni' => $jadwalHariIni,
            'jumlahKelasHariIni' => $jumlahKelasHariIni,
            'totalMataKuliah' => $totalMataKuliah,
            'totalMahasiswa' => $totalMahasiswa,
            'totalPengingat' => $totalPengingat,
            'pengingat' => array_slice($pengingat, 0, 3), // Ambil 3 pengingat teratas
            'hariIni' => $hariIni
        ];

        return view('dosen/dashboard', $data);
    }

    private function formatTanggalIndonesia($tanggal)
    {
        $hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        $bulan = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        $timestamp = strtotime($tanggal);
        $hariName = $hari[date('w', $timestamp)];
        $tanggalNum = date('d', $timestamp);
        $bulanName = $bulan[date('n', $timestamp)];
        $tahun = date('Y', $timestamp);

        return "$hariName, $tanggalNum $bulanName $tahun";
    }
}
