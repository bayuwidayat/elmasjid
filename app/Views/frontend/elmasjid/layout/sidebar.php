<?php

use App\Models\BeritaModel;
use App\Models\KategoriModel;

$BM = new BeritaModel();
$KM = new KategoriModel();
$berita = $BM->get_berita('berita', 5, 'Y');
$tausiyah = $BM->get_berita('tausiyah', 5, 'Y');
$kategori = $KM->get_kategori('ASC');
?>

<!-- Search Form Start -->
<div class="mb-5 wow slideInUp" data-wow-delay="0.1s">
    <form action="<?= base_url() ?>s">
        <div class="input-group">
            <input type="text" class="form-control p-3" placeholder="Keyword" name="s" required>
            <button type="submit" class="btn btn-primary px-4"><i class="fa fa-search"></i></button>
        </div>
    </form>
</div>
<!-- Search Form End -->

<!-- Berita Terbaru Start -->
<div class="mb-5 wow slideInUp" data-wow-delay="0.1s">
    <div class="section-title section-title-sm position-relative pb-3 mb-4">
        <h3 class="mb-0">Berita Terbaru</h3>
    </div>
    <?php foreach ($berita as $b) { ?>
        <div class="d-flex rounded overflow-hidden mb-3">
            <img class="img-fluid" src="<?= base_url() ?>assets/images/berita/<?= $b->gambar ?>" style="width: 100px; height: 100px; object-fit: cover;" alt="<?= $b->judul ?>">
            <a href="<?= base_url() ?>berita/<?= $b->id_berita ?>/<?= $b->judul_seo ?>" class="d-flex align-items-center bg-light px-3 mb-0"><?= $b->judul ?></a>
        </div>
    <?php } ?>
</div>
<!-- Berita Terbaru End -->

<!-- Tausiyah Terbaru Start -->
<div class="mb-5 wow slideInUp" data-wow-delay="0.1s">
    <div class="section-title section-title-sm position-relative pb-3 mb-4">
        <h3 class="mb-0">Tausiyah Terbaru</h3>
    </div>
    <?php foreach ($tausiyah as $b) { ?>
        <div class="d-flex rounded overflow-hidden mb-3">
            <img class="img-fluid" src="<?= base_url() ?>assets/images/tausiyah/<?= $b->gambar ?>" style="width: 100px; height: 100px; object-fit: cover;" alt="<?= $b->judul ?>">
            <a href="<?= base_url() ?>tausiyah/<?= $b->id_berita ?>/<?= $b->judul_seo ?>" class="d-flex align-items-center bg-light px-3 mb-0"><?= $b->judul ?></a>
        </div>
    <?php } ?>
</div>
<!-- Tausiyah Terbaru End -->

<!-- Category Start -->
<div class="mb-5 wow slideInUp" data-wow-delay="0.1s">
    <div class="section-title section-title-sm position-relative pb-3 mb-4">
        <h3 class="mb-0">Kategori</h3>
    </div>
    <div class="link-animated d-flex flex-column justify-content-start">
        <?php foreach ($kategori as $k) { ?>
            <a class="h5 fw-semi-bold bg-light rounded py-2 px-3 mb-2" href="<?= base_url() ?>kategori/<?= $k->kategori_seo ?>"><i class="bi bi-arrow-right me-2"></i><?= $k->nm_kategori; ?></a>
        <?php } ?>
    </div>
</div>
<!-- Category End -->