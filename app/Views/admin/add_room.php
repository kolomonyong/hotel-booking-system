<?= $this->extend('admin/layout/main') ?>

<?= $this->section('content') ?>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <?php if (isset($validation) && $validation->getErrors()): ?>
                <div class="alert alert-danger">
                    <?= $validation->listErrors() ?>
                </div>
            <?php endif; ?>

            <form action="/admin/rooms/store" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <div class="mb-3">
                    <label for="tipe_kamar" class="form-label">Room Type</label>
                    <input type="text" class="form-control" id="tipe_kamar" name="tipe_kamar" value="<?= old('tipe_kamar') ?>" required>
                </div>

                <div class="mb-3">
                    <label for="harga" class="form-label">Price</label>
                    <input type="number" class="form-control" id="harga" name="harga" value="<?= old('harga') ?>" required>
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Description</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" required><?= old('deskripsi') ?></textarea>
                </div>

                <div class="mb-3">
                    <label for="jumlah_kamar" class="form-label">Total Rooms</label>
                    <input type="number" class="form-control" id="jumlah_kamar" name="jumlah_kamar" value="<?= old('jumlah_kamar') ?>" required>
                </div>

                <div class="mb-3">
                    <label for="gambar" class="form-label">Room Image</label>
                    <input type="file" class="form-control" id="gambar" name="gambar">
                </div>

                <button type="submit" class="btn btn-primary">Add Room</button>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>