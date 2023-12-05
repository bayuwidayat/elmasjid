<?php
// pengalihan jika kondisi username dalam keadaan login
if (session()->get('uname') != '' || session()->get('uname') != null) {
    header('Location: ' . base_url());
    exit;
}
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
</head>

<body>
    <div class="container-fluid align-items-centerpy-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container text-center py-5">
            <div class="row justify-content-center py-5">
                <div class="col-lg-6">
                    <img src="<?= base_url() ?>assets/images/<?= setting()->logo_website ?>" alt="<?= setting()->nm_website ?>" title="<?= setting()->nm_website ?>" style="max-height: 40px;" class="mb-4">
                    <h1 class="mb-4">System Maintenance!</h1>
                    <p class="mb-4">Mohon maaf website sedang masa maintenance, kami akan segera kembali setelah masa maintenance selesai. Terima kasih</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded back-to-top"><i class="fas fa-arrow-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="<?= base_url() ?>assets/templates/<?= templates()->folder ?>/js/jquery-3.4.1.min.js"></script>
    <script src="<?= base_url() ?>assets/templates/<?= templates()->folder ?>/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() ?>assets/templates/<?= templates()->folder ?>/lib/wow/wow.min.js"></script>
    <script src="<?= base_url() ?>assets/templates/<?= templates()->folder ?>/lib/easing/easing.min.js"></script>
    <script src="<?= base_url() ?>assets/templates/<?= templates()->folder ?>/lib/waypoints/waypoints.min.js"></script>
    <!-- Template Javascript -->
    <script src="<?= base_url() ?>assets/templates/<?= templates()->folder ?>/js/main.js"></script>
</body>

</html>