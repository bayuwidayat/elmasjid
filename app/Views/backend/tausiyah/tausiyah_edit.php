<?= $this->extend('backend/layout/app') ?>

<?= $this->section('content') ?>
<form action="<?php echo site_url('ladmin/tausiyah/ajax_update'); ?>" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="form-group mb-3">
                        <input type="text" name="judul" class="form-control" placeholder="Judul Berita" value="<?= $tausiyah->judul ?>" required>
                    </div>
                    <div class="form-group mb-3">
                        <textarea id="summernote" name="isi_berita"><?= $tausiyah->isi_berita ?></textarea>
                    </div>
                </div>
            </div><!-- /.card -->
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label>Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="Y" <?php if ($tausiyah->status == 'Y') echo 'selected'; ?>>Publish</option>
                            <option value="N" <?php if ($tausiyah->status == 'N') echo 'selected'; ?>>Draft</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">Gambar</label>
                        <input type="file" id="foto" name="foto" class="form-control" accept="image/*" onchange="photoPreview(this,'preview')">
                        <?php if (!empty($tausiyah->gambar)) { ?>
                            <img src="<?= base_url(); ?>/assets/images/tausiyah/<?= $tausiyah->gambar; ?>" alt="" style="max-height:100px;" id="preview_l"><a href="javascript:void(0)" id="txt_hapus_l" class="text-danger" onclick="hapus_l(<?= $tausiyah->id_berita ?>)">Hapus (x)</a>
                        <?php } ?>
                        <img id="preview" style="max-height:100px;" class="mt-2" /><a href="javascript:void(0)" style="display: none;" id="txt_hapus" class="text-danger" onclick="hapus()">Hapus (x)</a><br>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">Tag</label>
                        <input type="text" id="tag" name="tag" class="form-control" value="<?= $tausiyah->tag ?>" placeholder="Tag. Pisahkan dengan koma">
                    </div>
                    <input type="hidden" value="<?= $tausiyah->id_berita; ?>" id="id_berita" name="id_berita">
                    <input type="hidden" value="<?= $tausiyah->gambar; ?>" id="gambar" name="gambar">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
            </div><!-- /.card -->
        </div>
    </div>
</form>
<?= $this->endSection(); ?>

<?= $this->section('styles') ?>
<link rel="stylesheet" href="<?= base_url() ?>assets/backend/plugins/summernote/summernote-bs4.min.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/backend/plugins/toastr/toastr.min.css">
<?= $this->endSection(); ?>

<?= $this->section('javascript') ?>
<script src="<?= base_url() ?>assets/backend/plugins/summernote/summernote-bs4.min.js"></script>
<script src="<?= base_url() ?>assets/backend/plugins/toastr/toastr.min.js"></script>
<script>
    $("#summernote").summernote({
        tabsize: 2,
        height: 300,
        minHeight: null, // set minimum height of editor
        maxHeight: null, // set maximum height of editor
        callbacks: {
            onImageUpload: function(image) {
                uploadImage(image[0]);
            },
            onMediaDelete: function(target) {
                deleteImage(target[0].src);
            }
        }
    });

    function uploadImage(image) {
        var data = new FormData();
        data.append("image", image);
        $.ajax({
            url: "<?php echo site_url('ladmin/tausiyah/upload_image') ?>",
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            type: "POST",
            success: function(url) {
                $('#summernote').summernote("insertImage", url);
            },
            error: function(data) {
                console.log(data);
            }
        });
    }

    function deleteImage(src) {
        $.ajax({
            data: {
                src: src
            },
            type: "POST",
            url: "<?php echo site_url('ladmin/tausiyah/delete_image') ?>",
            cache: false,
            success: function(response) {
                console.log(response);
            }
        });
    }

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
                $('#preview').show();
                $('#txt_hapus').show();
                $('#txt_hapus_l').hide();
                $('#preview_l').hide();
            } else {
                //jika tipe data tidak sesuai
                $('#foto').val('');
                toastr.error('Tipe file tidak sesuai. Gambar harus bertipe .png, .gif atau .jpg.')
            }
        }
    }

    // fungsi hapus foto
    function hapus() {
        $('#foto').val('');
        $('#preview').hide();
        $('#txt_hapus').hide();
        $('#preview_l').show();
        $('#txt_hapus_l').show();
    }

    // fungsi hapus foto lama
    function hapus_l(id) {
        $.ajax({
            url: "<?php echo base_url() ?>ladmin/tausiyah/delete_gambar/" + id,
            type: "POST",
            dataType: "JSON",
            success: function(data) {
                $('#preview_l').hide();
                $('#txt_hapus_l').hide();
                $('#gambar').val('');
            }
        });
    }
</script>
<?= $this->endSection(); ?>