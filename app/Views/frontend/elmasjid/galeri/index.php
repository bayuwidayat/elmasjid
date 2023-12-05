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

<!-- Album Start -->
<div class="container-fluid pb-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container">
        <div class="row g-4">
            <?php if ($jAlbum == 0) {
                echo 'Belum ada Galeri Foto';
            } else {
                $i = 0;
                foreach ($album as $bp) {
                    $i++;
            ?>
                    <div class="col-md-4 wow slideInUp mb-4" data-wow-delay="<?= (($i % 3) == 1) ? '0.1s' : ((($i % 3) == 2) ? '0.5s' : '0.9s'); ?>">
                        <div class="blog-item bg-light rounded overflow-hidden">
                            <div class="blog-img position-relative overflow-hidden">
                                <a href="<?= base_url(); ?>galeri-foto/<?= $bp['id_album']; ?>/<?= $bp['album_seo']; ?>"><img class="img-fluid" src="<?= base_url() ?>assets/images/album/<?= $bp['gambar'] ?>" alt=""></a>
                            </div>
                            <div class="p-4">
                                <a href="<?= base_url(); ?>galeri-foto/<?= $bp['id_album']; ?>/<?= $bp['album_seo']; ?>">
                                    <h5 class="mb-3"><?= $bp['nm_album']; ?></h5>
                                </a>
                                <small><?= $bp['keterangan'] ?></small>
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
<!-- Album Start -->

<?= $this->endSection() ?>