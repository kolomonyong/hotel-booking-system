<?= $this->extend('admin/layout/main_user') ?>

<?= $this->section('content') ?>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2 text-center">
            <h1><?= $page_title ?></h1>
            <p>Payment of <strong>$<?= $booking['total_harga'] ?></strong> was successful! A confirmation email has been sent to your email address.</p>
            <a href="<?= site_url('user/booking') ?>" class="btn btn-primary">Pesan Lagi</a>
        </div>
    </div>
</div>
<?= $this->endSection() ?>