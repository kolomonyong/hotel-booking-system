<?php
// app/Controllers/Admin/RoomsController.php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\RoomModel;

class RoomsController extends BaseController
{
    protected $roomModel;

    public function __construct()
    {
        $this->roomModel = new RoomModel();
    }

    public function index()
    {
        $data = [
            'rooms' => $this->roomModel->getRooms(),
            'page_title' => 'Room Management'
        ];

        return view('admin/rooms', $data);
    }

    public function create()
    {
        return view('admin/add_room', ['page_title' => 'Add New Room']);
    }

    public function store()
    {
        $validationRules = [
            'tipe_kamar' => 'required',
            'harga' => 'required|numeric',
            'deskripsi' => 'required',
            'jumlah_kamar' => 'required|integer'
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $roomData = [
            'tipe_kamar' => $this->request->getPost('tipe_kamar'),
            'harga' => $this->request->getPost('harga'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'jumlah_kamar' => $this->request->getPost('jumlah_kamar')
        ];

        $this->roomModel->createRoom($roomData);

        return redirect()->to('/admin/rooms')->with('success', 'Room added successfully');
    }

    public function edit($id)
    {
        // Mengambil data kamar berdasarkan ID
        $room = $this->roomModel->find($id);

        if (!$room) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Room not found!');
        }

        return view('admin/update_room', ['page_title' => 'Edit Room', 'room' => $room]);
    }

    public function update($id)
    {
        $validationRules = [
            'tipe_kamar' => 'required',
            'harga' => 'required|numeric',
            'deskripsi' => 'required',
            'jumlah_kamar' => 'required|integer'
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Ambil data dari form
        $roomData = [
            'tipe_kamar' => $this->request->getPost('tipe_kamar'),
            'harga' => $this->request->getPost('harga'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'jumlah_kamar' => $this->request->getPost('jumlah_kamar')
        ];

        $this->roomModel->update($id, $roomData);

        return redirect()->to('/admin/rooms')->with('success', 'Room updated successfully');
    }


    public function delete($id)
    {
        $room = $this->roomModel->find($id);

        if (!$room) {
            return redirect()->to('/admin/rooms')->with('error', 'Room not found');
        }

        $this->roomModel->delete($id);

        return redirect()->to('/admin/rooms')->with('success', 'Room deleted successfully');
    }
}
