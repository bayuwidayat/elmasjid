<?= $this->extend('frontend/' . templates()->folder . '/layout/app') ?>

<?= $this->section('content') ?>
<div class="container-fluid position-relative p-0">
    <div class="container-fluid bg-primary py-5 bg-header" style="margin-bottom: 90px;">
        <div class="row py-5">
            <div class="col-12 text-center">
                <h1 class="text-white animated zoomIn"><?= $title; ?></h1>
                <a href="<?= base_url() ?>" class="h5 text-white">Home</a>
                <i class="far fa-circle text-white px-2"></i>
                <a href="#" class="h5 text-white"><?= $title; ?></a>
            </div>
        </div>
    </div>
</div>

<!-- Takmir Start -->
<div class="container-fluid pb-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container">
        <div class="row g-4">
            <?php if ($jTakmir == 0) {
                echo 'Belum ada Takmir';
            } else {
                $i = 0;
                $ti = 0.1;
                foreach ($takmir as $t) {
                    $i++;
            ?>
                    <div class="col-md-3 wow slideInUp" data-wow-delay="<?= $ti; ?>s">
                        <div class="team-item bg-light rounded overflow-hidden">
                            <div class="team-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="<?= base_url() ?>assets/images/takmir/<?= $t['gambar'] ?>" alt="<?= $t['nm_takmir'] ?>">
                            </div>
                            <div class="text-center py-4">
                                <a href="<?= base_url() ?>takmir/<?= $t['id_takmir'] ?>/<?= $t['takmir_seo'] ?>">
                                    <h4 class="text-primary"><?= $t['nm_takmir'] ?></h4>
                                </a>
                                <p class="m-0"><?= $t['jbtn_takmir'] ?></p>
                            </div>
                        </div>
                    </div>
            <?php
                    $ti = $ti + 0.3;
                }
            }
            ?>

            <div class="col-12 py-4 wow slideInUp" data-wow-delay="0.1s">
                <?= $pager->links('default', 'elmasjid'); ?>
            </div>
        </div>
    </div>
</div>
<!-- Takmir Start -->

<?= $this->endSection() ?>