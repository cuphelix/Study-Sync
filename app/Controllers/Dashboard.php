<?php

namespace App\Controllers;

use App\Models\JadwalKuliahModel;
use App\Models\MahasiswaModel;
use App\Models\PengingatModel;

class Dashboard extends BaseController
{
    protected $jadwalModel;
    protected $mahasiswaModel;
    protected $pengingatModel;

    public function __construct()
    {
        $this->jadwalModel = new JadwalKuliahModel();
        $this->mahasiswaModel = new MahasiswaModel();
        $this->pengingatModel = new PengingatModel();
    }

    public function index()
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

        // GANTI PATH VIEW KE FOLDER MAHASISWA
        return view('mahasiswa/dashboard', $data);
    }

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
