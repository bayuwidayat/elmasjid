<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= (isset($title)) ? $title . ' - ' : ''; ?><?= setting()->nm_website; ?></title>
    <link rel="shortcut icon" href="<?= base_url() ?>assets/images/<?= setting()->favicon ?>" type="image/x-icon">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/backend/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/backend/dist/css/adminlte.min.css">
    <?= $this->renderSection('styles') ?>
</head>

<body class="hold-transition sidebar-mini text-sm" <?= isset(service('uri')->getSegments()[1]) ? ((service('uri')->getSegments()[1] == 'infaq') ? 'onload="saldo()"' : '') : ''; ?>>
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"><?= setting()->nm_website; ?></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url() ?>" target="_blank" title="Lihat Website">
                        <i class="fas fa-external-link-alt"></i>
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-user"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="<?= base_url() ?>ladmin/profile" class="dropdown-item">Profile</a>
                        <div class="dropdown-divider"></div>
                        <a href="<?= base_url() ?>logout" class="dropdown-item">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="<?= base_url() ?>ladmin" class="brand-link">
                <img src="<?= base_url() ?>assets/images/<?= setting()->favicon ?>" alt="Logo <?= setting()->nm_website ?>" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text"><?= setting()->nm_website ?></span>
            </a>

            <!-- Sidebar -->
            <?= $this->include('backend/layout/sidebar') ?>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0"><?= isset($title) ? $title : ''; ?></h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6 text-right">
                            <?= isset($add) ? $add : ''; ?>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <?= $this->renderSection('content') ?>
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                Developed by <a href="https://lintangdigital.com">lintangdigital</a>
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; <?= date('Y'); ?> <a href="<?= base_url() ?>"><?= setting()->nm_website; ?>.</a> Template by <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="<?= base_url() ?>assets/backend/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url() ?>assets/backend/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url() ?>assets/backend/dist/js/adminlte.min.js"></script>

    <?= $this->renderSection('javascript') ?>
</body>

</html>