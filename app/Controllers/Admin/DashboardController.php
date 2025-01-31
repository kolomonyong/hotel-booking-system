<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BookingModel;
use App\Models\UserModel;

class DashboardController extends BaseController
{
    public function index()
    {
        $bookingModel = new BookingModel();
        $userModel = new UserModel();

        $data = [
            'total_rooms' => $bookingModel->distinct('id_kamar')->countAllResults(),
            'total_bookings' => $bookingModel->countAllResults(),
            'total_users' => $userModel->countAllResults(),
            'recent_bookings' => $bookingModel->getAllBookings(),
            'users' => $userModel->findAll(),
        ];

        return view('admin/dashboard', $data);
    }
}
