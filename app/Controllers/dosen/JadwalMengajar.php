<?php

namespace App\Controllers\Dosen;

use App\Controllers\BaseController;

class JadwalMengajar extends BaseController
{
    public function index()
    {
        return view('dosen/jadwal_mengajar');
    }
}
