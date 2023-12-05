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

<!-- Playlist Start -->
<div class="container-fluid pb-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container">
        <div class="row g-4 mb-4">
            <?php
            $jVideo = count($video);
            if ($jVideo == 0) {
                echo 'Belum ada Galeri Video';
            } else {
                $i = 0;
                foreach ($video as $v) {
                    $i++;
                    $video = str_replace('watch?v=', 'embed/', $v['youtube']);
            ?>
                    <div class="col-md-6 mb-4 wow slideInUp" data-wow-delay="<?= (($i % 2) == 1) ? '0.1s' : '0.5s'; ?>">
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src="<?= $video ?>" title="<?= $v['nm_video'] ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
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

        <div class="row mt-4 mb-4">
            <div class="section-title section-title-sm position-relative pb-3 mb-4">
                <h3 class="mb-0">Playlist Video Lainnya</h3>
            </div>
            <?php if ($jPlaylist == 0) {
                echo 'Belum ada Galeri Video';
            } else {
                $i = 0;
                foreach ($playlist as $bp) {
                    $i++;
            ?>
                    <div class="col-md-4 wow slideInUp mb-4" data-wow-delay="<?= (($i % 3) == 1) ? '0.1s' : ((($i % 3) == 2) ? '0.5s' : '0.9s'); ?>">
                        <div class="blog-item rounded overflow-hidden text-center">
                            <div class="blog-img position-relative overflow-hidden mb-2">
                                <a href="<?= base_url(); ?>video/<?= $bp->id_playlist; ?>/<?= $bp->playlist_seo; ?>"><img class="img-fluid" src="<?= base_url() ?>assets/images/playlist/<?= $bp->gambar ?>" alt=""></a>
                            </div>
                            <a href="<?= base_url(); ?>video/<?= $bp->id_playlist; ?>/<?= $bp->playlist_seo; ?>">
                                <h5 class="mb-3"><?= $bp->nm_playlist; ?></h5>
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
<!-- Playlist Start -->

<?= $this->endSection() ?>

<?= $this->Section('javascript') ?>
<script src="<?= base_url() ?>assets/templates/<?= templates()->folder ?>/lib/bs5-lightbox@1.8.3/index.bundle.min.js"></script>
<?= $this->endSection() ?>