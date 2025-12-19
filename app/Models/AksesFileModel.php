<?php

namespace App\Models;

use CodeIgniter\Model;

class AksesFileModel extends Model
{
    protected $table = 't_akses_file';
    protected $primaryKey = 'id_akses';
    protected $allowedFields = [
        'id_mahasiswa',
        'id_file',
        'tanggal_akses'
    ];

    public function recordAkses($id_mahasiswa, $id_file)
    {
        $data = [
            'id_mahasiswa' => $id_mahasiswa,
            'id_file' => $id_file,
            'tanggal_akses' => date('Y-m-d H:i:s')
        ];
        return $this->insert($data);
    }

    public function getAksesByMahasiswa($id_mahasiswa)
    {
        return $this->select('
                t_akses_file.*,
                t_file_materi_dan_ebook.judul_file,
                t_file_materi_dan_ebook.file_path,
                t_file_materi_dan_ebook.tipe_file,
                t_matakuliah.nama_matakuliah
            ')
            ->join('t_file_materi_dan_ebook', 't_file_materi_dan_ebook.id_file = t_akses_file.id_file', 'left')
            ->join('t_matakuliah', 't_matakuliah.id_matakuliah = t_file_materi_dan_ebook.id_matakuliah', 'left')
            ->where('t_akses_file.id_mahasiswa', $id_mahasiswa)
            ->orderBy('t_akses_file.tanggal_akses', 'DESC')
            ->findAll();
    }

    public function getAksesByFile($id_file)
    {
        return $this->select('
                t_akses_file.*,
                t_mahasiswa.nama_mahasiswa,
                t_mahasiswa.nim
            ')
            ->join('t_mahasiswa', 't_mahasiswa.id_mahasiswa = t_akses_file.id_mahasiswa', 'left')
            ->where('t_akses_file.id_file', $id_file)
            ->orderBy('t_akses_file.tanggal_akses', 'DESC')
            ->findAll();
    }

    public function sudahDiakses($id_mahasiswa, $id_file)
    {
        return $this->where('id_mahasiswa', $id_mahasiswa)
            ->where('id_file', $id_file)
            ->first() !== null;
    }
}

