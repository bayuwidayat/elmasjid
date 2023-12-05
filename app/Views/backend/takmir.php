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
                            <th>Nama Takmir</th>
                            <th>Jabatan</th>
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
                    <input type="hidden" value="" id="id_takmir" name="id_takmir">
                    <input type="hidden" value="" id="foto_lm" name="foto_lm">
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Nama Takmir</label>
                        <div class="col-sm-8">
                            <input type="text" id="nm_takmir" name="nm_takmir" class="form-control form-control-sm" placeholder="Nama Takmir" required>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Jabatan Takmir</label>
                        <div class="col-sm-8">
                            <input type="text" id="jbtn_takmir" name="jbtn_takmir" class="form-control form-control-sm" placeholder="Jabatan Takmir" required>
                            <small>Nama posisi dalam kepengurusan (Penasehat, Ketua, dll)</small>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Keterangan Takmir</label>
                        <div class="col-sm-8">
                            <textarea id="ket_takmir" name="ket_takmir" class="form-control form-control-sm" placeholder="Keterangan"></textarea>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Takmir</label>
                        <div class="col-sm-8">
                            <img id="foto_ev" name="foto_ev" src="" style="max-height:50px">
                            <img id="preview" style="max-height:80px;" /><a href="javascript:void(0)" style="display: none;" id="txt_hapus" class="text-danger" onclick="hapus()">Hapus (x)</a><br>
                            <input id="foto" name="foto" type="file" class="form-control form-control-sm" placeholder="Takmir" accept="image/*" onchange="photoPreview(this,'preview')">
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
    var table_takmir = $('#datatable').DataTable({
        "processing": true,
        "serverside": true,
        "order": [],
        "searching": true,
        "paging": true,
        "autoWidth": false,
        "responsive": true,
        "ajax": {
            "url": "<?= base_url(); ?>ladmin/takmir/ajax_list",
            "type": "POST"
        },
    });

    function reload_table() {
        table_takmir.ajax.reload();
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
        $('.modal-title').text('Tambah Takmir');
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
            url: "<?= base_url(); ?>ladmin/takmir/ajax_edit/" + id,
            type: "POST",
            dataType: "JSON",
            success: function(data) {
                $('[name="id_takmir"]').val(data.id_takmir);
                $('[name="foto_lm"]').val(data.gambar);
                $('[name="nm_takmir"]').val(data.nm_takmir);
                $('[name="jbtn_takmir"]').val(data.jbtn_takmir);
                $('[name="ket_takmir"]').val(data.ket_takmir);

                if (data.gambar == '') {
                    $('#foto_ev').hide();
                } else {
                    $('[name="foto_ev"]').attr('src', '<?= base_url() ?>/assets/images/takmir/' + data.gambar);
                    $('#foto_ev').show();
                }
                $('#modal_form').modal('show');
                $('.modal-title').text('Edit Data');
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
            url = '<?= base_url(); ?>ladmin/takmir/ajax_save';
        } else {
            url = '<?= base_url(); ?>ladmin/takmir/ajax_update';
        }

        var id_takmir = $('#id_takmir').val();
        var foto_lm = $('#foto_lm').val();
        var nm_takmir = $('#nm_takmir').val();
        var jbtn_takmir = $('#jbtn_takmir').val();
        var ket_takmir = $('#ket_takmir').val();
        var foto = $('#foto').prop('files')[0];

        var formData = new FormData();

        formData.append('id_takmir', id_takmir);
        formData.append('foto_lm', foto_lm);
        formData.append('nm_takmir', nm_takmir);
        formData.append('jbtn_takmir', jbtn_takmir);
        formData.append('ket_takmir', ket_takmir);
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
    function hapus_takmir(id) {
        alertify.confirm("Apakah Anda yakin akan menghapus data ini ?", function(ev) {
            ev.preventDefault();
            $.ajax({
                url: "<?= base_url(); ?>ladmin/takmir/ajax_delete/" + id,
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