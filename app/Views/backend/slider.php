<?= $this->extend('backend/layout/app') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <table id="datatable" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Foto Slider</th>
                            <th>Nama Slider</th>
                            <th>Aktif</th>
                            <th>Username</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Data-->
<div class="modal fade" id="modal_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form" method="POST" action="#" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <input type="hidden" value="" id="id_slider" name="id_slider">
                    <input type="hidden" value="" id="foto_lm" name="foto_lm">
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Gambar</label>
                        <div class="col-sm-8">
                            <img id="foto_ev" name="foto_ev" src="" style="max-height:50px">
                            <img id="preview" style="max-height:80px;" /><br>
                            <input id="foto" name="foto" type="file" class="form-control form-control-sm" accept="image/*" placeholder="Foto">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Nama Slider</label>
                        <div class="col-sm-8">
                            <input type="text" id="nm_slider" name="nm_slider" class="form-control form-control-sm" placeholder="Nama Slider" required>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Keterangan</label>
                        <div class="col-sm-8">
                            <input type="text" id="ket_slider" name="ket_slider" class="form-control form-control-sm" placeholder="Keterangan" required>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Text Link</label>
                        <div class="col-sm-8">
                            <input type="text" id="text_link" name="text_link" class="form-control form-control-sm" placeholder="Text Link" required>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">URL Link</label>
                        <div class="col-sm-8">
                            <input type="text" id="link" name="link" class="form-control form-control-sm" placeholder="URL Link" required>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="form-group row" id="aktif_v">
                        <label class="col-sm-4 col-form-label">Aktif</label>
                        <div class="col-sm-8">
                            <select name="aktif" id="aktif" class="form-control form-control-sm">
                                <option value="Y">Ya</option>
                                <option value="N">Tidak</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-success" id="btnSimpan" onclick="simpan()">Simpan</button>
                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<link rel="stylesheet" href="<?= base_url() ?>assets/backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/backend/plugins/toastr/toastr.min.css">
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script src="<?= base_url() ?>assets/backend/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>assets/backend/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url() ?>assets/backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>assets/backend/plugins/alertify/js/alertify.js"></script>
<script src="<?= base_url() ?>assets/backend/plugins/toastr/toastr.min.js"></script>
<script>
    var table = $('#datatable').DataTable({
        "processing": true,
        "serverside": true,
        "order": [],
        "searching": true,
        "paging": true,
        "autoWidth": false,
        "responsive": true,
        "ajax": {
            "url": "<?= base_url(); ?>ladmin/slider/ajax_list_slider",
            "type": "POST"
        },
    });


    function reload_table() {
        table.ajax.reload();
    }

    function readURL(input) {
        if (input.files && input.files[0]) {
            var imageType = /image.*/;
            var reader = new FileReader();
            if (input.files[0].type.match(imageType)) {
                reader.onload = function(e) {
                    $('#preview').show();
                    $('#preview').attr('src', e.target.result);
                    $('#foto_ev').hide();
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                //jika tipe data tidak sesuai
                $('#foto').val('');
                toastr.error("Tipe file tidak sesuai. Gambar harus bertipe .png, .gif atau .jpg.");
            }
        }
    }

    // --- fungsi tambah data ---
    function tambah() {
        save_method = 'tambah';
        $('#form')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();
        $('#foto_ev').hide();
        $('#preview').hide();
        $('#modal_form').modal('show');
        $('.modal-title').text('Tambah Slide');
        $('#aktif_v').hide();
        $("#foto").change(function() {
            readURL(this);
        });
    }

    // --- fungsi edit data ---
    function edit(id) {
        save_method = 'ubah';
        $('#form')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();
        $('#preview').hide();

        $.ajax({
            url: "<?= base_url(); ?>ladmin/slider/edit/" + id,
            type: "POST",
            dataType: "JSON",
            success: function(data) {
                $('[name="id_slider"]').val(data.id_slider);
                $('[name="foto_lm"]').val(data.gambar);
                $('[name="nm_slider"]').val(data.nm_slider);
                $('[name="ket_slider"]').val(data.ket_slider);
                $('[name="link"]').val(data.link);
                $('[name="text_link"]').val(data.text_link);
                $('[name="aktif"]').val(data.aktif);

                if (data.gambar == '') {
                    $('#foto_ev').hide();
                } else {
                    $('[name="foto_ev"]').attr('src', '<?= base_url() ?>/assets/images/slider/' + data.gambar);
                    $('#foto_ev').show();
                }
                $('#modal_form').modal('show');
                $('.modal-title').text('Edit Data');
                $('#aktif_v').show();
                $("#foto").change(function() {
                    readURL(this);
                });
            },
            error: function(jqXHR, textStatus, errorThrown) {
                toastr.error('Error getting data from ajax');
            }
        });

    }

    // --- fungsi simpan data ---
    function simpan() {
        $('#btnSimpan').text('Menyimpan...');
        $('#btnSimpan').attr('disabled', true);
        var url;
        if (save_method == 'tambah') {
            url = '<?= base_url(); ?>/ladmin/slider/ajax_save';
        } else {
            url = '<?= base_url(); ?>/ladmin/slider/ajax_update';
        }

        var id_slider = $('#id_slider').val();
        var foto_lm = $('#foto_lm').val();
        var nm_slider = $('#nm_slider').val();
        var ket_slider = $('#ket_slider').val();
        var link = $('#link').val();
        var text_link = $('#text_link').val();
        var aktif = $('#aktif').val();
        var foto = $('#foto').prop('files')[0];

        var formData = new FormData();

        formData.append('id_slider', id_slider);
        formData.append('foto_lm', foto_lm);
        formData.append('nm_slider', nm_slider);
        formData.append('ket_slider', ket_slider);
        formData.append('link', link);
        formData.append('text_link', text_link);
        formData.append('aktif', aktif);
        formData.append('foto', foto);

        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            dataType: "JSON",
            success: function(data) {
                if (data.status) {
                    $('#modal_form').modal('hide');
                    reload_table();
                } else {
                    for (var i = 0; i < data.inputerror.length; i++) {
                        $('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error');
                        $('[name="' + data.inputerror[i] + '"]').next().next(data.error_string[i]);
                    }
                }
                $('#btnSimpan').text('Simpan');
                $('#btnSimpan').attr('disabled', false);
                $("#form")[0].reset();
                toastr.success("Data Berhasil Disimpan");
            },
            error: function(jqXHR, textStatus, errorThrown) {
                toastr.error('Error adding / update data');
                $('#btnSimpan').text('Simpan');
                $('#btnSimpan').attr('disabled', false);
            }
        });
    }

    // --- fungsi hapus data ---
    function hapus_slider(id) {
        alertify.confirm("Apakah Anda yakin akan menghapus data ini ?", function(ev) {
            ev.preventDefault();
            $.ajax({
                url: "<?= base_url(); ?>/ladmin/slider/ajax_delete_slider/" + id,
                type: "POST",
                dataType: "JSON",
                success: function(data) {
                    $('#modal_form').modal('hide');
                    reload_table();
                    toastr.success("Data Berhasil diHapus");
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    toastr.error("Error Deleting Data");
                }
            });
        }, function(ev) {
            ev.preventDefault();
        });
    }
</script>
<?= $this->endSection() ?>