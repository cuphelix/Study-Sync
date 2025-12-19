<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\admin\DosenModel;

class Dosen extends BaseController
{
    protected $dosenModel;
    protected $request;

    public function __construct()
    {
        $this->dosenModel = new DosenModel();
        $this->request    = service('request');
    }

    public function index()
    {
        $keyword = $this->request->getGet('q');

        $listDosen = $this->dosenModel->getDosenWithStats($keyword);

        $totalDosen      = (method_exists($this->dosenModel, 'getTotalDosen'))
            ? (int) $this->dosenModel->getTotalDosen()
            : (int) $this->dosenModel->countAllResults();

        $totalDosenAktif = (method_exists($this->dosenModel, 'getTotalDosenAktif'))
            ? (int) $this->dosenModel->getTotalDosenAktif()
            : $totalDosen;

        // total mata kuliah keseluruhan
        $db = db_connect();
        $totMk = (int) $db->table('t_matakuliah')->countAllResults();

        $data = [
            'title'           => 'Manajemen Dosen | StudySync',
            'pageTitle'       => 'Manajemen Dosen',
            'dosen'           => $listDosen,
            'cards'           => [
                'total_dosen'       => $totalDosen,
                'dosen_aktif'       => $totalDosenAktif,
                'total_matakuliah'  => $totMk,
            ],
            'keyword'         => $keyword,
        ];

        return view('admin/dosen/index', $data);
    }

    public function show($id)
    {
        $d = $this->dosenModel->find($id);
        if (!$d) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Dosen tidak ditemukan');
        }

        // Jika ingin menampilkan statistik ringkas pada halaman show,
        // kamu bisa join / hit model tambahan di sini. Untuk sekarang pakai data dasar.
        return view('admin/dosen/show', [
            'title' => 'Detail Dosen',
            'dosen' => $d,
            'success' => session()->getFlashdata('success'),
            'error'   => session()->getFlashdata('error'),
        ]);
    }

    public function edit($id)
    {
        $d = $this->dosenModel->find($id);
        if (!$d) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Dosen tidak ditemukan');
        }

        return view('admin/dosen/edit', [
            'title'      => 'Edit Dosen',
            'dosen'      => $d,
            'validation' => \Config\Services::validation(),
        ]);
    }

    public function update($id)
    {
        $id = (int) $id;
        $dosen = $this->dosenModel->find($id);
        if (! $dosen) {
            return redirect()->back()->with('error', 'Dosen tidak ditemukan.');
        }

        // rules validasi
        $rules = [
            'nip'        => 'required|alpha_numeric_space|min_length[3]|max_length[50]',
            'nama_dosen' => 'required|min_length[3]|max_length[191]',
            'email'      => 'permit_empty|valid_email|max_length[191]',
            'no_wa'      => 'permit_empty|max_length[30]',
            'password'   => 'permit_empty|min_length[6]|max_length[100]',
        ];

        // unique checks only if value changed
        $nipInput = $this->request->getPost('nip');
        if ($nipInput && $nipInput !== $dosen['nip']) {
            $rules['nip'] .= '|is_unique[t_dosen.nip]';
        }
        $emailInput = $this->request->getPost('email');
        if ($emailInput && $emailInput !== $dosen['email']) {
            $rules['email'] .= '|is_unique[t_dosen.email]';
        }

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        // prepare update data
        $updateData = [
            'nip'        => $this->request->getPost('nip'),
            'nama_dosen' => $this->request->getPost('nama_dosen'),
            'email'      => $this->request->getPost('email'),
            'no_wa'      => $this->request->getPost('no_wa'),
        ];

        // password only if provided
        $pw = $this->request->getPost('password');
        if (!empty($pw)) {
            $updateData['password'] = password_hash($pw, PASSWORD_DEFAULT);
        }

        // if id_prodi exists in DB and provided in form, include it (optional)
        $idProdi = $this->request->getPost('id_prodi');
        if ($idProdi !== null) {
            $updateData['id_prodi'] = $idProdi;
        }

        $saved = $this->dosenModel->update($id, $updateData);

        if ($saved === false) {
            $errors = $this->dosenModel->errors();
            $msg = !empty($errors) ? implode(', ', $errors) : 'Gagal menyimpan data.';
            return redirect()->back()->withInput()->with('error', $msg);
        }

        return redirect()->to(base_url('admin/dosen/' . $id))->with('success', 'Data dosen berhasil diperbarui.');
    }
}
