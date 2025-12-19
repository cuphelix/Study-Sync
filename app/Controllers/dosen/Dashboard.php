<?php

namespace App\Controllers\Dosen;

use App\Controllers\BaseController;
use App\Models\dosen\DashboardModel;
use App\Models\dosen\DosenModel;
use App\Models\dosen\MatakuliahModel;
use App\Models\dosen\KelasModel;
use App\Models\dosen\MahasiswaModel;
use App\Models\dosen\PengingatModel;

class Dashboard extends BaseController
{
    protected $dashboardModel;
    protected $dosenModel;
    protected $matakuliahModel;
    protected $mahasiswaModel;
    protected $pengingatModel;
    protected $db;

    public function __construct()
    {
        $this->dashboardModel = new DashboardModel();
        $this->dosenModel = new DosenModel();
        $this->matakuliahModel = new MatakuliahModel();
        $this->mahasiswaModel = new MahasiswaModel();
        $this->pengingatModel = new PengingatModel();
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

        // 4. Total Mahasiswa - karena tidak ada tabel kelas_mahasiswa, 
        // kita bisa hitung dari prodi yang sama atau set default
        // Alternatif: hitung mahasiswa dari prodi dosen
        $totalMahasiswa = $this->db->table('t_mahasiswa tm')
            ->join('t_prodi tp', 'tp.id_prodi = tm.id_prodi')
            ->join('t_matakuliah tmk', 'tmk.id_prodi = tp.id_prodi')
            ->where('tmk.id_dosen', $idDosen)
            ->countAllResults();

        // Atau jika ingin lebih sederhana, gunakan estimasi dari jumlah mata kuliah
        // Misalnya: rata-rata 30 mahasiswa per mata kuliah
        if ($totalMahasiswa == 0) {
            $totalMahasiswa = $totalMataKuliah * 30; // estimasi
        }

        // 5. Jumlah Kelas Hari Ini
        $jumlahKelasHariIni = count($jadwalHariIni);

        // 6. Pengingat Aktif
        $pengingat = $this->dashboardModel->pengingat($idDosen);
        $totalPengingat = count($pengingat);

        // 7. Format Tanggal Hari Ini
        $hariIni = $this->formatTanggalIndonesia(date('Y-m-d'));

        $data = [
            'title' => 'Dashboard Dosen',
            'dosen' => $dosen,
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
