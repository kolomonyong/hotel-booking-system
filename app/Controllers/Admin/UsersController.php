<?php

namespace App\Controllers\Admin;

use App\Models\UserModel;
use CodeIgniter\Controller;
use CodeIgniter\Validation\Validation;
use App\Controllers\BaseController;

class UsersController extends BaseController
{
    protected $request;
    protected $validation;
    protected $userModel;


    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->validation = \Config\Services::validation();
    }


    public function index()
    {
        $data = [
            'title' => 'User Management',
            'users' => $this->userModel->findAll(),
        ];

        return view('admin/users', $data);
    }

    public function edit($id)
    {
        $user = $this->userModel->find($id);

        if (!$user) {
            return redirect()->to('/admin/users')->with('error', 'User not found.');
        }

        $data = [
            'title' => 'Edit User',
            'user' => $user
        ];

        return view('admin/edit_user', $data);
    }

    public function update($id)
    {
        $user = $this->userModel->find($id);

        if (!$user) {
            return redirect()->to('/admin/users')->with('error', 'User not found.');
        }

        $rules = [
            'nama' => 'permit_empty|min_length[3]',
            'email' => "permit_empty|valid_email|is_unique[users.email,id,{$id}]",
            'no_telepon' => 'permit_empty|numeric',
            'role' => 'required|in_list[admin,user]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $dataToUpdate = [];

        if ($this->request->getPost('nama') !== null && $this->request->getPost('nama') !== $user['nama']) {
            $dataToUpdate['nama'] = $this->request->getPost('nama');
        }

        if ($this->request->getPost('email') !== null && $this->request->getPost('email') !== $user['email']) {
            $dataToUpdate['email'] = $this->request->getPost('email');
        }

        if ($this->request->getPost('no_telepon') !== null && $this->request->getPost('no_telepon') !== $user['no_telepon']) {
            $dataToUpdate['no_telepon'] = $this->request->getPost('no_telepon');
        }

        if ($this->request->getPost('role') !== null && $this->request->getPost('role') !== $user['role']) {
            $dataToUpdate['role'] = $this->request->getPost('role');
        }

        $foto = $this->request->getFile('foto');
        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            $newName = $foto->getRandomName();
            $foto->move(ROOTPATH . 'public/uploads/profile', $newName);
            $dataToUpdate['foto'] = $newName;
        }

        if ($this->request->getPost('password') !== null) {
            $dataToUpdate['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        if (!empty($dataToUpdate)) {
            if ($this->userModel->update($id, $dataToUpdate)) {
                return redirect()->to('/admin/users')->with('message', 'User updated successfully.');
            } else {
                return redirect()->back()->withInput()->with('error', 'Failed to update user.');
            }
        }

        return redirect()->to('/admin/users')->with('message', 'No changes made.');
    }


    public function delete($id)
    {
        $user = $this->userModel->find($id);

        if (!$user) {
            return redirect()->to('/admin/users')->with('error', 'User not found.');
        }

        $this->userModel->delete($id);

        return redirect()->to('/admin/users')->with('message', 'User deleted successfully.');
    }

    public function getUserById($id)
    {
        return $this->where('id', $id)->first();
    }

}
