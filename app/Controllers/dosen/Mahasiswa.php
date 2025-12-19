<?php

namespace App\Controllers\Dosen;

use App\Controllers\BaseController;

class Mahasiswa extends BaseController
{
    public function index()
    {
        return view('dosen/mahasiswa', [
            'title' => 'Mahasiswa'
        ]);
    }
}
