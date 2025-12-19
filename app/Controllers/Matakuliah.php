<?php

namespace App\Controllers;

use App\Models\MatakuliahModel;

class Matakuliah extends BaseController
{
    protected $matakuliahModel;

    public function __construct()
    {
        $this->matakuliahModel = new MatakuliahModel();
    }

    public function index()
    {
        $id_mahasiswa = session()->get('id_mahasiswa') ?? 1;

        // Ambil semua mata kuliah berdasarkan prodi mahasiswa
        $data['matakuliah'] = $this->matakuliahModel->getMatakuliahByMahasiswa($id_mahasiswa);

        // Hitung total SKS
        $data['total_sks'] = 0;
        foreach ($data['matakuliah'] as $mk) {
            $data['total_sks'] += 3; // Asumsi setiap mata kuliah 3 SKS
        }

        // GANTI PATH VIEW KE FOLDER MAHASISWA
        return view('mahasiswa/matakuliah', $data);
    }

    public function detail($id_matakuliah)
    {
        $data['matakuliah'] = $this->matakuliahModel->getMatakuliahDetail($id_matakuliah);

        if (!$data['matakuliah']) {
            return redirect()->to('/matakuliah')->with('error', 'Mata kuliah tidak ditemukan');
        }

        return view('mahasiswa/matakuliah_detail', $data);
    }
}
