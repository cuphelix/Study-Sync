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
        if (!session()->get('logged_in_dosen')) {
            return redirect()->to('/login/dosen');
        }

        $idDosen = session()->get('id_dosen');
        $matkulModel = new MatakuliahModel();
        $prodiModel  = new ProdiModel();
        $db = \Config\Database::connect();

        // Ambil data matakuliah yang diajar oleh dosen ini (JOIN)
        $matkuls = $matkulModel
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
                t_prodi.nama_prodi,
                t_dosen.nama_dosen
            ')
            ->join('t_prodi', 't_prodi.id_prodi = t_matakuliah.id_prodi', 'left')
            ->join('t_dosen', 't_dosen.id_dosen = t_matakuliah.id_dosen', 'left')
            ->where('t_matakuliah.id_dosen', $idDosen)
            ->findAll();
        
        // Convert ke array jika masih object
        foreach ($matkuls as &$mk) {
            if (is_object($mk)) {
                $mk = (array) $mk;
            }
        }

        // Statistik berdasarkan dosen login
        $total_matkul = count($matkuls);
        
        // Hitung total mahasiswa dari prodi yang sama dengan matakuliah dosen
        $total_mahasiswa = $db->table('t_mahasiswa tm')
            ->select('tm.id_mahasiswa')
            ->join('t_prodi tp', 'tp.id_prodi = tm.id_prodi')
            ->join('t_matakuliah tmk', 'tmk.id_prodi = tp.id_prodi')
            ->where('tmk.id_dosen', $idDosen)
            ->groupBy('tm.id_mahasiswa')
            ->countAllResults();

        if ($total_mahasiswa == 0) {
            $total_mahasiswa = $total_matkul * 30; // estimasi
        }

        $data = [
            'matkul'           => $matkuls,
            'total_matkul'     => $total_matkul,
            'total_mahasiswa'  => $total_mahasiswa,
        ];

        return view('dosen/matkul_diajar', $data);
    }
}
