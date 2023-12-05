<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title><?= (isset($title)) ? $title . ' | ' : ''; ?><?= setting()->nm_website; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="<?= setting()->meta_deskripsi; ?>" name="description" />
    <meta content="Bayu Widayat" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="<?= base_url(); ?>assets/images/<?= setting()->favicon; ?>">

    <!-- Theme Config Js -->
    <script src="<?= base_url(); ?>assets/backend/js/config.js"></script>

    <!-- App css -->
    <link href="<?= base_url(); ?>assets/backend/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons css -->
    <link href="<?= base_url(); ?>assets/backend/css/icons.min.css" rel="stylesheet" type="text/css" />
</head>

<body class="authentication-bg position-relative">
    <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5 position-relative">
        <div class="container">
            <div class="row justify-content-center">
                <!-- <div class="col-xxl-8 col-lg-10"> -->
                <div class="col-lg-6">
                    <div class="card overflow-hidden">
                        <!-- <div class="row g-0"> -->
                        <div class="d-flex flex-column h-100">
                            <div class="auth-brand p-4 pb-0 text-center">
                                <a href="<?= base_url(); ?>" class="logo-light">
                                    <img src="<?= base_url(); ?>assets/images/<?= setting()->logo_website; ?>" alt="logo" height="40">
                                </a>
                                <a href="<?= base_url(); ?>" class="logo-dark">
                                    <img src="<?= base_url(); ?>assets/images/<?= setting()->logo_website; ?>" alt="dark logo" height="40">
                                </a>
                            </div>
                            <div class="p-4 my-auto">
                                <?php if (session()->getFlashdata('pesan')) { ?>
                                    <?= session()->getFlashdata('pesan'); ?>
                                <?php } ?>
                                <h4 class="fs-20 text-center mb-3">Sign In</h4>
                                <!-- form -->
                                <form action="<?= base_url(); ?>auth/do_login" method="post">
                                    <div class="mb-3">
                                        <input class="form-control" type="text" id="username" name="username" required="" placeholder="Username">
                                    </div>
                                    <div class="mb-4">
                                        <input class="form-control" type="password" required="" id="password" name="password" placeholder="Password">
                                        <a href="<?= base_url() ?>lupa-password" class="text-muted float-end"><small>Lupa password?</small></a>
                                    </div>
                                    <div class="text-start">
                                        <button class="btn btn-soft-primary w-100" type="submit"><i class="ri-login-circle-fill me-1"></i> <span class="fw-bold">Log In</span> </button>
                                    </div>
                                </form>
                                <!-- end form-->
                            </div>
                        </div>
                    </div> <!-- end col -->
                    <!-- </div> -->
                    <!-- </div> -->
                </div>
                <!-- end row -->
            </div>
            <div class="row">
                <div class="col-12 text-center">
                    <p class="text-dark-emphasis">Kembali ke <a href="<?= base_url(); ?>" class="text-dark fw-bold ms-1 link-offset-3 text-decoration-underline"><b>Beranda</b></a>
                    </p>
                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->

    <footer class="footer footer-alt fw-medium">
        <span class="text-dark">
            <script>
                document.write(new Date().getFullYear())
            </script> © Velonic - Theme by Techzaa
        </span>
    </footer>
    <!-- Vendor js -->
    <script src="<?= base_url(); ?>assets/backend/js/vendor.min.js"></script>

    <!-- App js -->
    <script src="<?= base_url(); ?>assets/backend/js/app.min.js"></script>

</body>

</html>