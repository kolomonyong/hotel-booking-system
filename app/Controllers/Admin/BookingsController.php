<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BookingModel;

class BookingsController extends BaseController
{
    protected $bookingModel;

    public function __construct()
    {
        $this->bookingModel = new BookingModel();
    }

    public function index()
    {
        $data = [
            'booking' => $this->bookingModel->getAllBookings(),
            'page_title' => 'Booking Management'
        ];

        return view('admin/booking_list', $data);
    }

    public function detail($id)
    {
        $booking = $this->bookingModel->getBookingById($id);

        if (!$booking) {
            return redirect()->to('/admin/bookings')->with('error', 'Booking not found');
        }

        $data = [
            'booking' => $booking,
            'page_title' => 'Booking Details'
        ];

        return view('admin/bookings', $data);
    }

    public function cancel($id)
    {
        $booking = $this->bookingModel->find($id);

        if (!$booking) {
            return redirect()->to('/admin/bookings')->with('error', 'Booking not found');
        }

        if ($booking['status'] === 'Cancelled') {
            return redirect()->to('/admin/bookings')->with('error', 'Booking is already cancelled');
        }

        $this->bookingModel->update($id, ['status' => 'Cancelled']);

        return redirect()->to('/admin/bookings')->with('success', 'Booking has been cancelled');
    }

    public function confirm($id)
    {
        $booking = $this->bookingModel->find($id);

        if (!$booking) {
            return redirect()->to('/admin/bookings')->with('error', 'Booking not found');
        }

        if ($booking['status'] === 'Confirmed') {
            return redirect()->to('/admin/bookings')->with('error', 'Booking is already confirmed');
        }

        $this->bookingModel->update($id, ['status' => 'Confirmed']);

        return redirect()->to('/admin/bookings')->with('success', 'Booking has been confirmed');
    }
}
