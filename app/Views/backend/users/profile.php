<?= $this->extend('backend/layout/app') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <?php if (session()->getFlashdata('pesan')) { ?>
                    <?= session()->getFlashdata('pesan'); ?>
                <?php } ?>
                <div class="row">
                    <?php if (!empty($user[0]->foto)) { ?>
                        <div class="col-md-3">
                            <img id="foto_ev" class="img-thumbnail " name="foto_ev" src="<?= base_url() ?>/assets/images/users/<?= $user[0]->foto ?>">
                        </div>
                    <?php } ?>
                    <div class="col-md-9">
                        <form id="form" method="POST" action="<?= base_url(); ?>/ladmin/users/ajax_update_profile" enctype="multipart/form-data">
                            <?= csrf_field(); ?>
                            <input type="hidden" value="<?= $user[0]->id_session ?>" id="id_session" name="id_session">
                            <input type="hidden" value="<?= $user[0]->foto ?>" id="foto_lm" name="foto_lm">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Username</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control form-control-sm" placeholder="Username" value="<?= $user[0]->username ?>" disabled>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Password</label>
                                <div class="col-sm-6">
                                    <input type="password" id="password" name="password" class="form-control form-control-sm" placeholder="Password">
                                    <div class="ketpassword"></div>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nama Lengkap</label>
                                <div class="col-sm-6">
                                    <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control form-control-sm" placeholder="Nama Lengkap" value="<?= $user[0]->nama_lengkap ?>" required>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-6">
                                    <input type="email" id="email" name="email" class="form-control form-control-sm" placeholder="Email" value="<?= $user[0]->email ?>" required>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kelas" class="col-sm-3 col-form-label">Level</label>
                                <div class="col-sm-6">
                                    <button class="btn btn-info btn-sm"><?= $user[0]->level; ?></button>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Upload Foto Profile</label>
                                <div class="col-sm-6">
                                    <img id="preview" style="max-height:100px;" /><a href="javascript:void(0)" style="display: none;" id="txt_hapus" class="text-danger" onclick="hapus()">Hapus (x)</a><br>
                                    <input id="foto" name="foto" type="file" class="form-control form-control-sm" accept="image/*" onchange="photoPreview(this,'preview')" placeholder="Foto">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-6">
                                    <button type="submit" class="btn btn-sm btn-success" id="btnSimpan">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('styles'); ?>
<link rel="stylesheet" href="<?= base_url() ?>assets/backend/plugins/toastr/toastr.min.css">
<?= $this->endSection(); ?>

<?= $this->section('javascript'); ?>
<script src="<?= base_url() ?>assets/backend/plugins/toastr/toastr.min.js"></script>
<script>
    // --- preview foto ---
    function photoPreview(photo, idpreview) {
        var gb = photo.files;
        for (var i = 0; i < gb.length; i++) {
            var gbPreview = gb[i];
            var imageType = /image.*/;
            var preview = document.getElementById(idpreview);
            var reader = new FileReader();
            if (gbPreview.type.match(imageType)) {
                //jika tipe data sesuai
                preview.file = gbPreview;
                reader.onload = (function(element) {
                    return function(e) {
                        element.src = e.target.result;
                    };
                })(preview);
                //membaca data URL gambar
                reader.readAsDataURL(gbPreview);
                $('#txt_hapus').show();
            } else {
                //jika tipe data tidak sesuai
                $('#foto').val('');
                toastr.error("Tipe file tidak sesuai. Gambar harus bertipe .png, .gif atau .jpg.");
            }
        }
    }

    // fungsi hapus foto
    function hapus() {
        $('#foto').val('');
        $('#preview').hide();
        $('#txt_hapus').hide();
    }
</script>
<?= $this->endSection(); ?>