<?php

namespace App\Controllers\Admin;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Controllers\BaseController;
use App\Models\UserModel;

class AuthController extends BaseController
{
    protected $session;
    protected $userModel;

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->userModel = new UserModel();
    }

    public function login()
    {
        if ($this->session->get('isLoggedIn')) {
            return redirect()->to('/admin/dashboard');
        }

        return view('admin/login');
    }

    public function authenticate()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $admin = $this->userModel->getAdminByEmail($email);
        $user = $this->userModel->where('email', $email)->where('role', 'tamu')->first();

        if ($admin && password_verify($password, $admin['password'])) {
            $this->session->set([
                'admin_id' => $admin['id'],
                'admin_name' => $admin['nama'],
                'isLoggedIn' => true,
                'role' => 'admin'
            ]);
            return redirect()->to('admin/dashboard');
        }

        if ($user && password_verify($password, $user['password'])) {
            $this->session->set([
                'user_id' => $user['id'],
                'user_name' => $user['nama'],
                'email' => $user['email'],
                'isLoggedIn' => true,
                'role' => 'tamu'
            ]);
            return redirect()->to('user/booking');
        }

        return redirect()->back()->with('error', 'Invalid credentials');
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/login');
    }

    public function register()
    {
        if ($this->request->getMethod() === 'post') {
            $nama = $this->request->getPost('nama');
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            $passwordConfirm = $this->request->getPost('password_confirm');
            $verificationCode = $this->request->getPost('verification_code');

            if ($verificationCode != session()->get('verification_code')) {
                return redirect()->back()->with('error', 'Invalid verification code.');
            }

            if ($password !== $passwordConfirm) {
                return redirect()->back()->with('error', 'Password and Confirm Password do not match.');
            }

            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);


            $validation = \Config\Services::validation();
            $validation->setRules([
                'email'    => 'required|valid_email|is_unique[users.email]',
                'password' => 'required|min_length[5]',
                'nama'     => 'required',
            ]);

            if (!$validation->run([
                'email'    => $email,
                'password' => $password,
                'nama'     => $nama,
            ])) {
                return redirect()->back()->withInput()->with('error', $validation->listErrors());
            }

            $data = [
                'nama'     => $nama,
                'email'    => $email,
                'password' => $hashedPassword,
                'role'     => 'tamu',
            ];

            if ($this->userModel->insert($data)) {
                session()->remove('verification_code');
                return redirect()->to('/')->with('success', 'Registration successful. Please log in.');
            } else {
                return redirect()->back()->with('error', 'Registration failed. Please try again.');
            }
        }

        return view('admin/register');
    }

    public function sendVerificationCode()
    {
        $data = $this->request->getJSON();

        if (empty($data->email)) {
            return $this->response->setJSON(['message' => 'Email is required']);
        }

        $verificationCode = rand(100000, 999999);

        $this->session->set('verification_code', $verificationCode);

        try {
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = '';
            $mail->Password = '';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('kolomonyong@gmail.com', 'hotelmercu');
            $mail->addAddress($data->email);

            $mail->isHTML(true);
            $mail->Subject = 'Email Verification Code';
            $mail->Body    = "Kode Verifikasi Anda: $verificationCode";

            $mail->send();
            return $this->response->setJSON(['message' => 'Verification code sent to your email']);
        } catch (Exception $e) {
            return $this->response->setJSON(['message' => 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo]);
        }
    }
}
