<?= $this->extend('frontend/' . templates()->folder . '/layout/app') ?>

<?= $this->section('content') ?>
<!-- Takmir Start -->
<div class="container-fluid pb-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-md-8 mb-5">
                <h1 class="mb-4"><?= $title; ?></h1>
                <div class="row">
                    <div class="col-sm-4">
                        <img src="<?= base_url() ?>assets/images/takmir/<?= $takmir->gambar ?>" alt="<?= $takmir->nm_takmir ?>" class="img-fluid">
                    </div>
                    <div class="col-sm-8">
                        <p>
                            <b>Nama : <?= $takmir->nm_takmir; ?></b><br>
                            Jabatan : <?= $takmir->jbtn_takmir; ?>
                        </p>
                        <?= $takmir->ket_takmir; ?>
                    </div>
                </div>
                <div class="mb-4">

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Takmir Start -->

<?= $this->endSection() ?>