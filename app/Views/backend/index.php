<?= $this->extend('backend/layout/app') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-newspaper"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Berita</span>
                <span class="info-box-number">
                    <?= $berita; ?>
                </span>
            </div><!-- /.info-box-content -->
        </div><!-- /.info-box -->
    </div>
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-copy"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Halaman</span>
                <span class="info-box-number">
                    <?= $halaman; ?>
                </span>
            </div><!-- /.info-box-content -->
        </div><!-- /.info-box -->
    </div>
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-users"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">User</span>
                <span class="info-box-number">
                    <?= $users; ?>
                </span>
            </div><!-- /.info-box-content -->
        </div><!-- /.info-box -->
    </div>
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-donate"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Saldo Infaq</span>
                <span class="info-box-number">
                    Rp <?= format_rupiah($saldo); ?>
                </span>
            </div><!-- /.info-box-content -->
        </div><!-- /.info-box -->
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="card">
            <div class="card-header">
                <h5 class="m-0">Application Buttons</h5>
            </div>
            <div class="card-body">
                <p>Silahkan klik menu pilihan yang berada di sebelah kiri untuk mengelola konten website anda atau pilih ikon-ikon pada Control Panel di bawah ini</p>
                <a href="<?= base_url('ladmin/berita'); ?>" class="btn btn-outline-primary waves-effect waves-light m-2">Berita</a>
                <a href="<?= base_url('ladmin/halaman'); ?>" class="btn btn-outline-secondary waves-effect waves-light m-2">Halaman</a>
                <a href="<?= base_url('ladmin/foto'); ?>" class="btn btn-outline-warning waves-effect waves-light m-2">Galeri Foto</a>
                <a href="<?= base_url('ladmin/video'); ?>" class="btn btn-outline-dark waves-effect waves-light m-2">Galeri Video</a>
                <a href="<?= base_url('ladmin/slider'); ?>" class="btn btn-outline-danger waves-effect waves-light m-2">Slide Gambar</a>
                <a href="<?= base_url('ladmin/users'); ?>" class="btn btn-outline-primary waves-effect waves-light m-2">User</a>
                <a href="<?= base_url('ladmin/takmir'); ?>" class="btn btn-outline-secondary waves-effect waves-light m-2">Takmir</a>
                <a href="<?= base_url('ladmin/tausiyah'); ?>" class="btn btn-outline-success waves-effect waves-light m-2">Tausiyah</a>
                <a href="<?= base_url('ladmin/infaq'); ?>" class="btn btn-outline-warning waves-effect waves-light m-2">Infaq</a>
                <a href="<?= base_url('ladmin/jadwal'); ?>" class="btn btn-outline-dark waves-effect waves-light m-2">Jadwal Jumat</a>
                <a href="<?= base_url('ladmin/agenda'); ?>" class="btn btn-outline-danger waves-effect waves-light m-2">Agenda</a>
                <a href="<?= base_url('ladmin/pengumuman'); ?>" class="btn btn-outline-primary waves-effect waves-light m-2">Pengumuman</a>
            </div>
        </div>
    </div><!-- /.col-md-6 -->

    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h5 class="m-0">Grafik Kunjungan</h5>
            </div>
            <div class="card-body">
                <div class="position-relative mb-4">
                    <canvas id="sales-chart" height="250"></canvas>
                </div>
            </div>
        </div>
    </div><!-- /.col-md-6 -->
</div>
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script src="<?= base_url() ?>assets/backend/plugins/chart.js/Chart.min.js"></script>
<script>
    <?php
    foreach ($grafik as $row) {
        $tanggal[] = tgl_indo($row->tanggal);
        $jumlah[] = $row->jumlah;
    }
    ?>

    $(function() {
        'use strict'

        var ticksStyle = {
            fontColor: '#495057',
            fontStyle: 'bold'
        }

        var mode = 'index'
        var intersect = true

        var $salesChart = $('#sales-chart')
        // eslint-disable-next-line no-unused-vars
        var salesChart = new Chart($salesChart, {
            type: 'bar',
            data: {
                labels: <?= json_encode($tanggal) ?>,
                datasets: [{
                    backgroundColor: '#007bff',
                    borderColor: '#007bff',
                    data: <?= json_encode($jumlah) ?>
                }]
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    mode: mode,
                    intersect: intersect
                },
                hover: {
                    mode: mode,
                    intersect: intersect
                },
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        gridLines: {
                            display: true,
                            lineWidth: '4px',
                            color: 'rgba(0, 0, 0, .5)',
                            zeroLineColor: 'transparent'
                        },
                        ticks: $.extend({
                            beginAtZero: true,

                            // Include a dollar sign in the ticks
                            callback: function(value) {
                                if (value >= 1000) {
                                    value /= 1000
                                    value += 'k'
                                }

                                return value
                            }
                        }, ticksStyle)
                    }],
                    xAxes: [{
                        display: true,
                        gridLines: {
                            display: false
                        },
                        ticks: ticksStyle
                    }]
                }
            }
        })
    })
</script>
<?= $this->endSection() ?>