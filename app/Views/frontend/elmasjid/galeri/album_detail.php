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
        <div class="row g-4 mb-4">
            <?php
            $jFoto = count($foto);
            if ($jFoto == 0) {
                echo 'Belum ada Galeri Foto';
            } else {
                $i = 0;
                foreach ($foto as $f) {
                    $i++;
            ?>
                    <div class="col-sm-3 mb-4 text-center">
                        <a href="<?= base_url() ?>assets/images/foto/<?= $f['gambar'] ?>" data-toggle="lightbox" data-gallery="mixedgallery" data-caption="<?= $f['ket_foto'] ?>">
                            <img src="<?= base_url() ?>assets/images/foto/<?= $f['gambar'] ?>" alt="" class="img-fluid">
                        </a>
                        <?= $f['nm_foto']; ?>
                    </div>
            <?php
                }
            }
            ?>

            <div class="col-12 py-4 wow slideInUp" data-wow-delay="0.1s">
                <?= $pager->links('default', 'elmasjid'); ?>
            </div>
        </div>

        <div class="row mt-4 mb-4">
            <div class="section-title section-title-sm position-relative pb-3 mb-4">
                <h3 class="mb-0">Album Foto Lainnya</h3>
            </div>
            <?php if ($jAlbum == 0) {
                echo 'Belum ada Galeri Foto';
            } else {
                $i = 0;
                foreach ($album as $bp) {
                    $i++;
            ?>
                    <div class="col-md-4 wow slideInUp mb-4" data-wow-delay="<?= (($i % 3) == 1) ? '0.1s' : ((($i % 3) == 2) ? '0.5s' : '0.9s'); ?>">
                        <div class="blog-item rounded overflow-hidden text-center">
                            <div class="blog-img position-relative overflow-hidden mb-2">
                                <a href="<?= base_url(); ?>galeri-foto/<?= $bp->id_album; ?>/<?= $bp->album_seo; ?>"><img class="img-fluid" src="<?= base_url() ?>assets/images/album/<?= $bp->gambar ?>" alt=""></a>
                            </div>
                            <a href="<?= base_url(); ?>galeri-foto/<?= $bp->id_album; ?>/<?= $bp->album_seo; ?>">
                                <h5 class="mb-3"><?= $bp->nm_album; ?></h5>
                            </a>
                            <small><?= $bp->keterangan ?></small>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>
    </div>
</div>
<!-- Album Start -->

<?= $this->endSection() ?>

<?= $this->Section('javascript') ?>
<script src="<?= base_url() ?>assets/templates/<?= templates()->folder ?>/lib/bs5-lightbox@1.8.3/index.bundle.min.js"></script>
<?= $this->endSection() ?>