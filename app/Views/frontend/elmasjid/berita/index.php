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

<!-- Berita Start -->
<div class="container-fluid pb-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container">
        <div class="row g-4">
            <div class="col-12">
                <div class="row">
                    <?php if ($jBerita == 0) {
                        echo 'Belum ada Berita';
                    } else {
                        $i = 0;
                        foreach ($berita as $bp) {
                            $i++;
                    ?>
                            <div class="col-md-4 wow slideInUp mb-4" data-wow-delay="<?= (($i % 2) == 1) ? '0.1s' : '0.6s'; ?>">
                                <div class="blog-item bg-light rounded overflow-hidden">
                                    <div class="blog-img position-relative overflow-hidden">
                                        <img class="img-fluid" src="<?= base_url() ?>assets/images/berita/<?= $bp['gambar'] ?>" alt="">
                                    </div>
                                    <div class="p-4">
                                        <div class="d-flex mb-3">
                                            <small class="me-3"><i class="far fa-user text-primary me-2"></i><?= $bp['created_by']; ?></small>
                                            <small><i class="far fa-calendar-alt text-primary me-2"></i><?= tgl_indo2($bp['created_at']); ?></small>
                                        </div>
                                        <h5 class="mb-3"><?= $bp['judul']; ?></h5>
                                        <p><?= substr(strip_tags($bp['isi_berita']), 0, 150); ?>...</p>
                                        <a href="<?= base_url(); ?>berita/<?= $bp['id_berita']; ?>/<?= $bp['judul_seo']; ?>">Selengkapnya <i class="fas fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    }
                    ?>

                    <div class="col-12 py-4 wow slideInUp" data-wow-delay="0.1s">
                        <?= $pager->links('default', 'elmasjid'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Berita Start -->

<?= $this->endSection() ?>