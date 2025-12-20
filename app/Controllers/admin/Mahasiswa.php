<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\admin\MahasiswaModel;

class Mahasiswa extends BaseController
{
    protected $mahasiswaModel;

    public function __construct()
    {
        $this->mahasiswaModel = new MahasiswaModel();
    }

    public function index()
    {
        $keyword = $this->request->getGet('q');

        // ambil list mahasiswa dengan join prodi dan perkiraan ipk (jika tersedia)
        try {
            $list = $this->mahasiswaModel->getMahasiswaWithProdi($keyword);
        } catch (\Exception $e) {
            // jika t_nilai tidak ada atau query gagal, fallback tanpa ipk
            $db = \Config\Database::connect();
            $builder = $db->table('t_mahasiswa m')
                ->select('m.*, p.nama_prodi')
                ->join('t_prodi p', 'p.id_prodi = m.id_prodi', 'left')
                ->orderBy('m.nama_mahasiswa', 'ASC');
            if (!empty($keyword)) {
                $builder->groupStart()
                    ->like('m.nim', $keyword)
                    ->orLike('m.nama_mahasiswa', $keyword)
                    ->orLike('m.email', $keyword)
                    ->orLike('p.nama_prodi', $keyword)
                    ->groupEnd();
            }
            $list = $builder->get()->getResultArray();
            // pastikan ipk_estimate ada supaya view tidak error
            foreach ($list as &$r) {
                $r['ipk_estimate'] = null;
            }
        }

        $total = $this->mahasiswaModel->getTotalMahasiswa();
        $aktif = $this->mahasiswaModel->getTotalMahasiswaAktif();

        // rata-rata ipk global dari tabel t_nilai
        $avgIpk = null;
        try {
            $nilaiModel = new \App\Models\admin\NilaiModel();
            $avgIpk = $nilaiModel->getRataRataIPK();
            if ($avgIpk > 0) {
                $avgIpk = number_format($avgIpk, 2, '.', '');
            } else {
                $avgIpk = null;
            }
        } catch (\Exception $e) {
            $avgIpk = null;
        }

        $data = [
            'title' => 'Manajemen Mahasiswa | StudySync',
            'pageTitle' => 'Manajemen Mahasiswa',
            'mahasiswa' => $list,
            'cards' => [
                'total_mahasiswa' => $total,
                'mahasiswa_aktif' => $aktif,
                'avg_ipk' => $avgIpk,
            ],
            'keyword' => $keyword,
        ];

        return view('admin/mahasiswa/index', $data);
    }

    public function show($id)
    {
        $id = (int)$id;
        $m = $this->mahasiswaModel->getById($id);
        if (!$m) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Mahasiswa tidak ditemukan');
        }

        return view('admin/mahasiswa/show', [
            'title' => 'Detail Mahasiswa',
            'mahasiswa' => $m,
        ]);
    }

    public function edit($id)
    {
        $id = (int)$id;
        $m = $this->mahasiswaModel->getById($id);
        if (!$m) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Mahasiswa tidak ditemukan');
        }

        return view('admin/mahasiswa/edit', [
            'title' => 'Edit Mahasiswa',
            'mahasiswa' => $m,
            'validation' => \Config\Services::validation(),
        ]);
    }

    public function update($id)
    {
        $id = (int)$id;
        $m = $this->mahasiswaModel->find($id);
        if (!$m) {
            return redirect()->back()->with('error', 'Mahasiswa tidak ditemukan');
        }

        $rules = [
            'nim' => 'required|alpha_numeric_space|min_length[3]|max_length[50]',
            'nama_mahasiswa' => 'required|min_length[3]|max_length[191]',
            'email' => 'permit_empty|valid_email|max_length[191]',
            'semester' => 'permit_empty|integer',
        ];

        // jika nim berubah, cek unique
        $nimInput = $this->request->getPost('nim');
        if ($nimInput && $nimInput !== $m['nim']) {
            $rules['nim'] .= '|is_unique[t_mahasiswa.nim]';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $update = [
            'nim' => $this->request->getPost('nim'),
            'nama_mahasiswa' => $this->request->getPost('nama_mahasiswa'),
            'email' => $this->request->getPost('email'),
            'semester' => $this->request->getPost('semester'),
            'id_prodi' => $this->request->getPost('id_prodi') ?: null,
        ];

        // password opsional
        $pw = $this->request->getPost('password');
        if (!empty($pw)) {
            $update['password'] = password_hash($pw, PASSWORD_DEFAULT);
        }

        $this->mahasiswaModel->update($id, $update);

        return redirect()->to(base_url('admin/mahasiswa'))->with('success', 'Data mahasiswa berhasil diperbarui.');
    }

    public function create()
{
    return view('admin/mahasiswa/create', [
        'title' => 'Tambah Mahasiswa',
        'validation' => \Config\Services::validation(),
    ]);
}

public function store()
{
    $rules = [
        'nim' => 'required|alpha_numeric_space|min_length[3]|max_length[50]|is_unique[t_mahasiswa.nim]',
        'nama_mahasiswa' => 'required|min_length[3]|max_length[191]',
        'email' => 'required|valid_email|max_length[191]|is_unique[t_mahasiswa.email]',
        'password' => 'required|min_length[6]|max_length[100]',
        'semester' => 'permit_empty|integer',
        'tahun_masuk' => 'permit_empty|integer|exact_length[4]',
    ];

    if (!$this->validate($rules)) {
        return redirect()->back()->withInput()->with('validation', $this->validator);
    }

    $data = [
        'nim' => $this->request->getPost('nim'),
        'nama_mahasiswa' => $this->request->getPost('nama_mahasiswa'),
        'email' => $this->request->getPost('email'),
        'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        'semester' => $this->request->getPost('semester'),
        'tahun_masuk' => $this->request->getPost('tahun_masuk'),
        'id_prodi' => $this->request->getPost('id_prodi') ?: null,
        'status' => 'Aktif',
    ];

    $this->mahasiswaModel->insert($data);

    return redirect()->to(base_url('admin/mahasiswa'))->with('success', 'Mahasiswa berhasil ditambahkan.');
}

}
