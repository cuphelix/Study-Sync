<?php

namespace App\Controllers\Dosen;

use App\Controllers\BaseController;
use App\Models\dosen\MatakuliahModel;
use App\Models\dosen\ProdiModel;
use App\Models\dosen\DosenModel;

class MataKuliahDiajar extends BaseController
{
    public function index()
    {
        $matkulModel = new MatakuliahModel();
        $prodiModel  = new ProdiModel();
        $dosenModel  = new DosenModel();

        // Ambil data matakuliah (JOIN)
        $matkuls = $matkulModel
            ->select('t_matakuliah.*, t_prodi.nama_prodi, t_dosen.nama_dosen')
            ->join('t_prodi', 't_prodi.id_prodi = t_matakuliah.id_prodi', 'left')
            ->join('t_dosen', 't_dosen.id_dosen = t_matakuliah.id_dosen', 'left')
            ->findAll();

        // Statistik
        $total_matkul    = $matkulModel->countAll();
        $total_prodi     = $prodiModel->countAll();
        $total_dosen     = $dosenModel->countAll();
        $total_kelas     = $matkulModel->select('id_kelas')->distinct()->countAllResults();
        $total_semester  = $matkulModel->select('semester')->distinct()->countAllResults();

        // Jika belum ada tabel mahasiswa → manual
        $total_mahasiswa = 0;

        $data = [
            'matkul'           => $matkuls,
            'total_matkul'     => $total_matkul,
            'total_prodi'      => $total_prodi,
            'total_dosen'      => $total_dosen,
            'total_kelas'      => $total_kelas,
            'total_semester'   => $total_semester,
            'total_mahasiswa'  => $total_mahasiswa,
        ];

        return view('dosen/matkul_diajar', $data);
    }
}
