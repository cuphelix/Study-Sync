<?php

namespace App\Models\admin;

use CodeIgniter\Model;

class DosenModel extends Model
{
    protected $table      = 't_dosen';
    protected $primaryKey = 'id_dosen';

    protected $allowedFields = [
        'nama_dosen',
        'nip',
        'nidn',
        'email',
        'password',
        'no_wa',
        'id_prodi',
        'jabatan_fungsional',
        'pendidikan_terakhir',
        'bidang_keahlian',
        'jam_kantor',
        'tanggal_mulai',
        'foto',
    ];

    /**
     * Ambil list dosen beserta statistik:
     * - total_mk      : jumlah mata kuliah yang diampu (t_matakuliah.id_matakuliah)
     * - total_kelas   : jumlah kelas unik yang dihubungkan di t_matakuliah.id_kelas
     * - total_jadwal  : jumlah jadwal pada jadwal_kuliah untuk dosen tersebut (id_jadwal)
     *
     * $keyword = pencarian (nip, nama, email)
     */
    public function getDosenWithStats(?string $keyword = null): array
    {
        $db = db_connect();
        $builder = $db->table('t_dosen');

        $builder->select([
            't_dosen.id_dosen',
            't_dosen.nama_dosen',
            't_dosen.nip',
            't_dosen.email',
            't_dosen.no_wa',
            // agregasi
            'COUNT(DISTINCT t_matakuliah.id_matakuliah) AS total_mk',
            'COUNT(DISTINCT t_matakuliah.id_kelas)      AS total_kelas',
            'COUNT(DISTINCT jadwal_kuliah.id_jadwal)    AS total_jadwal',
        ])
            ->join('t_matakuliah', 't_matakuliah.id_dosen = t_dosen.id_dosen', 'left')
            ->join('jadwal_kuliah', 'jadwal_kuliah.id_dosen = t_dosen.id_dosen', 'left')
            ->groupBy('t_dosen.id_dosen')
            ->orderBy('t_dosen.nama_dosen', 'ASC');

        if (!empty($keyword)) {
            $builder->groupStart()
                ->like('t_dosen.nip', $keyword)
                ->orLike('t_dosen.nama_dosen', $keyword)
                ->orLike('t_dosen.email', $keyword)
                ->groupEnd();
        }

        $rows = $builder->get()->getResultArray();

        // cast agar tidak null
        foreach ($rows as &$r) {
            $r['total_mk']     = isset($r['total_mk']) ? (int)$r['total_mk'] : 0;
            $r['total_kelas']  = isset($r['total_kelas']) ? (int)$r['total_kelas'] : 0;
            $r['total_jadwal'] = isset($r['total_jadwal']) ? (int)$r['total_jadwal'] : 0;
        }

        return $rows;
    }

    public function getTotalDosen(): int
    {
        $db = db_connect();
        return (int) $db->table($this->table)->countAllResults();
    }

    public function getTotalDosenAktif(): int
    {
        // Kalau kolom status ada (misal `status`), sesuaikan kondisinya.
        // Saat ini belum ada kolom status => kembalikan total dosen.
        return $this->getTotalDosen();
    }
}
