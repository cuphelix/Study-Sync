<?php

namespace App\Models;

use CodeIgniter\Model;

class FileMateriModel extends Model
{
    protected $table = 't_file_materi_dan_ebook';
    protected $primaryKey = 'id_file';
    protected $allowedFields = [
        'judul_file',
        'deskripsi',
        'file_path',
        'tipe_file',
        'tanggal_upload',
        'id_dosen',
        'id_matakuliah'
    ];

    public function getFileByMatakuliah($id_matakuliah)
    {
        return $this->select('
                t_file_materi_dan_ebook.*,
                t_dosen.nama_dosen,
                t_matakuliah.nama_matakuliah
            ')
            ->join('t_dosen', 't_dosen.id_dosen = t_file_materi_dan_ebook.id_dosen', 'left')
            ->join('t_matakuliah', 't_matakuliah.id_matakuliah = t_file_materi_dan_ebook.id_matakuliah', 'left')
            ->where('t_file_materi_dan_ebook.id_matakuliah', $id_matakuliah)
            ->orderBy('t_file_materi_dan_ebook.tanggal_upload', 'DESC')
            ->findAll();
    }

    public function getFileByDosen($id_dosen)
    {
        return $this->select('
                t_file_materi_dan_ebook.*,
                t_matakuliah.nama_matakuliah,
                t_matakuliah.kode_matakuliah
            ')
            ->join('t_matakuliah', 't_matakuliah.id_matakuliah = t_file_materi_dan_ebook.id_matakuliah', 'left')
            ->where('t_file_materi_dan_ebook.id_dosen', $id_dosen)
            ->orderBy('t_file_materi_dan_ebook.tanggal_upload', 'DESC')
            ->findAll();
    }

    public function getFileByMahasiswa($id_mahasiswa)
    {
        return $this->select('
                t_file_materi_dan_ebook.*,
                t_matakuliah.nama_matakuliah,
                t_matakuliah.kode_matakuliah,
                t_dosen.nama_dosen
            ')
            ->join('t_matakuliah', 't_matakuliah.id_matakuliah = t_file_materi_dan_ebook.id_matakuliah', 'left')
            ->join('t_dosen', 't_dosen.id_dosen = t_file_materi_dan_ebook.id_dosen', 'left')
            ->join('jadwal_kuliah', 'jadwal_kuliah.id_mk = t_file_materi_dan_ebook.id_matakuliah', 'left')
            ->where('jadwal_kuliah.id_mahasiswa', $id_mahasiswa)
            ->groupBy('t_file_materi_dan_ebook.id_file')
            ->orderBy('t_file_materi_dan_ebook.tanggal_upload', 'DESC')
            ->findAll();
    }
}

