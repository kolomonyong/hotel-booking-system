<?= $this->extend('admin/layout/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="card shadow">
        <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-primary">Edit Room</h4>
        </div>
        <div class="card-body">
            <!-- Menampilkan error jika ada -->
            <?php if (session()->has('errors')): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php foreach (session('errors') as $error): ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <!-- Form untuk mengedit kamar -->
            <form action="/admin/update_room/<?= $room['id'] ?>" method="post">
                <?= csrf_field() ?>

                <!-- Tipe Kamar -->
                <div class="mb-3">
                    <label for="tipe_kamar" class="form-label">Room Type</label>
                    <input type="text" class="form-control <?= isset($errors['tipe_kamar']) ? 'is-invalid' : '' ?>"
                        id="tipe_kamar" name="tipe_kamar" value="<?= old('tipe_kamar', $room['tipe_kamar']) ?>" required>
                    <div class="invalid-feedback">
                        <?= isset($errors['tipe_kamar']) ? esc($errors['tipe_kamar']) : '' ?>
                    </div>
                </div>

                <!-- Harga -->
                <div class="mb-3">
                    <label for="harga" class="form-label">Price</label>
                    <input type="number" class="form-control <?= isset($errors['harga']) ? 'is-invalid' : '' ?>"
                        id="harga" name="harga" value="<?= old('harga', $room['harga']) ?>" required>
                    <div class="invalid-feedback">
                        <?= isset($errors['harga']) ? esc($errors['harga']) : '' ?>
                    </div>
                </div>

                <!-- Deskripsi -->
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Description</label>
                    <textarea class="form-control <?= isset($errors['deskripsi']) ? 'is-invalid' : '' ?>"
                        id="deskripsi" name="deskripsi" rows="4" required><?= old('deskripsi', $room['deskripsi']) ?></textarea>
                    <div class="invalid-feedback">
                        <?= isset($errors['deskripsi']) ? esc($errors['deskripsi']) : '' ?>
                    </div>
                </div>

                <!-- Jumlah Kamar -->
                <div class="mb-3">
                    <label for="jumlah_kamar" class="form-label">Room Quantity</label>
                    <input type="number" class="form-control <?= isset($errors['jumlah_kamar']) ? 'is-invalid' : '' ?>"
                        id="jumlah_kamar" name="jumlah_kamar" value="<?= old('jumlah_kamar', $room['jumlah_kamar']) ?>" required>
                    <div class="invalid-feedback">
                        <?= isset($errors['jumlah_kamar']) ? esc($errors['jumlah_kamar']) : '' ?>
                    </div>
                </div>

                <!-- Tombol Submit -->
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="/admin/rooms" class="btn btn-secondary ms-2">Back to Rooms</a>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>