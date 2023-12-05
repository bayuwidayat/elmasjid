<?= $this->extend('backend/layout/app') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <?php if (session()->getFlashdata('pesan')) : ?>
                    <?= session()->getFlashdata('pesan'); ?>
                <?php endif; ?>
                <form action="<?= base_url('ladmin/setting/update_logo'); ?>" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id_setting" id="id_setting" value="<?= $setting->id_setting; ?>">
                    <input type="hidden" name="fav_lm" id="fav_lm" value="<?= $setting->favicon; ?>">
                    <input type="hidden" name="foto_lm" id="foto_lm" value="<?= $setting->logo_website; ?>">

                    <div class="form-group row">
                        <label for="logo" class="col-sm-2 col-form-label">Favicon</label>
                        <div class="col-sm-6">
                            <?php if (!empty($setting->favicon)) { ?>
                                <img src="<?= base_url(); ?>/assets/images/<?= $setting->favicon; ?>" style="max-height: 64px;" id="preview_f_l" /><br>
                            <?php } ?>
                            <img id="preview_f" style="max-height:64px;" /><br>
                            <input type="file" id="foto_fav" name="foto_fav" class="form-control" accept="image/*" onchange="photoPreviewFav(this,'preview_f')">
                            <small>Disarankan ukuran gambar 128 x 128 px</small>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <label for="logo" class="col-sm-2 col-form-label">Logo Website</label>
                        <div class="col-sm-6">
                            <?php if (!empty($setting->logo_website)) { ?>
                                <img src="<?= base_url(); ?>/assets/images/<?= $setting->logo_website; ?>" style="max-height: 64px;" id="preview_l" /><br>
                            <?php } ?>
                            <img id="preview" style="max-height:128px;" /><br>
                            <input type="file" id="foto" name="foto" class="form-control" accept="image/*" onchange="photoPreview(this,'preview')">
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <label for="simpan" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10">
                            <input type="submit" class="btn btn-primary" value="SIMPAN">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<link rel="stylesheet" href="<?= base_url() ?>assets/backend/plugins/summernote/summernote-bs4.min.css">
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script src="<?= base_url() ?>assets/backend/plugins/summernote/summernote-bs4.min.js"></script>
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
                $('#preview_l').hide();
            } else {
                //jika tipe data tidak sesuai
                $('#foto').val('');
                toastr.error("Tipe file tidak sesuai. Gambar harus bertipe .png, .gif atau .jpg.");
            }
        }
    }

    function photoPreviewFav(photo, idpreview) {
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
                $('#preview_f_l').hide();
            } else {
                //jika tipe data tidak sesuai
                $('#foto_fav').val('');
                toastr.error("Tipe file tidak sesuai. Gambar harus bertipe .png, .gif atau .jpg.");
            }
        }
    }
</script>

<?= $this->endSection() ?>