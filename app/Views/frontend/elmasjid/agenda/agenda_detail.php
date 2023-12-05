<?= $this->extend('frontend/' . templates()->folder . '/layout/app') ?>

<?= $this->section('content') ?>
<!-- Agenda Start -->
<div class="container-fluid pb-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-md-8">
                <div class="mb-5">
                    <?php
                    if (!empty($agenda->gambar)) {
                        $file = 'assets/images/agenda/' . $agenda->gambar;
                        if (file_exists($file)) {
                    ?>
                            <img class="img-fluid w-100 rounded mb-5" src="<?= base_url(); ?>assets/images/agenda/<?= $agenda->gambar; ?>" alt="<?= $agenda->nm_agenda; ?>" title="<?= $agenda->nm_agenda; ?>">
                    <?php
                        }
                    }
                    ?>

                    <h1 class="mb-4"><?= $agenda->nm_agenda; ?></h1>
                    <table class="table">
                        <tr>
                            <td>Tanggal</td>
                            <td><?= ($agenda->tgl_mulai == $agenda->tgl_selesai) ? tgl_indo($agenda->tgl_mulai) : tgl_indo($agenda->tgl_mulai) . ' s/d ' . tgl_indo($agenda->tgl_selesai); ?></td>
                        </tr>
                        <tr>
                            <td>Jam</td>
                            <td><?= $agenda->jam; ?></td>
                        </tr>
                        <tr>
                            <td>Lokasi</td>
                            <td><?= $agenda->tempat; ?></td>
                        </tr>
                        <tr>
                            <td>Koordinator</td>
                            <td><?= $agenda->koordinator; ?> <?= ($agenda->telp_koordinator != '') ? $agenda->telp_koordinator : ''; ?></td>
                        </tr>
                    </table>
                    <p><b>Deskripsi:</b></p>
                    <?= $agenda->isi_agenda; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Agenda Start -->

<?= $this->endSection() ?>