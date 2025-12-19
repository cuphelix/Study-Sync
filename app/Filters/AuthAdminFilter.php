<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthAdminFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Ambil URI saat ini
        $uri = $request->getUri()->getPath();

        // Jangan cek auth jika sedang di halaman login admin
        if (strpos($uri, 'admin/login') !== false) {
            return;
        }

        // Cek apakah admin sudah login
        if (!session()->get('logged_in_admin')) {
            // Jika belum login, redirect ke halaman login admin
            session()->setFlashdata('error', 'Silakan login sebagai admin terlebih dahulu!');
            return redirect()->to('/admin/login');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak ada yang perlu dilakukan setelah request
    }
}
