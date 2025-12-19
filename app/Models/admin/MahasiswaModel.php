<?php

namespace App\Models\admin;

use CodeIgniter\Model;

class MahasiswaModel extends Model
{
    protected $table      = 't_mahasiswa';
    protected $primaryKey = 'id_mahasiswa';

    protected $allowedFields = [
        'nim',
        'nama_mahasiswa',
        'email',
        'password',
        'tahun_masuk',
        'semester',
        'id_prodi',
    ];

    /**
     * Ambil daftar mahasiswa dengan nama program studi dan statistik sederhana.
     * - kalau ada tabel nilai kita juga mencoba hitung rata2 IPK (jika tabel ada).
     */
    public function getMahasiswaWithProdi(?string $keyword = null): array
    {
        $builder = $this->db->table('t_mahasiswa m');
        $builder->select('
            m.*,
            p.nama_prodi,
            -- jika tabel t_nilai ada dan menyimpan kolom nilai/ipk, query AVG di bawah akan bekerja,
            -- kalau tidak ada, DB akan error -> kita tangani di controller (try/catch) atau ubah nama tabel.
            AVG(n.nilai) AS ipk_estimate
        ')
            ->join('t_prodi p', 'p.id_prodi = m.id_prodi', 'left')
            ->join('t_nilai n', 'n.id_mahasiswa = m.id_mahasiswa', 'left')
            ->groupBy('m.id_mahasiswa')
            ->orderBy('m.nama_mahasiswa', 'ASC');

        if (!empty($keyword)) {
            $builder->groupStart()
                ->like('m.nim', $keyword)
                ->orLike('m.nama_mahasiswa', $keyword)
                ->orLike('m.email', $keyword)
                ->orLike('p.nama_prodi', $keyword)
                ->groupEnd();
        }

        $res = $builder->get()->getResultArray();

        // cast numeric columns
        foreach ($res as &$r) {
            $r['ipk_estimate'] = isset($r['ipk_estimate']) ? (float) number_format((float)$r['ipk_estimate'], 2, '.', '') : null;
        }

        return $res;
    }

    public function getTotalMahasiswa(): int
    {
        return (int) $this->countAllResults(false);
    }

    /**
     * Contoh: total aktif -> kita anggap 'aktif' adalah mahasiswa dengan semester > 0
     * Ubah sesuai definisi status di DB Anda.
     */
    public function getTotalMahasiswaAktif(): int
    {
        $builder = $this->db->table('t_mahasiswa')->where('semester IS NOT NULL');
        return (int) $builder->countAllResults();
    }

    /**
     * Ambil satu mahasiswa by id lengkap (sederhana)
     */
    public function getById(int $id)
    {
        $builder = $this->db->table('t_mahasiswa m')
            ->select('m.*, p.nama_prodi')
            ->join('t_prodi p', 'p.id_prodi = m.id_prodi', 'left')
            ->where('m.id_mahasiswa', $id);

        return $builder->get()->getRowArray();
    }
}
