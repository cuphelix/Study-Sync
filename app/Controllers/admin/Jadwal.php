<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\admin\JadwalModel;
use App\Models\admin\MatakuliahModel;
use App\Models\admin\DosenModel;
use App\Models\admin\KelasModel;

class Jadwal extends BaseController
{
    protected $jadwalModel;
    protected $mkModel;
    protected $dosenModel;
    protected $kelasModel;

    public function __construct()
    {
        $this->jadwalModel = new JadwalModel();
        $this->mkModel     = new MatakuliahModel();
        $this->dosenModel  = new DosenModel();
        $this->kelasModel  = new KelasModel();
    }

    public function index()
    {
        $keyword = $this->request->getGet('q');
        $builder = $this->jadwalModel->search($keyword);
        $jadwal  = $builder->orderBy('jadwal_kuliah.hari', 'ASC')->orderBy('jadwal_kuliah.jam_mulai', 'ASC')->findAll();

        // KPI sederhana (opsional)
        $cards = [
            'total_jadwal' => $this->jadwalModel->countAllResults(false),
            'matkul_aktif' => $this->mkModel->countAllResults(false),
            'kelas_berbeda' => $this->jadwalModel->select('COUNT(DISTINCT id_ruangan) as c')->first()['c'] ?? 0
        ];

        return view('admin/jadwal/index', [
            'pageTitle' => 'Manajemen Jadwal',
            'today'     => date('l, j F Y'),
            'keyword'   => $keyword,
            'jadwal'    => $jadwal,
            'cards'     => $cards
        ]);
    }

    public function show($id)
    {
        $row = $this->jadwalModel->withRelations()->find($id);
        if (!$row) throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();

        return view('admin/jadwal/show', [
            'pageTitle' => 'Detail Jadwal',
            'jadwal'    => $row
        ]);
    }

    public function edit($id)
    {
        $row = $this->jadwalModel->find($id);
        if (!$row) throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();

        $matkul = $this->mkModel->findAll();
        $dosen   = $this->dosenModel->findAll();
        $kelas   = $this->kelasModel->findAll();

        return view('admin/jadwal/edit', [
            'pageTitle' => 'Edit Jadwal',
            'jadwal'    => $row,
            'matkul'    => $matkul,
            'dosen'     => $dosen,
            'kelas'     => $kelas,
            'validation' => \Config\Services::validation()
        ]);
    }

    public function update($id)
    {
        $post = $this->request->getPost();

        $rules = [
            'id_mk' => 'required',
            'id_dosen' => 'required',
            'id_ruangan' => 'required',
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required'
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $this->jadwalModel->update($id, [
            'id_mk'      => $post['id_mk'],
            'id_dosen'   => $post['id_dosen'],
            'id_ruangan' => $post['id_ruangan'],
            'hari'       => $post['hari'],
            'jam_mulai'  => $post['jam_mulai'],
            'jam_selesai' => $post['jam_selesai'],
            'minggu_ke'  => $post['minggu_ke'] ?? null,
            'tahun_ajaran' => $post['tahun_ajaran'] ?? null,
            'semester'   => $post['semester'] ?? null
        ]);

        return redirect()->to('/admin/jadwal/' . $id)->with('success', 'Jadwal berhasil diperbarui.');
    }
}
