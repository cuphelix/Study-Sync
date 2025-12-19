<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// ================= HOME =================
$routes->get('/', 'AuthController::index');

// ================= AUTH =================
$routes->get('login', 'AuthController::index');

// Login Admin
$routes->get('admin/login',  'AuthController::loginAdmin');
$routes->post('admin/login', 'AuthController::loginAdminProcess');

// Login Mahasiswa
$routes->get('mahasiswa/login',  'AuthController::loginMahasiswa');
$routes->post('mahasiswa/login', 'AuthController::loginMahasiswaProcess');

// Login Dosen - TAMBAHAN BARU
$routes->get('dosen/login',  'AuthController::loginDosen');
$routes->post('dosen/login', 'AuthController::loginDosenProcess');

// Logout
$routes->get('logout', 'AuthController::logout');

// ================= MAHASISWA ROUTES (WAJIB LOGIN) =================
$routes->group('mahasiswa', ['filter' => 'authMahasiswa'], function ($routes) {
    $routes->get('dashboard', 'Mahasiswa::dashboard');
    $routes->get('profil', 'Mahasiswa::profil');
    $routes->post('update-profil', 'Mahasiswa::updateProfil');
    $routes->get('matakuliah', 'Mahasiswa::matakuliah');
    $routes->get('getMatakuliahDetail/(:num)', 'Mahasiswa::getMatakuliahDetail/$1');
    $routes->get('jadwal', 'Mahasiswa::jadwal');
    $routes->get('pengingat', 'Mahasiswa::pengingat');
    $routes->post('simpan-pengingat', 'Mahasiswa::simpanPengingat');
    $routes->get('hapus-pengingat/(:num)', 'Mahasiswa::hapusPengingat/$1');
    $routes->get('kalender', 'Mahasiswa::kalender');
});

// ================= DOSEN ROUTES (WAJIB LOGIN) =================
$routes->group('dosen', ['namespace' => 'App\Controllers\Dosen', 'filter' => 'authDosen'], function ($routes) {

    // Dashboard
    $routes->get('', 'Dashboard::index'); // /dosen
    $routes->get('dashboard', 'Dashboard::index'); // /dosen/dashboard

    // Jadwal Mengajar
    $routes->get('jadwal', 'JadwalMengajar::index');

    // Mahasiswa
    $routes->get('mahasiswa', 'Mahasiswa::index');

    // Mata Kuliah Diajar
    $routes->get('matakuliah', 'MataKuliahDiajar::index');

    // Pengingat
    $routes->get('pengingat', 'Pengingat::index');
    $routes->post('pengingat/simpan', 'Pengingat::simpan');
    $routes->get('pengingat/hapus/(:num)', 'Pengingat::hapus/$1');

    // Profile
    $routes->get('profil', 'Profile::index');
    $routes->post('profil/update', 'Profile::update');
});

// ================= ADMIN (WAJIB LOGIN) =================
$routes->group('admin', ['namespace' => 'App\Controllers\Admin', 'filter' => 'authAdmin'], function (RouteCollection $routes) {
    $routes->get('', 'Dashboard::index');
    $routes->get('dashboard', 'Dashboard::index');

    $routes->get('mahasiswa', 'Mahasiswa::index');
    $routes->get('mahasiswa/(:num)', 'Mahasiswa::show/$1');
    $routes->get('mahasiswa/edit/(:num)', 'Mahasiswa::edit/$1');
    $routes->post('mahasiswa/update/(:num)', 'Mahasiswa::update/$1');

    $routes->get('dosen', 'Dosen::index');
    $routes->get('dosen/(:num)', 'Dosen::show/$1');
    $routes->get('dosen/edit/(:num)', 'Dosen::edit/$1');
    $routes->post('dosen/update/(:num)', 'Dosen::update/$1');

    $routes->get('matakuliah', 'Matakuliah::index');
    $routes->get('matakuliah/(:num)', 'Matakuliah::show/$1');
    $routes->get('matakuliah/edit/(:num)', 'Matakuliah::edit/$1');
    $routes->post('matakuliah/update/(:num)', 'Matakuliah::update/$1');

    $routes->get('ruangan', 'Ruangan::index');
    $routes->get('ruangan/(:num)', 'Ruangan::show/$1');
    $routes->get('ruangan/edit/(:num)', 'Ruangan::edit/$1');
    $routes->post('ruangan/update/(:num)', 'Ruangan::update/$1');

    $routes->get('jadwal', 'Jadwal::index');
    $routes->get('jadwal/(:num)', 'Jadwal::show/$1');
    $routes->get('jadwal/edit/(:num)', 'Jadwal::edit/$1');
    $routes->post('jadwal/update/(:num)', 'Jadwal::update/$1');

    $routes->get('kalender', 'KalenderAkademik::index');
    $routes->get('kalender/tabel', 'KalenderAkademik::tabel');
    $routes->get('kalender/create', 'KalenderAkademik::create');
    $routes->post('kalender/store', 'KalenderAkademik::store');
    $routes->get('kalender/edit/(:num)', 'KalenderAkademik::edit/$1');
    $routes->post('kalender/update/(:num)', 'KalenderAkademik::update/$1');
    $routes->get('kalender/delete/(:num)', 'KalenderAkademik::delete/$1');
});
