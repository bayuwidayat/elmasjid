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

<!-- Infaq Start -->
<div class="container-fluid pb-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container">
        <div class="row g-4">
            <?php if ($jInfaq == 0) {
                echo 'Belum ada Infaq';
            } else {
            ?>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>TANGGAL</th>
                            <th>DARI</th>
                            <th>MASUK</th>
                            <th>KELUAR</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        foreach ($infaq as $bp) {
                            $i++;
                        ?>
                            <tr>
                                <td><?= tgl_indo($bp['tanggal']); ?></td>
                                <td><?= $bp['keterangan']; ?></td>
                                <td><?= ($bp['jenis'] == 'Dana Masuk') ? 'Rp ' . format_rupiah($bp['jml_dana']) : ''; ?></td>
                                <td class="text-danger"><?= ($bp['jenis'] == 'Dana Keluar') ? 'Rp ' . format_rupiah($bp['jml_dana']) : ''; ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            <?php
            }
            ?>

            <div class="col-12 py-4 wow slideInUp" data-wow-delay="0.1s">
                <?= $pager->links('default', 'elmasjid'); ?>
            </div>
        </div>
    </div>
</div>
<!-- Infaq Start -->

<?= $this->endSection() ?>