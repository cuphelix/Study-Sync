<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\admin\DashboardModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $model = new DashboardModel();
        $logModel = new \App\Models\admin\LogAktivitasModel();

        $cards       = $model->getSummaryCards();
        $semester    = $model->getActiveSemesterInfo();
        $activities  = $model->getRecentActivities();
        $upcomingExam = $model->getUpcomingExamCount();
        
        // Ambil last sync dari log aktivitas terakhir
        $lastActivity = $logModel->orderBy('created_at', 'DESC')->first();
        $lastSync = $lastActivity ? $lastActivity['created_at'] : date('Y-m-d H:i:s');

        $data = [
            'title'         => 'Dashboard Admin | StudySync',
            'pageTitle'     => 'Dashboard Admin',
            'today'         => date('l, j F Y'),
            'cards'         => $cards,
            'semester'      => $semester,
            'activities'    => $activities,
            'upcoming_exam' => $upcomingExam,
            'lastSync'      => $lastSync,
        ];

        return view('admin/dashboard', $data);
    }
}
