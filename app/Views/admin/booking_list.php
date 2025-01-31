<?= $this->extend('admin/layout/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Booking Management</h1>

    <?php if (session()->has('message')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session('message') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <?php if (session()->has('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session('error') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">Bookings</div>
            <div class="card-body">
                <?php if (!empty($booking)): ?>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Guest Name</th>
                                <th>Room ID</th>
                                <th>Check-in Date</th>
                                <th>Check-out Date</th>
                                <th>Rooms</th>
                                <th>Total Price</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($booking as $item): ?>
                                <tr>
                                    <td><?= $item['id'] ?></td>
                                    <td><?= $item['nama'] ?></td>
                                    <td><?= $item['id_kamar'] ?></td>
                                    <td><?= $item['tanggal_checkin'] ?></td>
                                    <td><?= $item['tanggal_checkout'] ?></td>
                                    <td><?= $item['jumlah_kamar'] ?></td>
                                    <td><?= number_format($item['total_harga'], 0, ',', '.') ?></td>
                                    <td><?= $item['status'] ?></td>
                                    <td>
                                        <a href="<?= base_url('admin/bookings/detail/' . $item['id']) ?>" class="btn btn-info btn-sm">View</a>
                                        <a href="<?= base_url('admin/bookings/confirm/' . $item['id']) ?>" class="btn btn-success btn-sm" onclick="return confirm('Confirm this booking?')">Confirm</a>
                                        <a href="<?= base_url('admin/bookings/cancel/' . $item['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Cancel this booking?')">Cancel</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>No bookings found.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
