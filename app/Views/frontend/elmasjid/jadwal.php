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

<!-- Jadwal Start -->
<div class="container-fluid wow fadeInUp" data-wow-delay="0.1s">
    <div class="container pb-5">
        <div class="row">
            <?php if ($jJadwal == 0) {
                echo 'Belum ada Jadwal';
            } else {
            ?>
                <table class="table">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>Hari/Tanggal</th>
                            <th>Imam</th>
                            <th>Khatib</th>
                            <th>Muadzin</th>
                            <th>Bilal</th>
                        </tr>
                    </thead>
                    <?php
                    $i = 0;
                    foreach ($jadwal as $t) {
                        $i++;
                    ?>
                        <tr>
                            <td>
                                <?= ($t->tipe == 'pasar') ? $t->nm_jadwal : tgl_indo($t->tanggal); ?>
                            </td>
                            <td><?= $t->imam; ?></td>
                            <td><?= $t->khatib; ?></td>
                            <td><?= $t->muadzin; ?></td>
                            <td><?= $t->bilal; ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            <?php
            }
            ?>
        </div>
    </div>
</div>
<!-- Jadwal End -->

<?= $this->endSection() ?>