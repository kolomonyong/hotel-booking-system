<?php

namespace App\Models;

use CodeIgniter\Model;

class BookingModel extends Model
{
    protected $table = 'booking';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id_tamu',
        'id_kamar',
        'tanggal_checkin',
        'tanggal_checkout',
        'jumlah_kamar',
        'total_harga',
        'status'
    ];

    public function getAllBookings()
    {
        return $this->select('booking.*, users.nama')
            ->join('users', 'users.id = booking.id_tamu', 'left')
            ->findAll();
    }

    public function getBookingById($id)
    {
        return $this->select('
            booking.*, 
            users.nama, 
            kamar.tipe_kamar
        ')
            ->join('users', 'booking.id_tamu = users.id', 'left')
            ->join('kamar', 'booking.id_kamar = kamar.id', 'left')
            ->where('booking.id', $id)
            ->first();
    }
    public function getBookingById2($id)
    {
        return $this->where('id', $id)->first();
    }
    public function createBooking($data)
    {
        return $this->insert($data);
    }

    public function updateStatus($id, $status)
    {
        return $this->update($id, ['status' => $status]);
    }

    public function updateBooking($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteBooking($id)
    {
        return $this->delete($id);
    }
}
