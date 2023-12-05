<?= $this->extend('backend/layouts/auth') ?>

<?= $this->section('content') ?>
<div class="row h-100">
    <div class="col-lg-5 col-12">
        <div id="auth-left">
            <div class="auth-logo">
                <a href="<?= base_url() ?>"><img src="<?= base_url() ?>assets/images/<?= setting()->logo_website; ?>" alt="<?= setting()->nm_website; ?>"></a>
            </div>
            <h1 class="auth-title">Log in.</h1>

            <?php if (session()->getFlashdata('pesan')) { ?>
                <?= session()->getFlashdata('pesan'); ?>
            <?php } ?>

            <form action="<?= base_url(); ?>auth/do_login" method="post">
                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="text" class="form-control form-control-xl" name="username" id="username" placeholder="Username">
                    <div class="form-control-icon">
                        <i class="bi bi-person"></i>
                    </div>
                </div>
                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="password" class="form-control form-control-xl" name="password" id="password" placeholder="Password">
                    <div class="form-control-icon">
                        <i class="bi bi-shield-lock"></i>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg">Log in</button>
            </form>
            <div class="text-center mt-3 text-lg">
                <p class="text-gray-600">Kembali ke <a href="<?= base_url(); ?>" class="font-bold">Beranda</p>
                <p><a class="font-bold" href="<?= base_url() ?>lupa-password">Lupa password?</a>.</p>
            </div>
        </div>
    </div>
    <div class="col-lg-7 d-none d-lg-block">
        <div id="auth-right">

        </div>
    </div>
</div>
<?= $this->endSection() ?>