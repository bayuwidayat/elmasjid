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
                            <th>Username</th>
                            <th>Nama Lengkap</th>
                            <th>Level</th>
                            <th>Hak Akses</th>
                            <th>Blokir</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah / Edit Data-->
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
                    <input type="hidden" value="" id="id_session" name="id_session">
                    <input type="hidden" value="" id="foto_lm" name="foto_lm">
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Username</label>
                        <div class="col-sm-8">
                            <input type="text" id="username" name="username" class="form-control form-control-sm" placeholder="Username" required>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Password</label>
                        <div class="col-sm-8">
                            <input type="password" id="password" name="password" class="form-control form-control-sm" placeholder="Password">
                            <div class="ketpassword" style="display: none;"><small>Kosongkan jika password tidak diubah</small></div>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Nama Lengkap</label>
                        <div class="col-sm-8">
                            <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control form-control-sm" placeholder="Nama Lengkap" required>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Email</label>
                        <div class="col-sm-8">
                            <input type="email" id="email" name="email" class="form-control form-control-sm" placeholder="Email" required>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Level</label>
                        <div class="col-sm-8">
                            <input type="radio" id="level" name="level" value="admin"> Admin &nbsp;
                            <input type="radio" id="level" name="level" value="user"> User &nbsp;
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Blokir</label>
                        <div class="col-sm-8">
                            <input type="radio" id="blokir" name="blokir" value="Y"> Ya &nbsp;
                            <input type="radio" id="blokir" name="blokir" value="N" checked> Tidak &nbsp;
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="form-group row" id="hakakses_lama" style="display: none;">
                        <label class="col-sm-4 col-form-label">Hak Akses Lama</label>
                        <div class="col-sm-8">
                            <div id="modul_lama"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label" id="hakakses_baru">Hak Akses</label>
                        <div class="col-sm-8">
                            <?php $css_fdm = 'id="modul" class="select2 form-control form-control-sm" multiple="multiple" placeholder="Pilih Hak Akses"'; ?>
                            <?= form_dropdown('modul[]', $get_all_combobox_modul, '', $css_fdm); ?>
                            <div id="ketmodul" style="display: none;"><small>kosongkan jika tidak ada perubahan</small></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Foto</label>
                        <div class="col-sm-8">
                            <img id="foto_ev" name="foto_ev" src="" style="max-height:80px">
                            <img id="preview" style="max-height:80px;" /><br>
                            <input id="foto" name="foto" type="file" accept="image/*" class="form-control form-control-sm" placeholder="Foto">
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
<link rel="stylesheet" href="<?= base_url() ?>assets/backend/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/backend/plugins/toastr/toastr.min.css">
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script src="<?= base_url() ?>assets/backend/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>assets/backend/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url() ?>assets/backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>assets/backend/plugins/select2/js/select2.full.min.js"></script>
<script src="<?= base_url() ?>assets/backend/plugins/alertify/js/alertify.js"></script>
<script src="<?= base_url() ?>assets/backend/plugins/toastr/toastr.min.js"></script>

<script>
    var table_users = $('#datatable').DataTable({
        "processing": true,
        "serverside": true,
        "order": [],
        "searching": true,
        "paging": true,
        "autoWidth": false,
        "responsive": true,
        "ajax": {
            "url": "<?= base_url(); ?>/ladmin/users/ajax_list",
            "type": "POST"
        },
    });

    function reload_table() {
        table_users.ajax.reload();
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
        $('#modal_form').modal('show');
        $('.modal-title').text('Tambah Data');
        $('#ketpassword').hide();
        $('#ketmodul').hide();
        $('#hakakses_lama').hide();
        $('#hakakses_baru').text('Hak Akses');
        $('#username').attr('disabled', false);
        $('.select2').select2();
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

        $.ajax({
            url: "<?= base_url(); ?>/ladmin/users/ajax_edit/" + id,
            type: "POST",
            dataType: "JSON",
            success: function(data) {
                $('[name="username"]').val(data.username);
                $('[name="username"]').attr('disabled', true);
                $('[name="nama_lengkap"]').val(data.nama_lengkap);
                $('[name="email"]').val(data.email);
                $('[name="id_session"]').val(data.id_session);
                $('[name="foto_lm"]').val(data.foto);
                $('input[name="level"][value="' + data.level + '"]').prop('checked', true);
                $('input[name="blokir"][value="' + data.blokir + '"]').prop('checked', true);

                $.ajax({
                    url: "<?= base_url(); ?>/ladmin/users/ajax_usersmodul/" + data.username,
                    dataType: "html",
                    success: function(response) {
                        $("#modul_lama").html(response);
                        $('#hakakses_lama').show();
                        $('#hakakses_baru').text('Hak Akses Baru');
                    }
                });
                $('.select2').select2();

                if (data.foto == '') {
                    $('#foto_ev').hide();
                } else {
                    $('[name="foto_ev"]').attr('src', '<?= base_url() ?>/assets/images/users/' + data.foto);
                }
                $('#modal_form').modal('show');
                $('.modal-title').text('Edit Data');
                $('.ketpassword').show();
                $('#ketmodul').show();
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
            url = '<?= base_url(); ?>/ladmin/users/ajax_save';
        } else {
            url = '<?= base_url(); ?>/ladmin/users/ajax_update';
        }

        var id_session = $('#id_session').val();
        var foto_lm = $('#foto_lm').val();
        var username = $('#username').val();
        var password = $('#password').val();
        var nama_lengkap = $('#nama_lengkap').val();
        var email = $('#email').val();
        var level = $('input[name="level"]:checked').val();
        var blokir = $('input[name="blokir"]:checked').val();
        var foto = $('#foto').prop('files')[0];

        var modul = [];

        $.each($("#modul option:selected"), function() {
            modul.push($(this).val());
        });

        var formData = new FormData();

        formData.append('id_session', id_session);
        formData.append('foto_lm', foto_lm);
        formData.append('username', username);
        formData.append('password', password);
        formData.append('nama_lengkap', nama_lengkap);
        formData.append('email', email);
        formData.append('level', level);
        formData.append('blokir', blokir);
        formData.append('foto', foto);
        formData.append('modul', modul.join(';'));

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
    function hapus(id) {
        alertify.confirm("Apakah Anda yakin akan menghapus data ini ?", function(ev) {
            ev.preventDefault();
            $.ajax({
                url: "<?= base_url(); ?>/ladmin/users/ajax_delete/" + id,
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