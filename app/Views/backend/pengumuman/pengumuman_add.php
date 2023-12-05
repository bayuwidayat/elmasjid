<?= $this->extend('backend/layout/app') ?>

<?= $this->section('content') ?>
<form action="<?php echo site_url('ladmin/pengumuman/ajax_save'); ?>" method="post" enctype="multipart/form-data">
    <?= csrf_field(); ?>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="form-group mb-3">
                        <input type="text" name="judul" class="form-control form-control-sm" placeholder="Judul Pengumuman" required>
                    </div>
                    <div class="form-group mb-3">
                        <textarea id="summernote" name="isi_pengumuman"></textarea>
                    </div>
                </div>
            </div><!-- /.card -->
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label class="form-label">File</label>
                        <input type="file" id="file_pengumuman" name="file_pengumuman" class="form-control form-control-sm" onchange="validasiEkstensi(this)">
                        <small>Silahkan upload file berekstensi .jpeg/.jpg/.png/.gif/.jiff/.xls/.xlsx/.doc/.docx/.pdf/.zip</small><br>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    <button type="reset" class="btn btn-secondary btn-sm">Reset</button>
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
            url: "<?php echo site_url('ladmin/pengumuman/upload_image') ?>",
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
            url: "<?php echo site_url('ladmin/pengumuman/delete_image') ?>",
            cache: false,
            success: function(response) {
                console.log(response);
            }
        });
    }

    function validasiEkstensi(id) {
        var pathFile = id.value;
        var ekstensiOk = /(\.jpg|\.jpeg|\.png|\.gif|\.jiff|\.xls|\.xlsx|\.doc|\.docx|\.pdf|\.zip)$/i;
        if (!ekstensiOk.exec(pathFile)) {
            toastr.error('Silakan upload file yang dengan ekstensi .jpeg/.jpg/.png/.gif/.jiff/.xls/.xlsx/.doc/.docx/.pdf/.zip');
            id.value = '';
            return false;
        }
    }
</script>
<?= $this->endSection(); ?>