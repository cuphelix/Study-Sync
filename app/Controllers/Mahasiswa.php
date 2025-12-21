<?php

namespace App\Controllers;

use App\Models\MahasiswaModel;
use App\Models\JadwalKuliahModel;
use App\Models\PengingatModel;
use App\Models\MatakuliahModel;
use App\Models\KalenderAkademikModel;

class Mahasiswa extends BaseController
{
    protected $mahasiswaModel;
    protected $jadwalModel;
    protected $pengingatModel;
    protected $matakuliahModel;
    protected $kalenderModel;

    public function __construct()
    {
        $this->mahasiswaModel = new MahasiswaModel();
        $this->jadwalModel = new JadwalKuliahModel();
        $this->pengingatModel = new PengingatModel();
        $this->matakuliahModel = new MatakuliahModel();
        $this->kalenderModel = new KalenderAkademikModel();
    }

    // ==================== DASHBOARD ====================
    public function dashboard()
    {
        $id_mahasiswa = session()->get('id_mahasiswa') ?? 1;

        $data['mahasiswa'] = $this->mahasiswaModel->getMahasiswaDetail($id_mahasiswa);
        $data['today'] = date('l, d F Y');
        $data['hari_ini'] = $this->getHariIndonesia(date('l'));
        $data['jadwal_hari_ini'] = $this->jadwalModel->getJadwalHariIni($data['hari_ini'], $id_mahasiswa);
        $data['total_kelas_hari_ini'] = count($data['jadwal_hari_ini']);
        $data['total_sks'] = 21;
        $data['pengingat_aktif'] = $this->pengingatModel->getPengingatAktif($id_mahasiswa);
        $data['total_pengingat'] = count($data['pengingat_aktif']);

        return view('mahasiswa/dashboard', $data);
    }

    // ==================== PROFIL ====================
    public function profil()
    {
        $id_mahasiswa = session()->get('id_mahasiswa') ?? 1;

        $data['mahasiswa'] = $this->mahasiswaModel->getMahasiswaDetail($id_mahasiswa);

        if (!$data['mahasiswa']) {
            return redirect()->to('/')->with('error', 'Data mahasiswa tidak ditemukan');
        }

        $data['ipk'] = 4.00;
        $data['total_sks'] = 54;
        $data['target_sks'] = 110;
        $data['progress_sks'] = round(($data['total_sks'] / $data['target_sks']) * 100);

        $data['riwayat_akademik'] = [
            ['semester' => 'Semester 1', 'ipk' => '4.00', 'status' => 'Lulus'],
            ['semester' => 'Semester 2', 'ipk' => '4.00', 'status' => 'Lulus'],
            ['semester' => 'Semester 3', 'ipk' => '4.00', 'status' => 'Lulus']
        ];

        return view('mahasiswa/profil', $data);
    }

    // ==================== MATA KULIAH ====================
    public function matakuliah()
    {
        $id_mahasiswa = session()->get('id_mahasiswa') ?? 1;

        $data['matakuliah'] = $this->matakuliahModel->getMatakuliahByMahasiswa($id_mahasiswa);

        $data['total_sks'] = 0;
        foreach ($data['matakuliah'] as $mk) {
            $data['total_sks'] += isset($mk->sks) ? (int)$mk->sks : 3;
        }

        return view('mahasiswa/matakuliah', $data);
    }

    public function getMatakuliahDetail($id_matakuliah)
    {
        $matakuliah = $this->matakuliahModel->getMatakuliahDetailWithJadwal($id_matakuliah);

        if (!$matakuliah) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Mata kuliah tidak ditemukan'
            ]);
        }

        return $this->response->setJSON([
            'success' => true,
            'data' => $matakuliah
        ]);
    }

    // ==================== JADWAL KULIAH ====================
    public function jadwal()
    {
        $id_mahasiswa = session()->get('id_mahasiswa') ?? 1;

        $data['jadwal'] = $this->jadwalModel->getJadwalWithDetails($id_mahasiswa);
        $data['title'] = 'Jadwal Kuliah';

        return view('mahasiswa/jadwal', $data);
    }

    // ==================== PENGINGAT ====================
    public function pengingat()
    {
        $id_mahasiswa = session()->get('id_mahasiswa') ?? 1;

        $data['pengingat'] = $this->pengingatModel->getPengingatAktif($id_mahasiswa);
        $data['title'] = 'Pengingat';

        return view('mahasiswa/pengingat', $data);
    }

    public function simpanPengingat()
    {
        $id_mahasiswa = session()->get('id_mahasiswa') ?? 1;

        $data = [
            'id_user'   => $id_mahasiswa,
            'judul'     => $this->request->getPost('judul'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'tanggal'   => $this->request->getPost('tanggal'),
            'waktu'     => $this->request->getPost('waktu'),
            'aktif'     => 1
        ];

        if ($this->pengingatModel->save($data)) {
            return redirect()->to('/mahasiswa/pengingat')->with('success', 'Pengingat berhasil ditambahkan');
        }

        return redirect()->back()->with('error', 'Gagal menambahkan pengingat');
    }

    public function hapusPengingat($id)
    {
        if ($this->pengingatModel->delete($id)) {
            return redirect()->to('/mahasiswa/pengingat')->with('success', 'Pengingat berhasil dihapus');
        }

        return redirect()->back()->with('error', 'Gagal menghapus pengingat');
    }

    // ==================== KALENDER AKADEMIK ====================
    public function kalender()
    {
        helper('date');

        $year  = $this->request->getGet('year') ?? date('Y');
        $month = $this->request->getGet('month') ?? date('m');

        // Ambil event yang masuk rentang bulan
        $data['events'] = $this->kalenderModel
            ->where("tanggal_mulai <=", "$year-$month-31")
            ->where("tanggal_selesai >=", "$year-$month-01")
            ->findAll();

        // PERBAIKAN: Event Mendatang (termasuk yang sedang berlangsung)
        // Ambil event yang tanggal selesainya >= hari ini
        $data['upcoming'] = $this->kalenderModel
            ->where('tanggal_selesai >=', date('Y-m-d'))
            ->orderBy('tanggal_mulai', 'ASC')
            ->limit(10)
            ->findAll();

        $data['title'] = 'Kalender Akademik';
        $data['year'] = $year;
        $data['month'] = $month;

        return view('mahasiswa/kalender', $data);
    }

    // ==================== HELPER ====================
    private function getHariIndonesia($day)
    {
        $days = [
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu',
            'Sunday' => 'Minggu'
        ];
        return $days[$day] ?? 'Senin';
    }
}