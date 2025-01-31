<?= $this->extend('admin/layout/main_user') ?>

<?= $this->section('content') ?>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <p><strong>Booking ID:</strong> <?= $booking['id'] ?></p>
            <p><strong>Room:</strong> <?= $booking['tipe_kamar'] ?></p>
            <p><strong>Total Price:</strong> Rp. <?= $booking['total_harga'] ?></p>

            <form action="<?= site_url('user/payment/confirm/' . $booking['id']) ?>" method="POST">
                <div class="form-group">
                    <label for="payment_method">Choose Payment Method:</label>
                    <select class="form-control" id="payment_method" name="payment_method" required>
                        <option value="">Pilih Metode Pembayaran</option>
                        <?php foreach ($payment_methods as $method): ?>
                            <option value="<?= $method ?>"><?= $method ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mt-3">
                    <p><strong>Virtual Account:</strong> <span id="virtual_account"></span></p>
                </div>
                <button type="submit" class="btn btn-success btn-block">Confirm Payment</button>
            </form>

            <div class="mt-5 text-center">
                <p><strong>Selesaikan Pesanan Dalam <span id="countdown">05:00</span></strong></p>
            </div>
        </div>
    </div>
</div>

<script>
    const virtualAccounts = {
        'Mandiri': '1234567890123456',
        'BCA': '9876543210987654',
        'BRI': '5678901234567890'
    };

    document.getElementById('payment_method').addEventListener('change', function() {
        const method = this.value;
        document.getElementById('virtual_account').textContent = virtualAccounts[method] || '';
    });

    let countdownElement = document.getElementById('countdown');
    let countdownTime = 1200;

    const countdownInterval = setInterval(() => {
        const minutes = Math.floor(countdownTime / 60);
        const seconds = countdownTime % 60;

        countdownElement.textContent = `${minutes}:${seconds.toString().padStart(2, '0')}`;

        countdownTime--;

        if (countdownTime < 0) {
            clearInterval(countdownInterval);
            window.history.back();
        }
    }, 1000);
</script>
<?= $this->endSection() ?>