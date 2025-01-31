<!-- app/Views/admin/edit_user.php -->
<?= $this->extend('admin/layout/main') ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h2 class="mb-4"><?= esc($title) ?></h2>

            <?php if (session()->has('errors')): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php foreach (session('errors') as $error): ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('admin/users/update/' . $user['id']) ?>" method="POST" enctype="multipart/form-data">
            <?= csrf_field() ?>

                <div class="form-group mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input
                        type="text"
                        class="form-control <?= session('errors.nama') ? 'is-invalid' : '' ?>"
                        id="nama"
                        name="nama"
                        value="<?= old('nama', $user['nama']) ?>">
                    <?php if (session('errors.nama')): ?>
                        <div class="invalid-feedback">
                            <?= session('errors.nama') ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="form-group mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input
                        type="email"
                        class="form-control <?= session('errors.email') ? 'is-invalid' : '' ?>"
                        id="email"
                        name="email"
                        value="<?= old('email', $user['email']) ?>">
                    <?php if (session('errors.email')): ?>
                        <div class="invalid-feedback">
                            <?= session('errors.email') ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="form-group mb-3">
                    <label for="password" class="form-label">Password (Leave blank to keep current password)</label>
                    <input
                        type="password"
                        class="form-control <?= session('errors.password') ? 'is-invalid' : '' ?>"
                        id="password"
                        name="password">
                    <?php if (session('errors.password')): ?>
                        <div class="invalid-feedback">
                            <?= session('errors.password') ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="form-group mb-3">
                    <label for="no_telepon" class="form-label">No. Telepon</label>
                    <input
                        type="text"
                        class="form-control <?= session('errors.no_telepon') ? 'is-invalid' : '' ?>"
                        id="no_telepon"
                        name="no_telepon"
                        value="<?= old('no_telepon', $user['no_telepon']) ?>">
                    <?php if (session('errors.no_telepon')): ?>
                        <div class="invalid-feedback">
                            <?= session('errors.no_telepon') ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="form-group mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select
                        class="form-control <?= session('errors.role') ? 'is-invalid' : '' ?>"
                        id="role"
                        name="role">
                        <option value="admin" <?= old('role', $user['role']) == 'admin' ? 'selected' : '' ?>>Admin</option>
                        <option value="user" <?= old('role', $user['role']) == 'user' ? 'selected' : '' ?>>User</option>
                    </select>
                    <?php if (session('errors.role')): ?>
                        <div class="invalid-feedback">
                            <?= session('errors.role') ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="form-group mb-3">
                    <label for="foto" class="form-label">Foto Profil</label>
                    <input
                        type="file"
                        class="form-control <?= session('errors.foto') ? 'is-invalid' : '' ?>"
                        id="foto"
                        name="foto"
                        accept="image/*">
                    <?php if (session('errors.foto')): ?>
                        <div class="invalid-feedback">
                            <?= session('errors.foto') ?>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($user['foto'])): ?>
                        <div class="mt-2">
                            <p>Current Profile Picture:</p>
                            <img src="<?= base_url('uploads/profile/' . $user['foto']) ?>" alt="Current Profile" class="img-thumbnail" style="max-width: 200px;">
                        </div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Update User</button>
                    <a href="<?= base_url('admin/users') ?>" class="btn btn-secondary ml-2">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>