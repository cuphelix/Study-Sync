<?php

namespace App\Models;

use CodeIgniter\Model;

class PengingatModel extends Model
{
    protected $table = 'pengingat';
    protected $primaryKey = 'id_pengingat';
    protected $allowedFields = [
        'id_user',
        'judul',
        'deskripsi',
        'tanggal',
        'waktu',
        'id_kalender',
        'aktif'
    ];

    protected $validationRules = [
        'judul'     => 'required|min_length[3]|max_length[100]',
        'deskripsi' => 'permit_empty|string',
        'tanggal'   => 'required|valid_date',
        'waktu'     => 'required',
        'aktif'     => 'permit_empty|in_list[0,1]'
    ];

    protected $validationMessages = [
        'judul' => [
            'required' => 'Judul pengingat wajib diisi.'
        ],
        'tanggal' => [
            'required' => 'Tanggal wajib diisi.'
        ],
        'waktu' => [
            'required' => 'Waktu wajib diisi.'
        ]
    ];

    public function getPengingatAktif($id_mahasiswa)
    {
        return $this->where('id_user', $id_mahasiswa)
            ->where('aktif', 1)
            ->orderBy('tanggal', 'ASC')
            ->orderBy('waktu', 'ASC')
            ->findAll();
    }
}
