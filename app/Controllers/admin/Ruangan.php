<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\admin\KelasModel;
use App\Models\admin\GedungModel;

class Ruangan extends BaseController
{
    protected $kelasModel;
    protected $gedungModel;

    public function __construct()
    {
        $this->kelasModel  = new KelasModel();
        $this->gedungModel = new GedungModel();
    }

    public function index()
    {
        $keyword = $this->request->getGet('q');

        // base: join ke gedung biar nama_gedung tersedia
        $builder = $this->kelasModel->withGedung();

        // kalau ada keyword, pakai method search() lalu tetap join gedung
        if ($keyword) {
            $builder = $this->kelasModel
                ->withGedung()
                ->search($keyword);
        }

        $kelas = $builder->findAll();

        $data = [
            'pageTitle' => 'Manajemen Ruangan',
            'today'     => date('l, j F Y'),
            'keyword'   => $keyword,
            'ruangan'   => $kelas,
            'cards'     => [
                'total_kelas'  => $this->kelasModel->countAll(),          // total baris t_kelas
                'total_gedung' => $this->gedungModel->countAll(),         // total baris t_gedung
                // nggak pakai kapasitas di view, jadi nggak perlu angka lain
            ],
        ];

        return view('admin/ruangan/index', $data);
    }


    public function create()
{
    $gedungs = $this->gedungModel->findAll();
    
    return view('admin/ruangan/create', [
        'pageTitle' => 'Tambah Ruangan',
        'gedungs' => $gedungs,
        'validation' => \Config\Services::validation(),
    ]);
}

public function store()
{
    $rules = [
        'kode_kelas' => 'required|alpha_numeric_punct|min_length[2]|max_length[20]|is_unique[t_kelas.kode_kelas]',
        'lantai' => 'permit_empty|integer',
        'id_gedung' => 'permit_empty|integer',
    ];

    if (!$this->validate($rules)) {
        return redirect()->back()->withInput()->with('validation', $this->validator);
    }

    $data = [
        'kode_kelas' => $this->request->getPost('kode_kelas'),
        'lantai' => $this->request->getPost('lantai') ?: null,
        'id_gedung' => $this->request->getPost('id_gedung') ?: null,
    ];

    $this->kelasModel->insert($data);

    return redirect()->to(base_url('admin/ruangan'))->with('success', 'Ruangan berhasil ditambahkan.');
}

    public function show($id)
    {
        // detail satu kelas + nama_gedung
        $r = $this->kelasModel->findWithGedung($id);

        if (!$r) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('admin/ruangan/show', [
            'pageTitle' => 'Detail Ruangan',
            'today'     => date('l, j F Y'),
            'ruangan'   => $r,
        ]);
    }

    public function edit($id)
    {
        $r = $this->kelasModel->find($id);
        if (!$r) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // daftar gedung untuk <select>
        $gedungs = $this->gedungModel->findAll();

        return view('admin/ruangan/edit', [
            'pageTitle'  => 'Edit Ruangan',
            'ruangan'    => $r,
            'gedungs'    => $gedungs,
            'validation' => \Config\Services::validation(),
        ]);
    }

    public function update($id)
    {
        $post = $this->request->getPost();

        $this->kelasModel->update($id, [
            'kode_kelas' => $post['kode_kelas'] ?? null,
            'lantai'     => $post['lantai'] ?? null,
            'id_gedung'  => $post['id_gedung'] ?? null,
        ]);

        return redirect()
            ->to('/admin/ruangan/' . $id)
            ->with('success', 'Data kelas berhasil diperbarui.');
    }
}
