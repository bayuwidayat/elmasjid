<?= $this->extend('frontend/' . templates()->folder . '/layout/app') ?>

<?= $this->section('content') ?>

<div class="container-fluid position-relative p-0">
    <div class="container-fluid bg-primary py-5 bg-header" style="margin-bottom: 90px;">
        <div class="row py-5">
            <div class="col-12 text-center">
                <h1 class="text-white animated zoomIn"><?= $title; ?></h1>
                <a href="#" class="h5 text-white">Home</a>
                <i class="far fa-circle text-white px-2"></i>
                <a href="#" class="h5 text-white"><?= $title; ?></a>
            </div>
        </div>
    </div>
</div>

<!-- Halaman Start -->
<div class="container-fluid pb-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <?php if (!empty($halaman[0]->gambar)) { ?>
                    <img src="<?= base_url(); ?>assets/images/halaman/<?= $halaman[0]->gambar; ?>" alt="<?= $halaman[0]->judul; ?>" title="<?= $halaman[0]->judul; ?>">
                <?php } ?>

                <?= $halaman[0]->isi_halaman; ?>

                <div class="d-flex my-4">
                    <?= social_share($halaman[0]->judul, current_url()); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Halaman Start -->

<?= $this->endSection() ?>