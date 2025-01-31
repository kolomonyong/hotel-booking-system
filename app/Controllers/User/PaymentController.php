<?php

namespace App\Controllers\User;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Controllers\BaseController;
use App\Models\BookingModel;

class PaymentController extends BaseController
{
    protected $bookingModel;
    protected $session;

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->bookingModel = new BookingModel();
    }

    public function index($id)
    {
        $booking = $this->bookingModel->getBookingById($id);

        if (!$booking || $booking['id_tamu'] != $this->session->get('user_id')) {
            return redirect()->to('user/booking')->with('error', 'Booking not found');
        }

        $data = [
            'booking' => $booking,
            'page_title' => 'Payment',
            'payment_methods' => ['Mandiri', 'BCA', 'BRI']
        ];

        return view('user/payment', $data);
    }

    public function confirm($id)
    {
        $booking = $this->bookingModel->getBookingById($id);

        if (!$booking || $booking['status'] === 'Confirmed') {
            return redirect()->to('user/booking')->with('error', 'Booking already confirmed');
        }

        $paymentMethod = $this->request->getPost('payment_method'); // Ambil metode pembayaran dari form
        if (!$paymentMethod) {
            return redirect()->back()->with('error', 'Please select a payment method');
        }

        // Update status booking menjadi Confirmed
        $this->bookingModel->updateStatus($id, 'Confirmed');

        $userEmail = $this->session->get('email');
        $roomType = $booking['tipe_kamar'];
        $numRooms = $booking['jumlah_kamar'];
        $checkInDate = $booking['tanggal_checkin'];
        $checkOutDate = $booking['tanggal_checkout'];
        $totalPrice = $booking['total_harga'];

        try {
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'kolomonyong@gmail.com';
            $mail->Password = 'vjpe cccx wdtb lxrf'; // Masukkan sandi aplikasi
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('kolomonyong@gmail.com', 'hotelmercu');
            $mail->addAddress($userEmail);

            $mail->isHTML(true);
            $mail->Subject = 'Pesanan Anda Telah Dikonfirmasi';
            $mail->Body    = "
                <h2>Detail Pesanan Anda</h2>
                <p><strong>Tipe Kamar:</strong> {$roomType}</p>
                <p><strong>Jumlah Kamar:</strong> {$numRooms}</p>
                <p><strong>Check-In:</strong> {$checkInDate}</p>
                <p><strong>Check-Out:</strong> {$checkOutDate}</p>
                <p><strong>Total Harga:</strong> Rp. {$totalPrice}</p>
                <p><strong>Metode Pembayaran:</strong> {$paymentMethod}</p>
                <br>
                <p>Terima kasih telah memesan di hotel kami!</p>
            ";

            $mail->send();
            return redirect()->to('user/payment/success/' . $id);
        } catch (Exception $e) {
            return $this->response->setJSON(['message' => 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo]);
        }

        return redirect()->to('user/payment/success/' . $id);
    }



    public function success($id)
    {
        $booking = $this->bookingModel->find($id);

        if (!$booking || $booking['id_tamu'] != $this->session->get('user_id')) {
            return redirect()->to('user/booking')->with('error', 'Booking not found');
        }

        $data = [
            'booking' => $booking,
            'page_title' => 'Payment Successful'
        ];

        return view('user/payment_success', $data);
    }
}
