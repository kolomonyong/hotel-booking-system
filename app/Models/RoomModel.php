<?php
// app/Models/RoomModel.php
namespace App\Models;

use CodeIgniter\Model;

class RoomModel extends Model
{
    protected $table = 'kamar';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'tipe_kamar',
        'harga',
        'deskripsi',
        'jumlah_kamar',
        'gambar'
    ];

    protected $useTimestamps = false;

    public function getRooms()
    {
        return $this->findAll();
    }

    public function getRoom($id = null)
    {
        if ($id === null) {
            return $this->findAll();
        }

        return $this->find($id);
    }

    public function createRoom($data)
    {
        return $this->insert($data);
    }

    public function updateRoom($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteRoom($id)
    {
        return $this->delete($id);
    }
}
