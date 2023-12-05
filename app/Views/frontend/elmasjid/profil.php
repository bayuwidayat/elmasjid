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

<!-- Profil Start -->
<div class="container-fluid pb-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="section-title position-relative pb-3 mb-5">
                    <h1 class="mb-0"><?= $title; ?></h1>
                </div>
                <?= setting()->tentang; ?>
            </div>
        </div>
    </div>
</div>
<!-- Profil Start -->

<!-- Takmir Start -->
<div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
            <h4 class="fw-bold text-primary text-uppercase">Takmir</h4>
        </div>
        <div class="row g-5">
            <?php if ($jTakmir == 0) {
                echo 'Belum ada Takmir';
            } else {
                $i = 0;
                foreach ($takmir as $t) {
                    $i++;
            ?>
                    <div class="col-lg-4 wow slideInUp" data-wow-delay="<?= (($i % 3) == 1) ? '0.1s' : ((($i % 3) == 2) ? '0.4s' : '0.7s'); ?>">
                        <div class="team-item bg-light rounded overflow-hidden">
                            <div class="team-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="<?= base_url() ?>assets/images/takmir/<?= $t->gambar ?>" alt="<?= $t->nm_takmir ?>">
                            </div>
                            <div class="text-center py-4">
                                <a href="<?= base_url() ?>takmir/<?= $t->id_takmir ?>/<?= $t->takmir_seo ?>">
                                    <h4 class="text-primary"><?= $t->nm_takmir ?></h4>
                                </a>
                                <p class="m-0"><?= $t->jbtn_takmir ?></p>
                            </div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>
        <div class="text-center mt-3 mx-auto">
            <a href="<?= base_url() ?>takmir" class="btn btn-outline-primary py-3 px-5 mt-3 wow zoomIn" data-wow-delay="0.5s">Lihat Semua Takmir</a>
        </div>
    </div>
</div>
<!-- Takmir End -->

<?= $this->endSection() ?>