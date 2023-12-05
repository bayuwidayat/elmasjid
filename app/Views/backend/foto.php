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
                            <th>Foto</th>
                            <th>Judul Foto</th>
                            <th>Album</th>
                            <th>Username</th>
                            <th>Tanggal</th>
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
    <div class="modal-dialog modal-lg" role="document">
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
                    <input type="hidden" value="" id="id_foto" name="id_foto">
                    <input type="hidden" value="" id="foto_lm" name="foto_lm">
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Foto</label>
                        <div class="col-sm-8">
                            <img id="foto_ev" name="foto_ev" src="" style="max-height:50px">
                            <img id="preview" style="max-height:80px;" /><a href="javascript:void(0)" style="display: none;" id="txt_hapus" class="text-danger" onclick="hapus()">Hapus (x)</a><br>
                            <input id="foto" name="foto" type="file" class="form-control form-control-sm" placeholder="Foto" accept="image/*" onchange="photoPreview(this,'preview')">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Judul Foto</label>
                        <div class="col-sm-8">
                            <input type="text" id="nm_foto" name="nm_foto" class="form-control form-control-sm" placeholder="Judul Foto" required>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Album</label>
                        <div class="col-sm-8">
                            <div id="album_v"></div>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Keterangan Foto</label>
                        <div class="col-sm-8">
                            <textarea id="ket_foto" name="ket_foto" class="form-control form-control-sm" placeholder="Keterangan"></textarea>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Tag Foto</label>
                        <div class="col-sm-8">
                            <input type="text" id="tagfoto" name="tagfoto" class="form-control form-control-sm" placeholder="Pisahkan dengan tanda koma" required>
                            <div class="invalid-feedback"></div>
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
    // tabel ajax sikap
    var table_foto = $('#datatable').DataTable({
        "processing": true,
        "serverside": true,
        "order": [],
        "searching": true,
        "paging": true,
        "autoWidth": false,
        "responsive": true,
        "ajax": {
            "url": "<?= base_url(); ?>/ladmin/foto/ajax_list_foto",
            "type": "POST"
        }
    });

    function reload_table() {
        table_foto.ajax.reload();
    }

    function pilih_album(id) {
        $.ajax({
            url: "<?php echo base_url(); ?>ladmin/album/pilih_album/" + id,
            success: function(response) {
                $("#album_v").html(response);
            },
            dataType: "html"
        });
        return false;

    }

    // --- fungsi tambah data ---
    function tambah() {
        save_method = 'tambah';
        $('#form')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();
        $('#foto_ev').hide();
        $('#preview').hide();
        $('#txt_hapus').hide();
        $('#modal_form').modal('show');
        $('.modal-title').text('Tambah Foto');
        pilih_album();
    }

    // --- fungsi edit data ---
    function edit(id) {
        save_method = 'ubah';
        $('#form')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();
        $('#preview').hide();
        $('#txt_hapus').hide();

        $.ajax({
            url: "<?= base_url(); ?>/ladmin/foto/edit/" + id,
            type: "POST",
            dataType: "JSON",
            success: function(data) {
                $('[name="id_foto"]').val(data.id_foto);
                $('[name="foto_lm"]').val(data.gambar);
                $('[name="nm_foto"]').val(data.nm_foto);
                $('[name="ket_foto"]').val(data.ket_foto);
                $('[name="tagfoto"]').val(data.tagfoto);

                if (data.gambar == '') {
                    $('#foto_ev').hide();
                } else {
                    $('[name="foto_ev"]').attr('src', '<?= base_url() ?>/assets/images/foto/' + data.gambar);
                    $('#foto_ev').show();
                }
                $('#modal_form').modal('show');
                $('.modal-title').text('Edit Data');
                pilih_album(data.album_id);
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
            url = '<?= base_url(); ?>/ladmin/foto/ajax_save';
        } else {
            url = '<?= base_url(); ?>/ladmin/foto/ajax_update';
        }

        var id_foto = $('#id_foto').val();
        var foto_lm = $('#foto_lm').val();
        var nm_foto = $('#nm_foto').val();
        var ket_foto = $('#ket_foto').val();
        var album = $('#album').val();
        var tagfoto = $('#tagfoto').val();
        var foto = $('#foto').prop('files')[0];

        var formData = new FormData();

        formData.append('id_foto', id_foto);
        formData.append('foto_lm', foto_lm);
        formData.append('nm_foto', nm_foto);
        formData.append('ket_foto', ket_foto);
        formData.append('album', album);
        formData.append('tagfoto', tagfoto);
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


    // --- fungsi hapus data foto ---
    function hapus_foto(id) {
        alertify.confirm("Apakah Anda yakin akan menghapus data ini ?", function(ev) {
            ev.preventDefault();
            $.ajax({
                url: "<?= base_url(); ?>/ladmin/foto/ajax_delete_foto/" + id,
                type: "POST",
                dataType: "JSON",
                success: function(data) {
                    $('#modal_form_foto').modal('hide');
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
                $('#foto_ev').hide();
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
        $('#foto_ev').show();
    }
</script>
<?= $this->endSection() ?>