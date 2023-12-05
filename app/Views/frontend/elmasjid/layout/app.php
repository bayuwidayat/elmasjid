<?php if (setting()->maintenance == 'Y') {
    // pengalihan jika kondisi username dalam keadaan login
    if (session()->get('uname') == '' || session()->get('uname') == null) {
        header('Location: ' . base_url() . 'maintenance');
        exit;
    }
}

use App\Models\MenusModel;
use App\Models\SekilasinfoModel;
use App\Models\StatistikModel;

$MM = new MenusModel();
$SIM = new SekilasinfoModel();
$model = new StatistikModel();
$menus = $MM->get_menus_utama('Y');
$si = $SIM->get_sekilasinfo(5, 'ASC', 'Y');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?= isset($title) ? $title . ' - ' : ''; ?><?= setting()->nm_website ?></title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="<?= (isset($keyword)) ? $keyword : setting()->meta_keyword ?>" name="keywords">
    <meta content="<?= (isset($deskripsi)) ? $deskripsi : setting()->meta_deskripsi ?>" name="description">
    <meta content="Bayu Widayat" name="author">
    <link rel="canonical" href="<?= current_url(); ?>" />
    <meta property="og:type" content="<?= (current_url() == base_url()) ? 'website' : 'article'; ?>" />
    <meta property="og:title" content="<?= (isset($keyword)) ? $keyword : setting()->meta_keyword ?>" />
    <meta property="og:description" content="<?= (isset($deskripsi)) ? $deskripsi : setting()->meta_deskripsi ?>" />
    <meta property="og:url" content="<?= current_url(); ?>" />
    <meta property="og:site_name" content="<?= setting()->nm_website; ?>" />
    <meta property="og:image" content="<?= (isset($gambar)) ? $gambar : base_url() . 'assets/images/' . setting()->logo_website; ?>" />

    <!-- Favicon -->
    <link href="<?= base_url() ?>assets/images/<?= setting()->favicon ?>" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&family=Rubik:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="<?= base_url() ?>assets/templates/<?= templates()->folder ?>/lib/fontawesome-free-5.15.4-web/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="<?= base_url() ?>assets/templates/<?= templates()->folder ?>/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/templates/<?= templates()->folder ?>/lib/animate/animate.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="<?= base_url() ?>assets/templates/<?= templates()->folder ?>/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="<?= base_url() ?>assets/templates/<?= templates()->folder ?>/css/style.css" rel="stylesheet">
    <?= $this->renderSection('styles') ?>
    <?= setting()->cdx_header; ?>
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid bg-dark">
        <div class="row gx-0">
            <div class="col-lg-12 mb-2 mb-lg-0">
                <div class="d-flex align-items-center text-light" style="height: 45px; transition: all 0.5s ease 0.1s;">
                    <marquee behavior="" direction="left">
                        <?php foreach ($si as $si) { ?>
                            <span class="me-5"><?= $si->info ?></span>
                        <?php } ?>
                    </marquee>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->

    <!-- Navbar Start -->
    <div class="container-fluid position-relative p-0">
        <nav class="navbar navbar-expand-lg navbar-light shadow-sm px-5 py-3 py-lg-3">
            <a href="<?= base_url() ?>" class="navbar-brand p-0">
                <?php if (setting()->logo_website != '') { ?><img src="<?= base_url() ?>assets/images/<?= setting()->logo_website ?>" alt="<?= setting()->nm_website ?>" style="max-height: 40px;">
                <?php } else { ?>
                    <h1 class="m-0"><?= setting()->nm_website; ?></h1>
                <?php } ?>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0">
                    <?php
                    foreach ($menus as $m) {
                        $submenu = $MM->get_sub_menus($m->id_menus);
                        $jsb = count($submenu);
                        if ($jsb == 0) {
                    ?>
                            <a href="<?= ($m->tipe == 'links') ? $m->url : base_url() . $m->url; ?>" class="nav-item nav-link" target="<?= $m->target ?>"><?= $m->nm_menus; ?></a>
                        <?php } else { ?>
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><?= $m->nm_menus; ?></a>
                                <div class="dropdown-menu m-0">
                                    <?php foreach ($submenu as $sm) { ?>
                                        <a href="<?= ($sm->tipe == 'links') ? $sm->url : base_url() . $sm->url; ?>" class="dropdown-item" target="<?= $sm->target ?>"><?= $sm->nm_menus; ?></a>
                                    <?php } ?>
                                </div>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>
                <butaton type="button" class="btn text-primary ms-3" data-bs-toggle="modal" data-bs-target="#searchModal"><i class="fa fa-search"></i></butaton>
            </div>
        </nav>
    </div>
    <!-- Navbar End -->

    <!-- Full Screen Search Start -->
    <div class="modal fade" id="searchModal" tabindex="-1">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content" style="background: rgba(9, 30, 62, .7);">
                <div class="modal-header border-0">
                    <button type="button" class="btn bg-white btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex align-items-center justify-content-center">
                    <form action="<?= base_url() ?>s">
                        <div class="input-group" style="max-width: 600px;">
                            <input type="text" class="form-control bg-transparent border-primary p-3" name="s" required placeholder="Ketikkan kata kunci pencarian">
                            <button class="btn btn-primary px-4"><i class="fa fa-search"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Full Screen Search End -->

    <?= $this->renderSection('content') ?>

    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="row gx-5">
                <div class="col-md-4 pt-5 mb-5">
                    <div class="section-title section-title-sm position-relative pb-3 mb-4">
                        <h3 class="text-light mb-0"><?= setting()->nm_website; ?></h3>
                    </div>
                    <div class="link-animated d-flex flex-column justify-content-start">
                        <a class="text-light mb-2" href="#"><i class="fa fa-map text-white me-2"></i><?= setting()->alamat; ?></a>
                        <a class="text-light mb-2" href="#"><i class="fa fa-envelope text-white me-2"></i><?= setting()->email; ?></a>
                        <a class="text-light mb-2" href="#"><i class="fa fa-phone text-white me-2"></i><?= setting()->no_telp; ?></a>
                        <a class="text-light mb-2" href="#"><i class="fab fa-whatsapp text-white me-2"></i><?= setting()->no_wa; ?></a>
                    </div>
                </div>
                <div class="col-md-4 pt-5 mb-5">
                    <div class="section-title section-title-sm position-relative pb-3 mb-4">
                        <h3 class="text-light mb-0">Quick Links</h3>
                    </div>
                    <div class="link-animated d-flex flex-column justify-content-start">
                        <a class="text-light mb-2" href="<?= base_url() ?>"><i class="fa fa-arrow-right text-primary me-2"></i>Home</a>
                        <a class="text-light mb-2" href="<?= base_url() ?>profil"><i class="fa fa-arrow-right text-primary me-2"></i>Profil</a>
                        <a class="text-light mb-2" href="<?= base_url() ?>layanan"><i class="fa fa-arrow-right text-primary me-2"></i>Layanan</a>
                        <a class="text-light mb-2" href="<?= base_url() ?>takmir"><i class="fa fa-arrow-right text-primary me-2"></i>Takmir</a>
                        <a class="text-light mb-2" href="<?= base_url() ?>tausiyah"><i class="fa fa-arrow-right text-primary me-2"></i>Tausiyah</a>
                        <a class="text-light" href="<?= base_url() ?>laporan-infaq"><i class="fa fa-arrow-right text-primary me-2"></i>Laporan Infaq</a>
                    </div>
                </div>
                <div class="col-md-4 pt-5 mb-5">
                    <div class="section-title section-title-sm position-relative pb-3 mb-4">
                        <h3 class="text-light mb-0">Sosial media</h3>
                    </div>
                    <div class="d-flex mt-4">
                        <?php if (setting()->twitter != '') { ?><a class="btn btn-primary btn-square me-2" href="<?= setting()->twitter ?>"><i class="fab fa-twitter fw-normal"></i></a><?php } ?>
                        <?php if (setting()->facebook != '') { ?><a class="btn btn-primary btn-square me-2" href="<?= setting()->facebook ?>"><i class="fab fa-facebook-f fw-normal"></i></a><?php } ?>
                        <?php if (setting()->linkedin != '') { ?><a class="btn btn-primary btn-square me-2" href="<?= setting()->linkedin ?>"><i class="fab fa-linkedin-in fw-normal"></i></a><?php } ?>
                        <?php if (setting()->instagram != '') { ?><a class="btn btn-primary btn-square me-2" href="<?= setting()->instagram ?>"><i class="fab fa-instagram fw-normal"></i></a><?php } ?>
                        <?php if (setting()->youtube != '') { ?><a class="btn btn-primary btn-square me-2" href="<?= setting()->youtube ?>"><i class="fab fa-youtube fw-normal"></i></a><?php } ?>
                        <?php if (setting()->tiktok != '') { ?><a class="btn btn-primary btn-square" href="<?= setting()->tiktok ?>"><i class="fab fa-tiktok fw-normal"></i></a><?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid text-white" style="background: #061429;">
        <div class="container text-center">
            <div class="row justify-content-center">
                <div class="d-flex align-items-center justify-content-center" style="height: 75px;">
                    <small class="mb-0">&copy; <a class="text-white border-bottom text-muted" href="<?= base_url() ?>"><?= setting()->nm_website; ?></a>. All Rights Reserved.
                        <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                        Designed by <a class="text-white border-bottom" href="https://htmlcodex.com">HTML Codex</a>.
                        Developed By: <a class="border-bottom" href="https://lintangdigital.com" target="_blank">LintangDigital</a>
                    </small>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary btn-square rounded back-to-top"><i class="fas fa-arrow-up"></i></a>

    <?php
    if (setting()->btn_wa == 'Y') {
        $teks = urlencode(setting()->pesan_wa);
    ?>
        <div id="kontak-bar">
            <a href="https://api.whatsapp.com/send/?phone=<?= setting()->no_wa; ?>&text=<?= $teks; ?>&type=phone_number&app_absent=0" target="_blank" class="btn btn-success"><span class="fab fa-whatsapp"></span> Chat dengan kami via Whatsapp</a> </a>
        </div>


        <style>
            #kontak-bar {
                position: fixed;
                bottom: -50px;
                <?= (setting()->letak_wa == 'kanan') ? "right: 10px;" : "left: 10px;"; ?>z-index: 999;
                height: 100px;
            }

            #kontak-bar a {
                box-shadow: 0px 5px 5px 0px rgba(0, 0, 0, 0.59);
                -webkit-box-shadow: 0px 5px 5px 0px rgba(0, 0, 0, 0.59);
                -moz-box-shadow: 0px 5px 5px 0px rgba(0, 0, 0, 0.59);
            }
        </style>
    <?php
    }
    ?>

    <?php // hitung statistik pengunjung
    $request = \Config\Services::request();
    $ip = $request->getIPAddress(); // mendapatkan ip address
    $date  = date("Y-m-d"); // Mendapatkan tanggal sekarang
    $waktu = time(); // mendapatkan waktu
    $timeinsert = date("Y-m-d H:i:s"); // mendapatkan tanggal dan waktu sekarang

    // Cek berdasarkan IP, apakah user sudah pernah mengakses hari ini
    $sql = $model->get_statistik(['ip' => $ip, 'tanggal' => $date]);
    $s = count($sql);
    $ss = isset($s) ? ($s) : 0;

    // jika belum ada, simpan data user tersebut ke database
    if ($ss == 0) {
        $datas['ip'] = $ip;
        $datas['tanggal'] = $date;
        $datas['hits'] = 1;
        $datas['online'] = $waktu;
        $datas['time'] = $timeinsert;
        $model->save_statistik($datas);
    }
    // jika sudah ada, update
    else {
        $datau['hits'] = $sql[0]->hits + 1;
        $datau['online'] = $waktu;
        $datau['last_time'] = $timeinsert;
        $w['ip'] = $ip;
        $w['tanggal'] = $date;
        $model->update_statistik($datau, $w);
    }
    ?>

    <!-- JavaScript Libraries -->
    <script src="<?= base_url() ?>assets/templates/<?= templates()->folder ?>/js/jquery-3.4.1.min.js"></script>
    <script src="<?= base_url() ?>assets/templates/<?= templates()->folder ?>/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() ?>assets/templates/<?= templates()->folder ?>/lib/wow/wow.min.js"></script>
    <script src="<?= base_url() ?>assets/templates/<?= templates()->folder ?>/lib/easing/easing.min.js"></script>
    <script src="<?= base_url() ?>assets/templates/<?= templates()->folder ?>/lib/waypoints/waypoints.min.js"></script>
    <script src="<?= base_url() ?>assets/templates/<?= templates()->folder ?>/lib/counterup/counterup.min.js"></script>
    <script src="<?= base_url() ?>assets/templates/<?= templates()->folder ?>/lib/owlcarousel/owl.carousel.min.js"></script>
    <!-- Template Javascript -->
    <script src="<?= base_url() ?>assets/templates/<?= templates()->folder ?>/js/main.js"></script>

    <?= $this->renderSection('javascript') ?>

    <?= setting()->cdx_footer; ?>
</body>

</html>