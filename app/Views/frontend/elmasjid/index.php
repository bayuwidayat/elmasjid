<?= $this->extend('frontend/' . templates()->folder . '/layout/app') ?>

<?= $this->section('content') ?>
<!-- Caroulse Start -->
<div class="container-fluid position-relative p-0">
    <!-- Slider -->
    <?php
    $jslider = count($slider);
    if ($jslider > 0) {
    ?>
        <div id="header-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-inner">
                <?php
                $i = 0;
                foreach ($slider as $sl) {
                    $i++;
                ?>
                    <div class="carousel-item <?= ($i == 1) ? 'active' : ''; ?>">
                        <img class="w-100" src="<?= base_url() ?>assets/images/slider/<?= $sl->gambar ?>" alt="<?= $sl->nm_slider ?>">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3" style="max-width: 900px;">
                                <h2 class="display-1 text-white mb-md-4 animated zoomIn"><?= $sl->nm_slider; ?></h2>
                                <p class="text-white mb-4 animated slideInDown"><?= $sl->ket_slider; ?></p>
                                <?php if (!empty($sl->text_link)) { ?>
                                    <a href="<?= $sl->link; ?>" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInUp"><?= $sl->text_link; ?></a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    <?php } ?>
</div>
<!-- Carousel End -->

<!-- jadwal Sholat Start -->
<div class="container-fluid facts py-5 pt-lg-0">
    <div class="container py-5 pt-lg-0">
        <div class="row gx-0 bg-white p-3 rounded shadow-sm">
            <div class="ws">
                <div class="tanggal">
                    <script>
                        var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                        var myDays = ['Ahad', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum&#39;at', 'Sabtu'];
                        var date = new Date();
                        var day = date.getDate();
                        var month = date.getMonth();
                        var thisDay = date.getDay(),
                            thisDay = myDays[thisDay];
                        var yy = date.getYear();
                        var year = (yy < 1000) ? yy + 1900 : yy;
                        document.write(thisDay + ', ' + day + ' ' + months[month] + ' ' + year);
                    </script>
                </div>
                <style>
                    .ws {
                        padding: 0;
                        position: relative;
                        width: 100%;
                    }

                    .ws a {
                        text-decoration: none;
                    }

                    .ws .MPwidget {
                        width: 100%;
                        background: rgba(250, 250, 250, 0);
                        margin: 10px 0;
                        box-shadow: 0 0 0 rgba(250, 250, 250, 0);
                    }

                    .ws .MPheader {
                        background: rgba(250, 250, 250, 0);
                        padding: 0;
                        min-height: 30px;
                    }

                    .ws .MPheader .logo {
                        display: none;
                    }

                    .ws .MPheader .title,
                    .ws .tanggal {
                        padding: 0;
                        height: 30px;
                        line-height: 30px;
                        font-size: 20px;
                    }

                    .ws .MPwidget .title a,
                    .ws .tanggal {
                        color: #888;
                        font-family: 'Roboto', 'Open Sans', sans-serif;
                        font-weight: bold;
                        font-style: normal;
                        pointer-events: none;
                    }

                    .ws .tanggal {
                        position: absolute;
                        right: 0;
                        top: 0;
                        z-index: 20;
                        color: #dd3333;
                        float: right;
                    }

                    .ws .MPtimetable tr:first-child {
                        display: none;
                    }

                    .ws .MPtimetable tr {
                        display: inline-table;
                        /* width: 84px; */
                        width: 16.66%;
                        position: relative;
                    }

                    .ws .MPtimetable td {
                        position: relative;
                        display: table-row;
                        width: 74px;
                        padding: 25px;
                        text-align: center;
                        font-size: 10px;
                        height: 20px;
                        line-height: 35px;
                        background: rgba(250, 250, 250, 0);
                        text-transform: uppercase;
                        color: rgba(0, 0, 0, 0);
                    }

                    .ws .MPtimetable tr td:before {
                        font-size: 10px;
                        text-align: center;
                        position: absolute;
                        top: 0;
                        left: 0;
                        right: 0;
                        color: #333;
                        height: 20px;
                        line-height: 35px;
                    }

                    .ws .MPtimetable tr:nth-child(2) td:nth-child(1):before {
                        content: "SUBUH";
                    }

                    .ws .MPtimetable tr:nth-child(3) td:nth-child(1):before {
                        content: "TERBIT";
                    }

                    .ws .MPtimetable tr:nth-child(4) td:nth-child(1):before {
                        content: "DZUHUR";
                    }

                    .ws .MPtimetable tr:nth-child(5) td:nth-child(1):before {
                        content: "ASHAR";
                    }

                    .ws .MPtimetable tr:nth-child(6) td:nth-child(1):before {
                        content: "MAGHRIB";
                    }

                    .ws .MPtimetable tr:nth-child(7) td:nth-child(1):before {
                        content: "ISYA";
                    }

                    .ws .MPtimetable td:nth-child(2) {
                        font-size: 34px;
                        height: 50px;
                        line-height: 40px;
                        background: rgba(250, 250, 250, 0);
                        text-transform: uppercase;
                        text-align: center;
                        color: #7bae91
                    }

                    .ws .MPtimetable tr:nth-child(2n) {
                        background-color: #f7f7f7;
                    }

                    .ws .MPfooter {
                        display: none;
                    }

                    @media screen and (max-width:425px) {
                        .ws {
                            padding: 0;
                            position: relative;
                            width: 300px;
                        }

                        .ws a {
                            text-decoration: none;
                        }

                        .ws .MPwidget {
                            width: 100%;
                            background: rgba(250, 250, 250, 0);
                            margin: 10px 0;
                            box-shadow: 0 0 0 rgba(250, 250, 250, 0);
                        }

                        .ws .MPheader {
                            background: rgba(250, 250, 250, 0);
                            padding: 0;
                            min-height: 30px;
                            margin: 0 0 30px;
                        }

                        .ws .MPheader .logo {
                            display: none;
                        }

                        .ws .MPheader .title {
                            padding: 0;
                            height: 30px;
                            line-height: 30px;
                            font-size: 14px;
                        }

                        .ws .MPwidget .title a,
                        .ws .tanggal {
                            color: #888;
                            font-family: 'Roboto', 'Open Sans', sans-serif;
                            font-weight: bold;
                            font-style: normal;
                            pointer-events: none;
                        }

                        .ws .tanggal {
                            position: absolute;
                            left: 0;
                            top: 30px;
                            z-index: 20;
                            color: #dd3333;
                            float: left;
                            height: 20px;
                            line-height: 20px;
                            font-size: 12px;
                        }

                        .ws .MPtimetable tr:first-child {
                            display: none;
                        }

                        .ws .MPtimetable tr {
                            display: inline-table;
                            width: 100%;
                            position: relative;
                        }

                        .ws .MPtimetable td {
                            position: relative;
                            display: table-cell;
                            width: 50%;
                            padding: 5px;
                            text-align: left;
                            font-size: 14px;
                            height: 20px;
                            line-height: 20px;
                            background: rgba(250, 250, 250, 0);
                            text-transform: uppercase;
                            color: rgba(0, 0, 0, 0);
                        }

                        .ws .MPtimetable tr td:before {
                            font-size: 14px;
                            text-align: left;
                            position: absolute;
                            top: 0;
                            left: 10px;
                            right: 0;
                            color: #333;
                            height: 30px;
                            line-height: 30px;
                        }

                        .ws .MPtimetable tr:nth-child(2) td:nth-child(1):before {
                            content: "SUBUH";
                        }

                        .ws .MPtimetable tr:nth-child(3) td:nth-child(1):before {
                            content: "TERBIT";
                        }

                        .ws .MPtimetable tr:nth-child(4) td:nth-child(1):before {
                            content: "DZUHUR";
                        }

                        .ws .MPtimetable tr:nth-child(5) td:nth-child(1):before {
                            content: "ASHAR";
                        }

                        .ws .MPtimetable tr:nth-child(6) td:nth-child(1):before {
                            content: "MAGHRIB";
                        }

                        .ws .MPtimetable tr:nth-child(7) td:nth-child(1):before {
                            content: "ISYA";
                        }

                        .ws .MPtimetable td:nth-child(1) {
                            border-right: 1px solid #dedede
                        }

                        .ws .MPtimetable td:nth-child(2) {
                            color: #7bae91;
                            text-align: right;
                            padding-right: 10px;
                        }

                        .ws .MPtimetable tr:nth-child(2n) {
                            background-color: #f7f7f7;
                        }

                        .ws .MPfooter {
                            display: none;
                        }
                    }
                </style>
                <script src="https://www.muslimpro.com/muslimprowidget.js?cityid=<?= setting()->kota_id ?>&language=id&timeformat=24" async=""></script>
            </div>
        </div>
    </div>
</div>
<!-- jadwal Sholat Start -->

<!-- Berita Start -->
<div class="container-fluid pb-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
            <h4 class="fw-bold text-primary text-uppercase">Berita Terbaru</h4>
        </div>
        <div class="row g-5">
            <?php
            $jBerita = count($berita);
            if ($jBerita == 0) {
                echo '<center>Belum ada Berita</center>';
            } else {
                foreach ($berita as $b) {
            ?>
                    <div class="col-lg-4 wow slideInUp" data-wow-delay="0.3s">
                        <div class="blog-item bg-light rounded overflow-hidden">
                            <div class="blog-img position-relative overflow-hidden">
                                <?php if (!empty($b->gambar)) { ?>
                                    <img class="img-fluid" src="<?= base_url() ?>assets/images/berita/<?= $b->gambar ?>" alt="<?= $b->judul ?>">
                                <?php } else { ?>
                                    <img class="img-fluid" src="<?= base_url() ?>assets/images/no-image.jpg" alt="<?= $b->judul ?>">
                                <?php } ?>
                                <a class="position-absolute top-0 start-0 bg-primary text-white rounded-end mt-5 py-2 px-4" href="<?= base_url() ?>kategori/<?= $b->kategori_seo ?>"><?= $b->nm_kategori ?></a>
                            </div>
                            <div class="p-4">
                                <div class="d-flex mb-3">
                                    <small class="me-3"><i class="far fa-user text-primary me-2"></i><?= $b->created_by ?></small>
                                    <small><i class="far fa-calendar-alt text-primary me-2"></i><?= tgl_indo2($b->created_at) ?></small>
                                </div>
                                <a href="<?= base_url() ?>berita/<?= $b->id_berita ?>/<?= $b->judul_seo ?>">
                                    <h5 class="mb-3"><?= $b->judul; ?></h5>
                                </a>
                                <p><?= substr(strip_tags($b->isi_berita), 0, 100); ?>...</p>
                                <a href="<?= base_url() ?>berita/<?= $b->id_berita ?>/<?= $b->judul_seo ?>">Selengkapnya <i class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
            <?php }
            } ?>
        </div>
    </div>
</div>
<!-- Berita Start -->

<!-- Service Start -->
<div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
            <h4 class="fw-bold text-primary text-uppercase">LAYANAN</h4>
        </div>
        <div class="row g-5">
            <?php
            $jLayanan = count($layanan);
            if ($jLayanan == 0) {
                echo '<center>Belum ada Layanan</center>';
            } else {
                foreach ($layanan as $l) { ?>
                    <div class="col-md-4 wow zoomIn" data-wow-delay="0.3s">
                        <div class="service-item bg-light rounded d-flex flex-column align-items-center justify-content-center text-center">
                            <img src="<?= base_url(); ?>assets/images/halaman/<?= $l->gambar; ?>" alt="<?= $l->judul; ?>" title="<?= $l->judul; ?>" style="width: 50%; border-radius:50%" class="mt-3 mb-3" />
                            <a href="<?= base_url() ?>halaman/<?= $l->id_halaman ?>/<?= $l->judul_seo ?>">
                                <h5 class="mb-3"><?= $l->judul; ?></h5>
                            </a>
                            <p class="m-0"><?= $l->ringkasan_halaman; ?></p>
                            <a class="btn btn-lg btn-primary rounded" href="<?= base_url() ?>halaman/<?= $l->id_halaman ?>/<?= $l->judul_seo ?>">
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
            <?php }
            } ?>
        </div>
    </div>
</div>
<!-- Service End -->

<!-- Pengumuman dan Agenda Start -->
<div class="container-fluid bg-primary py-3 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="row g-5">
            <!-- Pengumuman -->
            <div class="col-md-7 wow zoomIn" data-wow-delay="0.3s">
                <div class="bg-white p-4 rounded d-flex flex-column" style="min-height: 380px;">
                    <div class="section-title section-title-sm position-relative pb-3 mb-4">
                        <h4 class="mb-0">Pengumuman</h4>
                    </div>
                    <?php
                    $jPengumuman = count($pengumuman);
                    // jika kosong
                    if ($jPengumuman == 0) {
                        echo '<center>Belum Ada Pengumuman</center>';
                    } else {
                        foreach ($pengumuman as $p) {
                    ?>
                            <div class="d-flex mb-3">
                                <i class="fas fa-circle text-primary mt-1 me-2"></i>
                                <p class="mb-0">
                                    <small><?= tgl_indo($p->created_at); ?></small><br>
                                    <a href="<?= base_url() ?>pengumuman/<?= $p->id_pengumuman ?>/<?= $p->pengumuman_seo ?>"><?= $p->nm_pengumuman; ?></a><br>
                                    <?= substr(strip_tags($p->isi_pengumuman), 0, 50); ?>...
                                </p>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <!-- Agenda -->
            <div class="col-md-5 wow zoomIn" data-wow-delay="0.3s">
                <div class="bg-white p-4 rounded d-flex flex-column" style="min-height: 380px;">
                    <div class="section-title section-title-sm position-relative pb-3 mb-4">
                        <h4 class="mb-0">Agenda</h4>
                    </div>
                    <?php
                    $jAgenda = count($agenda);
                    // jika kosong
                    if ($jAgenda == 0) {
                        echo '<center>Belum Ada Agenda</center>';
                    } else {
                        foreach ($agenda as $a) {
                    ?>
                            <div class="d-flex align-items-center mb-4 wow fadeIn" data-wow-delay="0.6s">
                                <div class="bg-primary align-items-center justify-content-center rounded text-white text-center" style="width: 60px; height: 60px;">
                                    <?= substr($a->tgl_mulai, 8, 2); ?>
                                    <div class="bg-dark py-2"><?= substr(getBulan(substr($a->tgl_mulai, 5, 2)), 0, 3); ?></div>
                                </div>
                                <div class="ps-3">
                                    <p class="mb-1"><a href="<?= base_url() ?>agenda/<?= $a->id_agenda ?>/<?= $a->agenda_seo ?>"><?= $a->nm_agenda; ?></a></p>
                                    <small class="text-muted mb-0"><?= $a->jam; ?></small>
                                </div>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Pengumuman dan Agenda End -->

<!-- Tausiyah dan Laporan Infak Start -->
<div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="row g-5">
            <!-- Tausiyah -->
            <div class="col-md-6">
                <div class="section-title position-relative pb-3 mb-5">
                    <h4 class="fw-bold text-primary text-uppercase">Tausiyah</h4>
                </div>
                <?php
                $jTausiyah = count($tausiyah);
                if ($jTausiyah == 0) {
                    echo 'Belum ada Tausiyah';
                } else {
                    foreach ($tausiyah as $t) {
                ?>
                        <div class="d-flex align-items-top pb-4 mb-2">
                            <img class="img-fluid rounded" src="<?= base_url() ?>assets/images/tausiyah/<?= $t->gambar ?>" style="width: 150px; max-height: 100px;">
                            <div class="ps-4">
                                <p class="text-primary mb-1"><a href="<?= base_url() ?>berita/<?= $t->id_berita ?>/<?= $t->judul_seo ?>"><?= $t->judul; ?></a></p>
                                <small><?= substr(strip_tags($t->isi_berita), 0, 80); ?>...</small>
                                <div class="d-flex mt-1">
                                    <small><small class="me-3"><i class="far fa-user text-primary me-2"></i><?= $t->created_by ?></small></small>
                                    <small><small><i class="far fa-calendar-alt text-primary me-2"></i><?= tgl_indo2($t->created_at) ?></small></small>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
            <div class="col-md-6" style="min-height: 500px;">
                <div class="section-title position-relative pb-3 mb-5">
                    <h4 class="fw-bold text-primary text-uppercase">Laporan Infaq</h4>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Dari</th>
                            <th class="text-end">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($infaq as $in) {
                        ?>
                            <tr>
                                <td><?= tgl_indo2($in->tanggal); ?></td>
                                <td><?= $in->keterangan; ?></td>
                                <td class="text-end"><?= format_rupiah($in->jml_dana); ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                <p class="mt-4">LAPORAN SALDO DANA INFAQ</p>
                <h4>SALDO : <span class="text-primary">Rp <?= format_rupiah($infaq_saldo); ?></span></h4>
                <a href="<?= base_url() ?>laporan-infaq">Laporan Infaq</a>
            </div>
        </div>
    </div>
</div>
<!-- Tausiyah dan Laporan Infak End -->

<!-- Galeri Foto dan Video Start -->
<div class="container-fluid bg-light py-3 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="row g-5">
            <!-- Galeri Foto -->
            <div class="col-md-6 wow zoomIn" data-wow-delay="0.3s">
                <div class="section-title section-title-sm position-relative pb-3 mb-4">
                    <h4 class="mb-0">Galeri Foto</h4>
                </div>
                <div class="row">
                    <?php
                    $jFoto = count($foto);
                    if ($jFoto == 0) {
                        echo 'Belum ada Galeri Foto';
                    } else {
                        foreach ($foto as $f) {
                    ?>
                            <div class="col-sm-4 mb-4">
                                <a href="<?= base_url() ?>assets/images/foto/<?= $f->gambar ?>" data-toggle="lightbox" data-gallery="mixedgallery">
                                    <img src="<?= base_url() ?>assets/images/foto/<?= $f->gambar ?>" alt="" class="img-fluid">
                                </a>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <!-- Galeri Video -->
            <div class="col-md-6 wow zoomIn" data-wow-delay="0.3s">
                <div class="section-title section-title-sm position-relative pb-3 mb-4">
                    <h4 class="mb-0">Video</h4>
                </div>
                <div class="row">
                    <?php
                    $jVideo = count($video);
                    if ($jVideo == 0) {
                        echo 'Belum ada Video';
                    } else {
                        foreach ($video as $v) {
                            $video = str_replace('watch?v=', 'embed/', $v->youtube);
                    ?>
                            <div class="col-sm-6 mb-4">
                                <div class="embed-responsive embed-responsive-16by9">
                                    <iframe class="embed-responsive-item" src="<?= $video ?>" title="<?= $v->nm_video ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                </div>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Galeri Foto dan Video End -->

<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script src="<?= base_url() ?>assets/templates/<?= templates()->folder ?>/lib/bs5-lightbox@1.2.8/bs5-lightbox.min.js"></script>
<?= $this->endSection() ?>