<?= $this->extend('frontend/' . templates()->folder . '/layout/app') ?>

<?= $this->section('content') ?>
<!-- Berita Start -->
<div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-md-8">
                <div class="mb-5">
                    <?php if (!empty($berita[0]->gambar)) { ?>
                        <img class="img-fluid w-100 rounded mb-5" src="<?= base_url(); ?>assets/images/berita/<?= $berita[0]->gambar; ?>" alt="<?= $berita[0]->judul; ?>" title="<?= $berita[0]->judul; ?>">
                    <?php } ?>

                    <h1 class="mb-4"><?= $berita[0]->judul; ?></h1>

                    <div class="mb-4">
                        <small class="me-3"><i class="far fa-user text-primary me-2"></i><a href="<?= base_url(); ?>author/<?= $berita[0]->created_by; ?>"><?= $berita[0]->created_by; ?></a></small>
                        <small class="me-3"><i class="far fa-calendar-alt text-primary me-2"></i><?= tgl_indo($berita[0]->created_at); ?></small>
                        <small class="me-3"><i class="fas fa-folder-open text-primary me-2"></i><a href="<?= base_url(); ?>kategori/<?= $berita[0]->kategori_seo; ?>"><?= $berita[0]->nm_kategori; ?></a></small>

                        <?php
                        $tag = explode(',', $berita[0]->tag);
                        $jTag = count($tag);
                        if ($jTag > 0) {
                        ?>
                            <small class="me-3"><i class="fas fa-tags text-primary me-2"></i>
                                <?php for ($i = 0; $i < $jTag; $i++) { ?>
                                    <a href="<?= base_url(); ?>tag/<?= $tag[$i]; ?>"> <?= $tag[$i]; ?>,</a>
                                <?php } ?>
                            </small>
                        <?php } ?>
                    </div>

                    <div class="d-flex mb-4">
                        <?= social_share($berita[0]->judul, current_url()); ?>
                    </div>

                    <?= $berita[0]->isi_berita; ?>
                </div>
            </div>

            <!-- sidebar start-->
            <div class="col-md-4">
                <?= $this->include('frontend/' . templates()->folder . '/layout/sidebar') ?>
            </div>
            <!-- sidebar end -->
        </div>
    </div>
</div>
<!-- Berita Start -->

<?= $this->endSection() ?>