<?php

namespace App\Controllers\Dosen;

use App\Controllers\BaseController;
use App\Models\dosen\PengingatModel;

class Pengingat extends BaseController
{
    protected $pengingatModel;

    public function __construct()
    {
        $this->pengingatModel = new PengingatModel();
    }

    public function index()
    {
        if (!session()->get('logged_in_dosen')) {
            return redirect()->to('/login/dosen');
        }

        $idDosen = session()->get('id_dosen');

        // Ambil semua pengingat dosen
        $pengingat = $this->pengingatModel->getByDosen($idDosen);
        
        // Hitung statistik
        $totalPengingat = count($pengingat);
        
        // Hitung pengingat mendatang menggunakan method model
        $upcoming = count($this->pengingatModel->getUpcoming($idDosen));
        
        // Hitung pengingat prioritas tinggi
        $urgent = count($this->pengingatModel->getByPrioritas($idDosen, 'Tinggi'));

        $data = [
            'title' => 'Pengingat',
            'pengingat' => $pengingat,
            'totalPengingat' => $totalPengingat,
            'upcoming' => $upcoming,
            'urgent' => $urgent
        ];

        return view('dosen/pengingat', $data);
    }
}
