<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\BookingModel;
use App\Models\RoomModel;

class BookingController extends BaseController
{
    protected $session;
    protected $bookingModel;
    protected $roomModel;

    public function __construct()
    {
        $this->session = \Config\Services::session(); 
        $this->bookingModel = new BookingModel();    
        $this->roomModel = new RoomModel();
    }

    public function index()
    {
        $data = [
            'rooms' => $this->roomModel->findAll(),
            'page_title' => 'User Booking'
        ];

        return view('user/booking', $data);
    }

    public function store()
    {
        $user_id = $this->session->get('user_id');
        $room_id = $this->request->getPost('room_id');
        $checkin_date = $this->request->getPost('checkin_date');
        $checkout_date = $this->request->getPost('checkout_date');
        $total_price = $this->request->getPost('total_price'); 
        $num_rooms = $this->request->getPost('num_rooms');


        $data = [
            'id_tamu' => $user_id,
            'id_kamar' => $room_id,
            'tanggal_checkin' => $checkin_date,
            'tanggal_checkout' => $checkout_date,
            'total_harga' => $total_price,
            'jumlah_kamar' => $num_rooms,
            'status' => 'Cancelled' 
        ];

        $this->bookingModel->createBooking($data);

        return redirect()->to('user/payment/' . $this->bookingModel->getInsertID());
    }
}

