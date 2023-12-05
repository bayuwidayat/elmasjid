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
<div class="container-fluid pb-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <?= setting()->google_map; ?>
            </div>
            <div class="col-md-6 wow fadeInUp">
                <div class="d-flex align-items-center mb-4 wow fadeIn" data-wow-delay="0.3s">
                    <div class="bg-primary d-flex align-items-center justify-content-center rounded" style="width: 60px; height: 60px;">
                        <i class="fa fa-phone-alt text-white"></i>
                    </div>
                    <div class="ps-4">
                        <h5 class="mb-2">Telepon</h5>
                        <h4 class="text-primary mb-0"><?= setting()->no_telp; ?></h4>
                    </div>
                </div>

                <div class="d-flex align-items-center mb-4 wow fadeIn" data-wow-delay="0.5s">
                    <div class="bg-primary d-flex align-items-center justify-content-center rounded" style="width: 60px; height: 60px;">
                        <i class="fab fa-whatsapp text-white"></i>
                    </div>
                    <div class="ps-4">
                        <h5 class="mb-2">Whatsapp</h5>
                        <h4 class="text-primary mb-0"><?= setting()->no_wa; ?></h4>
                    </div>
                </div>

                <div class="d-flex align-items-center mb-4 wow fadeIn" data-wow-delay="0.7s">
                    <div class="bg-primary d-flex align-items-center justify-content-center rounded" style="width: 60px; height: 60px;">
                        <i class="fa fa-envelope-open text-white"></i>
                    </div>
                    <div class="ps-4">
                        <h5 class="mb-2">Email</h5>
                        <h4 class="text-primary mb-0"><?= setting()->email; ?></h4>
                    </div>
                </div>

                <div class="d-flex align-items-center mb-4 wow fadeIn" data-wow-delay="0.9s">
                    <div class="bg-primary d-flex align-items-center justify-content-center rounded" style="min-width: 60px; height: 60px;">
                        <i class="fa fa-map-marker-alt text-white"></i>
                    </div>
                    <div class="ps-4">
                        <h5 class="mb-2">Alamat</h5>
                        <h4 class="text-primary mb-0"><?= setting()->alamat; ?></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Infaq Start -->

<?= $this->endSection() ?>