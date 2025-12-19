<?php

namespace App\Controllers\Dosen;

use App\Controllers\BaseController;
use App\Models\dosen\MatakuliahModel;
use App\Models\dosen\MahasiswaModel;
use App\Models\dosen\NilaiModel;
use App\Models\dosen\KelasMahasiswaModel;

class Mahasiswa extends BaseController
{
    protected $matakuliahModel;
    protected $mahasiswaModel;
    protected $nilaiModel;
    protected $kelasMahasiswaModel;
    protected $db;

    public function __construct()
    {
        $this->matakuliahModel = new MatakuliahModel();
        $this->mahasiswaModel = new MahasiswaModel();
        $this->nilaiModel = new NilaiModel();
        $this->kelasMahasiswaModel = new KelasMahasiswaModel();
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        if (!session()->get('logged_in_dosen')) {
            return redirect()->to('/login/dosen');
        }

        $idDosen = session()->get('id_dosen');

        // Ambil mahasiswa dari prodi yang sama dengan matakuliah yang diajar dosen
        $mahasiswa = $this->mahasiswaModel->getMahasiswaWithProdi($idDosen);
        
        // Hitung IPK untuk setiap mahasiswa
        foreach ($mahasiswa as &$mhs) {
            $mhs['ipk'] = $this->nilaiModel->getIPK($mhs['id_mahasiswa']);
        }

        // Hitung statistik
        $totalMahasiswa = count($mahasiswa);
        $totalAktif = $this->db->table('t_mahasiswa tm')
            ->select('tm.id_mahasiswa')
            ->join('t_prodi tp', 'tp.id_prodi = tm.id_prodi', 'left')
            ->join('t_matakuliah tmk', 'tmk.id_prodi = tp.id_prodi', 'left')
            ->where('tmk.id_dosen', $idDosen)
            ->where('tm.status', 'Aktif')
            ->groupBy('tm.id_mahasiswa')
            ->countAllResults();
        
        // Hitung rata-rata IPK
        $ipkRataRata = $this->nilaiModel->getRataRataIPK();

        $data = [
            'title' => 'Mahasiswa',
            'mahasiswa' => $mahasiswa,
            'totalMahasiswa' => $totalMahasiswa,
            'totalAktif' => $totalAktif,
            'ipkRataRata' => $ipkRataRata
        ];

        return view('dosen/mahasiswa', $data);
    }
}
