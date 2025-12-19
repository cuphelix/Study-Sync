<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\admin\KalenderAkademikModel;

class KalenderAkademik extends BaseController
{
    protected $kalenderModel;

    public function __construct()
    {
        $this->kalenderModel = new KalenderAkademikModel();
    }

    // ======= VIEW KALENDER =======
    public function index()
    {
        $month = (int) ($this->request->getGet('month') ?? date('m'));
        $year  = (int) ($this->request->getGet('year') ?? date('Y'));

        // data event bulan ini
        $events = $this->kalenderModel->getEventsByMonth($year, $month);

        // kelompokkan per tanggal
        $eventsByDate = [];
        foreach ($events as $event) {
            $start = $event['tanggal_mulai'];
            $end   = $event['tanggal_selesai'];

            $current = strtotime($start);
            $last    = strtotime($end);

            while ($current <= $last) {
                $dateKey = date('Y-m-d', $current);
                $eventsByDate[$dateKey][] = $event;
                $current = strtotime('+1 day', $current);
            }
        }

        // info kalender bulan
        $firstDay      = strtotime("$year-$month-01");
        $daysInMonth   = (int) date('t', $firstDay);
        $startWeekDay  = (int) date('w', $firstDay); // 0=Sunday,6=Saturday

        // untuk navigasi bulan
        $prevMonth = $month - 1;
        $prevYear  = $year;
        $nextMonth = $month + 1;
        $nextYear  = $year;

        if ($prevMonth < 1) {
            $prevMonth = 12;
            $prevYear--;
        }
        if ($nextMonth > 12) {
            $nextMonth = 1;
            $nextYear++;
        }

        $upcomingEvents = $this->kalenderModel->getUpcomingEvents(5);

        $data = [
            'title'          => 'Manajemen Kalender Akademik | StudySync',
            'pageTitle'      => 'Manajemen Kalender Akademik',
            'month'          => $month,
            'year'           => $year,
            'daysInMonth'    => $daysInMonth,
            'startWeekDay'   => $startWeekDay,
            'eventsByDate'   => $eventsByDate,
            'upcomingEvents' => $upcomingEvents,
            'prevMonth'      => $prevMonth,
            'prevYear'       => $prevYear,
            'nextMonth'      => $nextMonth,
            'nextYear'       => $nextYear,
        ];

        return view('admin/kalender/index', $data);
    }

    // ======= VIEW TABEL =======
    public function tabel()
    {
        $events = $this->kalenderModel->orderBy('tanggal_mulai', 'DESC')->findAll();

        $data = [
            'title'     => 'Tabel Kalender Akademik | StudySync',
            'pageTitle' => 'Manajemen Kalender Akademik',
            'events'    => $events,
        ];

        return view('admin/kalender/tabel', $data);
    }

    // ======= FORM TAMBAH =======
    public function create()
    {
        $data = [
            'title'     => 'Tambah Kegiatan Akademik | StudySync',
            'pageTitle' => 'Tambah Kegiatan',
            'event'     => null,
            'action'    => base_url('admin/kalender/store'),
        ];

        return view('admin/kalender/form', $data);
    }

    // ======= SIMPAN BARU =======
    public function store()
    {
        $data = $this->request->getPost();

        // kalau pilih "+ Tambah Semester Baru…", pakai semester_new
        $semester = ($data['semester'] === '__new__')
            ? ($data['semester_new'] ?? null)
            : ($data['semester'] ?? null);

        $this->kalenderModel->insert([
            'nama_kegiatan'   => $data['nama_kegiatan'],
            'tanggal_mulai'   => $data['tanggal_mulai'],
            'tanggal_selesai' => $data['tanggal_selesai'],
            'deskripsi'       => $data['deskripsi'] ?? null,
            'tipe_event'      => $data['tipe_event'] ?? null,
            'semester'        => $semester,
        ]);

        return redirect()->to(base_url('admin/kalender'))
            ->with('success', 'Kegiatan berhasil ditambahkan.');
    }

    // ======= FORM EDIT =======
    public function edit($id)
    {
        $event = $this->kalenderModel->find($id);

        if (! $event) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Kegiatan tidak ditemukan');
        }

        $data = [
            'title'     => 'Edit Kegiatan Akademik | StudySync',
            'pageTitle' => 'Edit Kegiatan',
            'event'     => $event,
            'action'    => base_url('admin/kalender/update/' . $id),
        ];

        return view('admin/kalender/form', $data);
    }

    // ======= UPDATE DATA =======
    public function update($id)
    {
        $data = $this->request->getPost();

        $semester = ($data['semester'] === '__new__')
            ? ($data['semester_new'] ?? null)
            : ($data['semester'] ?? null);

        $this->kalenderModel->update($id, [
            'nama_kegiatan'   => $data['nama_kegiatan'],
            'tanggal_mulai'   => $data['tanggal_mulai'],
            'tanggal_selesai' => $data['tanggal_selesai'],
            'deskripsi'       => $data['deskripsi'] ?? null,
            'tipe_event'      => $data['tipe_event'] ?? null,
            'semester'        => $semester,
        ]);

        return redirect()->to(base_url('admin/kalender'))
            ->with('success', 'Kegiatan berhasil diperbarui.');
    }

    // ======= HAPUS DATA =======
    public function delete($id)
    {
        $this->kalenderModel->delete($id);

        return redirect()->to(base_url('admin/kalender'))
            ->with('success', 'Kegiatan berhasil dihapus.');
    }
}
