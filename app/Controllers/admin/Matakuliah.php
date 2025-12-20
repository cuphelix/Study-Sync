<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\admin\MatakuliahModel;

class Matakuliah extends BaseController
{
    protected $mkModel;
    protected $validation;

    public function __construct()
    {
        $this->mkModel = new MatakuliahModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $keyword = $this->request->getGet('q');
        $list = $this->mkModel->getAll($keyword);

        $data = [
            'title'      => 'Manajemen Mata Kuliah',
            'pageTitle'  => 'Manajemen Mata Kuliah',
            'matakuliah' => $list,
            'keyword'    => $keyword,
            'cards'      => [
                'total_mk'  => count($list),
                'wajib'     => $this->mkModel->countWajib(),
                'total_sks' => $this->mkModel->totalSKS(),
            ],
        ];

        return view('admin/matakuliah/index', $data);
    }

    public function create()
{
    return view('admin/matakuliah/create', [
        'title' => 'Tambah Mata Kuliah',
        'validation' => \Config\Services::validation(),
    ]);
}

public function store()
{
    $rules = [
        'kode_matakuliah' => 'required|alpha_numeric_punct|min_length[2]|max_length[20]|is_unique[t_matakuliah.kode_matakuliah]',
        'nama_matakuliah' => 'required|min_length[3]|max_length[191]',
        'sks' => 'required|integer|greater_than[0]|less_than_equal_to[10]',
        'jenis' => 'required|in_list[Wajib,Pilihan]',
    ];

    if (!$this->validate($rules)) {
        return redirect()->back()->withInput()->with('validation', $this->validator);
    }

    $data = [
        'kode_matakuliah' => $this->request->getPost('kode_matakuliah'),
        'nama_matakuliah' => $this->request->getPost('nama_matakuliah'),
        'sks' => (int)$this->request->getPost('sks'),
        'semester' => $this->request->getPost('semester') ?: null,
        'id_prodi' => $this->request->getPost('id_prodi') ?: null,
        'id_dosen' => $this->request->getPost('id_dosen') ?: null,
        'id_kelas' => $this->request->getPost('id_kelas') ?: null,
        'jenis' => $this->request->getPost('jenis'),
    ];

    $this->mkModel->insert($data);

    return redirect()->to(base_url('admin/matakuliah'))->with('success', 'Mata kuliah berhasil ditambahkan.');
}


    public function show($id)
    {
        $id = (int)$id;
        $mk = $this->mkModel->find($id);
        if (!$mk) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Mata kuliah tidak ditemukan');
        }

        return view('admin/matakuliah/show', [
            'title' => 'Detail Mata Kuliah',
            'pageTitle' => 'Detail Mata Kuliah',
            'mk' => $mk
        ]);
    }

    public function edit($id)
    {
        $id = (int)$id;
        $mk = $this->mkModel->find($id);
        if (!$mk) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Mata kuliah tidak ditemukan');
        }

        return view('admin/matakuliah/edit', [
            'title' => 'Edit Mata Kuliah',
            'pageTitle' => 'Edit Mata Kuliah',
            'mk' => $mk,
            'validation' => $this->validation
        ]);
    }

    public function update($id)
    {
        $id = (int)$id;
        $mk = $this->mkModel->find($id);
        if (!$mk) {
            return redirect()->back()->with('error', 'Mata kuliah tidak ditemukan.');
        }

        $rules = [
            'kode_matakuliah' => 'required|alpha_numeric_punct|min_length[2]|max_length[20]',
            'nama_matakuliah' => 'required|min_length[3]|max_length[191]',
            'sks'             => 'required|integer|greater_than[0]|less_than_equal_to[10]',
            'id_prodi'        => 'permit_empty|integer',
            'jenis'           => 'required|in_list[Wajib,Pilihan]'
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $data = [
            'kode_matakuliah' => $this->request->getPost('kode_matakuliah'),
            'nama_matakuliah' => $this->request->getPost('nama_matakuliah'),
            'sks'             => (int)$this->request->getPost('sks'),
            'id_prodi'        => $this->request->getPost('id_prodi') ?: null,
            'jenis'           => $this->request->getPost('jenis'),
        ];

        $updated = $this->mkModel->update($id, $data);

        if ($updated === false) {
            $errors = $this->mkModel->errors();
            $msg = !empty($errors) ? implode(', ', $errors) : 'Gagal menyimpan data.';
            return redirect()->back()->withInput()->with('error', $msg);
        }

        return redirect()->to(base_url('admin/matakuliah/' . $id))->with('success', 'Data mata kuliah berhasil diperbarui.');
    }
}
