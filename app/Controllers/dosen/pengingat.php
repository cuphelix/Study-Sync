<?php

namespace App\Controllers\Dosen;

use App\Controllers\BaseController;

class Pengingat extends BaseController
{
    public function index()
    {
        return view('dosen/pengingat', [
            'title' => 'Pengingat'
        ]);
    }
}
