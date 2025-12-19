<?php

namespace App\Controllers;

use App\Models\Admin\AdminModel;
use App\Models\MahasiswaModel;

class AuthController extends BaseController
{
    // ================= HALAMAN PILIHAN LOGIN =================
    public function index()
    {
        // Cek apakah sudah login
        if (session()->get('logged_in_admin')) {
            return redirect()->to('/admin/dashboard');
        }
        if (session()->get('logged_in_mahasiswa')) {
            return redirect()->to('/mahasiswa/dashboard');
        }

        return view('auth/login_pilihan');
    }

    // ================= LOGIN ADMIN =================
    public function loginAdmin()
    {
        // Jika sudah login sebagai admin, redirect ke dashboard admin
        if (session()->get('logged_in_admin')) {
            return redirect()->to('/admin/dashboard');
        }

        // Jika sudah login sebagai mahasiswa, logout dulu
        if (session()->get('logged_in_mahasiswa')) {
            session()->destroy();
        }

        return view('auth/login_admin');
    }

    public function loginAdminProcess()
    {
        $email = $this->request->getPost('username'); // input field nama 'username' tapi isinya email
        $password = $this->request->getPost('password');

        $adminModel = new AdminModel();

        // Cari admin berdasarkan email
        $admin = $adminModel->where('email', $email)->first();

        if (!$admin) {
            return redirect()->back()->with('error', 'Email tidak ditemukan!')->withInput();
        }

        // Cek password - semua password di database adalah 'admin123' (plain text)
        if ($admin['password'] === $password) {
            // Set session admin
            session()->set([
                'logged_in_admin' => true,
                'id_admin' => $admin['id_admin'],
                'admin_id' => $admin['id_admin'],
                'admin_nama' => $admin['nama_admin'],
                'admin_email' => $admin['email'],
                'admin_no_wa' => $admin['no_wa'] ?? '',
                'admin_prodi' => $admin['id_prodi'] ?? '',
                'role' => 'admin'
            ]);

            return redirect()->to('/admin/dashboard')->with('success', 'Login berhasil!');
        }

        return redirect()->back()->with('error', 'Password salah!')->withInput();
    }

    // ================= LOGIN MAHASISWA =================
    public function loginMahasiswa()
    {
        // Jika sudah login sebagai mahasiswa, redirect ke dashboard mahasiswa
        if (session()->get('logged_in_mahasiswa')) {
            return redirect()->to('/mahasiswa/dashboard');
        }

        // Jika sudah login sebagai admin, logout dulu
        if (session()->get('logged_in_admin')) {
            session()->destroy();
        }

        return view('auth/login_mahasiswa');
    }

    public function loginMahasiswaProcess()
    {
        $nim = $this->request->getPost('nim');
        $password = $this->request->getPost('password');

        $mahasiswaModel = new MahasiswaModel();

        // Cari mahasiswa berdasarkan NIM - gunakan method yang sudah ada
        $mahasiswa = $mahasiswaModel->getMahasiswaByNim($nim);

        if (!$mahasiswa) {
            return redirect()->back()->with('error', 'NIM tidak ditemukan!')->withInput();
        }

        // Cek password - semua password di database adalah 'mhs123' (plain text)
        if ($mahasiswa['password'] === $password) {
            // Set session mahasiswa - SESUAIKAN dengan controller yang sudah ada
            session()->set([
                'logged_in_mahasiswa' => true,
                'id_mahasiswa' => $mahasiswa['id_mahasiswa'],  // ← key session yang benar
                'mahasiswa_id' => $mahasiswa['id_mahasiswa'],
                'mahasiswa_nim' => $mahasiswa['nim'],
                'mahasiswa_nama' => $mahasiswa['nama_mahasiswa'],
                'mahasiswa_email' => $mahasiswa['email'],
                'mahasiswa_tahun_masuk' => $mahasiswa['tahun_masuk'] ?? '',
                'mahasiswa_semester' => $mahasiswa['semester'] ?? '',
                'mahasiswa_prodi' => $mahasiswa['id_prodi'] ?? '',
                'role' => 'mahasiswa'
            ]);

            return redirect()->to('/mahasiswa/dashboard')->with('success', 'Login berhasil!');
        }

        return redirect()->back()->with('error', 'Password salah!')->withInput();
    }

    // ================= LOGOUT =================
    public function logout()
    {
        // Hapus semua session
        session()->destroy();

        return redirect()->to('/login')->with('success', 'Logout berhasil!');
    }

    public function loginDosen()
    {
        if (session()->get('logged_in_dosen')) {
            return redirect()->to('/dosen/dashboard');
        }

        if (session()->get('logged_in_admin')) {
            session()->destroy();
        }

        if (session()->get('logged_in_mahasiswa')) {
            session()->destroy();
        }

        return view('auth/login_dosen');
    }

    public function loginDosenProcess()
    {
        $nip = $this->request->getPost('nip');
        $password = $this->request->getPost('password');

        $dosenModel = new \App\Models\Admin\DosenModel();

        $dosen = $dosenModel->where('nip', $nip)->first();

        if (!$dosen) {
            return redirect()->back()->with('error', 'NIP tidak ditemukan!')->withInput();
        }

        // Cek password - sesuaikan dengan sistem kamu
        if ($dosen['password'] === $password) {
            session()->set([
                'logged_in_dosen' => true,
                'id_dosen' => $dosen['id_dosen'],
                'dosen_nip' => $dosen['nip'],
                'dosen_nama' => $dosen['nama_dosen'],
                'dosen_email' => $dosen['email'],
                'role' => 'dosen'
            ]);

            return redirect()->to('/dosen/dashboard')->with('success', 'Login berhasil!');
        }

        return redirect()->back()->with('error', 'Password salah!')->withInput();
    }
}
