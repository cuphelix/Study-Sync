<?php

namespace App\Controllers\dosen;

use App\Controllers\BaseController;

class Profile extends BaseController
{
    public function index()
    {
        return view('dosen/profile');
    }
}
