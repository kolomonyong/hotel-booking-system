<!-- app/Views/admin/rooms.php -->
<?= $this->extend('admin/layout/main') ?>

<?= $this->section('page_actions') ?>
<a href="/admin/rooms/create" class="btn btn-primary">Add New Room</a>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Room Type</th>
                <th>Price</th>
                <th>Total Rooms</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rooms as $room): ?>
                <tr>
                    <td><?= $room['id'] ?></td>
                    <td><?= esc($room['tipe_kamar']) ?></td>
                    <td>Rp <?= number_format($room['harga'], 0, ',', '.') ?></td>
                    <td><?= $room['jumlah_kamar'] ?></td>
                    <td>
                        <div class="btn-group" role="group">
                            <a href="/admin/rooms/edit/<?= $room['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="/admin/rooms/delete/<?= $room['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?= $this->endSection() ?>