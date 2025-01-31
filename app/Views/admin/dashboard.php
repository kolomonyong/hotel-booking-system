<?= $this->extend('admin/layout/main') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-4">
        <div class="card text-center mb-4">
            <div class="card-body">
                <h5 class="card-title">Total Rooms</h5>
                <p class="card-text display-4"><?= $total_rooms ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-center mb-4">
            <div class="card-body">
                <h5 class="card-title">Total Bookings</h5>
                <p class="card-text display-4"><?= $total_bookings ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-center mb-4">
            <div class="card-body">
                <h5 class="card-title">Total Users</h5>
                <p class="card-text display-4"><?= $total_users ?></p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">Recent Bookings</div>
            <div class="card-body">
                <?php if (!empty($recent_bookings)) { ?>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Guest Name</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($recent_bookings as $booking) { ?>
                                <tr>
                                    <td><?= esc($booking['id']) ?></td>
                                    <td><?= esc($booking['nama']) ?></td>
                                    <td><?= esc($booking['status']) ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php } else { ?>
                    <p>No recent bookings found.</p>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">Users</div>
            <div class="card-body">
                <?php if (!empty($users)): ?>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $user): ?>
                                <tr>
                                    <td><?= esc($user['id']) ?></td>
                                    <td><?= esc($user['nama']) ?></td>
                                    <td><?= esc($user['email']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>No users found.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>