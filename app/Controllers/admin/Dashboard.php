<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\admin\DashboardModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $model = new DashboardModel();

        $cards       = $model->getSummaryCards();
        $semester    = $model->getActiveSemesterInfo();
        $activities  = $model->getRecentActivities();
        $upcomingExam = $model->getUpcomingExamCount();

        $data = [
            'title'         => 'Dashboard Admin | StudySync',
            'pageTitle'     => 'Dashboard Admin',
            'today'         => date('l, j F Y'),
            'cards'         => $cards,
            'semester'      => $semester,
            'activities'    => $activities,
            'upcoming_exam' => $upcomingExam,
        ];

        return view('admin/dashboard', $data);
    }
}
