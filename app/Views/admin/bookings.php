<?= $this->extend('admin/layout/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="card shadow">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h4 class="m-0 font-weight-bold text-primary">Booking Details</h4>
            <span class="badge 
                <?php
                switch ($booking['status'] ?? '') {
                    case 'Cancelled':
                        echo 'bg-danger';
                        break;
                    case 'Confirmed':
                        echo 'bg-success';
                        break;
                    default:
                        echo 'bg-warning';
                }
                ?>
            ">
                <?= $booking['status'] ?? 'N/A' ?>
            </span>
        </div>
        <div class="card-body">
            <?php if (session()->has('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= session('success') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?php if (session()->has('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= session('error') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Booking ID</label>
                        <p class="form-control-plaintext">
                            <?= $booking['id'] ?? 'N/A' ?>
                        </p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Guest Name</label>
                        <p class="form-control-plaintext">
                            <?= esc($booking['nama'] ?? 'N/A') ?>
                        </p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Room Type</label>
                        <p class="form-control-plaintext">
                            <?= esc($booking['tipe_kamar'] ?? 'N/A') ?>
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Check-in Date</label>
                        <p class="form-control-plaintext">
                            <?= isset($booking['tanggal_checkin']) && $booking['tanggal_checkin'] ? date('d M Y', strtotime($booking['tanggal_checkin'])) : 'N/A' ?>
                        </p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Check-out Date</label>
                        <p class="form-control-plaintext">
                            <?= isset($booking['tanggal_checkout']) && $booking['tanggal_checkout'] ? date('d M Y', strtotime($booking['tanggal_checkout'])) : 'N/A' ?>
                        </p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Total Price</label>
                        <p class="form-control-plaintext">
                            <?= isset($booking['total_harga']) && $booking['total_harga'] ? 'Rp ' . number_format($booking['total_harga'], 0, ',', '.') : 'N/A' ?>
                        </p>
                    </div>
                </div>
            </div>

            <div class="mt-3">
                <?php if (isset($booking['status']) && $booking['status'] !== 'Confirmed'): ?>
                    <form action="/admin/bookings/confirm/<?= $booking['id'] ?>" method="post" class="d-inline" onsubmit="return confirm('Are you sure you want to confirm this booking?');">
                        <?= csrf_field() ?>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-check"></i> Confirm Booking
                        </button>
                    </form>
                <?php endif; ?>

                <?php if (isset($booking['status']) && $booking['status'] !== 'Cancelled'): ?>
                    <form action="/admin/bookings/cancel/<?= $booking['id'] ?>" method="post" class="d-inline ms-2" onsubmit="return confirm('Are you sure you want to cancel this booking?');">
                        <?= csrf_field() ?>
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-times"></i> Cancel Booking
                        </button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
        <div class="card-footer">
            <a href="/admin/bookings" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Bookings
            </a>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    // Optional: Add any custom scripts here
</script>
<?= $this->endSection() ?>