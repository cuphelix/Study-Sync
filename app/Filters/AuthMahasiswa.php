<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthMahasiswa implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Ambil URI saat ini
        $uri = $request->getUri()->getPath();

        // Jangan cek auth jika sedang di halaman login mahasiswa
        if (strpos($uri, 'mahasiswa/login') !== false) {
            return;
        }

        // Cek apakah mahasiswa sudah login
        if (!session()->get('logged_in_mahasiswa')) {
            // Jika belum login, redirect ke halaman login mahasiswa
            session()->setFlashdata('error', 'Silakan login terlebih dahulu!');
            return redirect()->to('/mahasiswa/login');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak ada yang perlu dilakukan setelah request
    }
}
