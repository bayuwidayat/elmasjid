<?= $this->extend('frontend/' . templates()->folder . '/layout/app') ?>

<?= $this->section('content') ?>
<!-- Pengumuman Start -->
<div class="container-fluid pb-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-md-8">
                <div class="mb-5">
                    <h1 class="mb-4"><?= $pengumuman->nm_pengumuman; ?></h1>
                    <div class="mb-4">
                        <small class="me-3"><i class="far fa-user text-primary me-2"></i><?= $pengumuman->created_by; ?></small>
                        <small class="me-3"><i class="far fa-calendar-alt text-primary me-2"></i><?= tgl_indo($pengumuman->created_at); ?></small>
                    </div>
                    <?= $pengumuman->isi_pengumuman; ?>

                    <p>
                        <?php
                        if (empty($pengumuman->file_pengumuman)) {
                            echo '<span class="badge badge-danger">Tidak Ada File dilampirkan</span>';
                        } else {
                            echo '<a href="' . base_url() . '/download/pengumuman/' . $pengumuman->pengumuman_seo . '/' . $pengumuman->id_pengumuman . '" class="btn btn-primary mt-3">Download File Lampiran</a>';
                        }
                        ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Pengumuman Start -->

<?= $this->endSection() ?>