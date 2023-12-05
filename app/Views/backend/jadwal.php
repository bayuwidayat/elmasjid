<?= $this->extend('backend/layout/app') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <table id="datatable" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th style="max-width: 30px;">No</th>
                            <th>Nama Jadwal</th>
                            <th>Imam</th>
                            <th>Khatib</th>
                            <th>Muadzin</th>
                            <th>Bilal</th>
                            <th style="max-width: 80px;">Aksi</th>
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
                <form id="form" method="POST" action="#">
                    <?= csrf_field(); ?>
                    <input type="hidden" value="" id="id_jadwal" name="id_jadwal">
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Tipe</label>
                        <div class="col-sm-8">
                            <select name="tipe" id="tipe" class="form-control form-control-sm" onChange="tampiltipe()">
                                <option value="tanggal">Tanggal</option>
                                <option value="pasar">Hari Pasaran</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row" id="tanggal_r">
                        <label class="col-sm-4 col-form-label">Tanggal</label>
                        <div class="col-sm-8">
                            <input type="text" id="tanggal" name="tanggal" class="form-control form-control-sm" placeholder="Tanggal" required>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="form-group row" id="nm_jadwal_r" style="display: none;">
                        <label class="col-sm-4 col-form-label">Nama Jadwal</label>
                        <div class="col-sm-8">
                            <input type="text" id="nm_jadwal" name="nm_jadwal" class="form-control form-control-sm" placeholder="Nama Jadwal" required>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Petugas Imam</label>
                        <div class="col-sm-8">
                            <input type="text" id="imam" name="imam" class="form-control form-control-sm" placeholder="Petugas Imam" required>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Petugas Khatib</label>
                        <div class="col-sm-8">
                            <input type="text" id="khatib" name="khatib" class="form-control form-control-sm" placeholder="Petugas Khatib" required>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Petugas Muadzin</label>
                        <div class="col-sm-8">
                            <input type="text" id="muadzin" name="muadzin" class="form-control form-control-sm" placeholder="Petugas Muadzin" required>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Petugas Bilal</label>
                        <div class="col-sm-8">
                            <input type="text" id="bilal" name="bilal" class="form-control form-control-sm" placeholder="Petugas Bilal" required>
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
<link rel="stylesheet" href="<?= base_url() ?>assets/backend/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/backend/plugins/toastr/toastr.min.css">
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script src="<?= base_url() ?>assets/backend/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>assets/backend/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url() ?>assets/backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>assets/backend/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="<?= base_url() ?>assets/backend/plugins/alertify/js/alertify.js"></script>
<script src="<?= base_url() ?>assets/backend/plugins/toastr/toastr.min.js"></script>

<script>
    jQuery('#tanggal').datepicker({
        format: 'yyyy-mm-dd',
        toggleActive: true,
        autoclose: true,
    });
    var table_jadwal = $('#datatable').DataTable({
        "processing": true,
        "serverside": true,
        "order": [],
        "searching": true,
        "paging": true,
        "autoWidth": false,
        "responsive": true,
        "ajax": {
            "url": "<?= base_url(); ?>/ladmin/jadwal/ajax_list",
            "type": "POST"
        },
    });

    function reload_table_jadwal() {
        table_jadwal.ajax.reload();
    }

    // --- fungsi tambah data ---
    function tambah() {
        save_method = 'tambah';
        $('#form')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();
        $('#foto_ev').hide();
        $('#tanggal_r').show();
        $('#nm_jadwal_r').hide();
        $('.modal-title').text('Tambah Jadwal Jumat');
        $('#modal_form').modal('show');
    }

    function tampiltipe() {
        var tipe = $('#tipe').val();
        if (tipe == 'tanggal') {
            $('#tanggal_r').show();
            $('#nm_jadwal_r').hide();
        }
        if (tipe == 'pasar') {
            $('#tanggal_r').hide();
            $('#nm_jadwal_r').show();
        }
    }

    // --- fungsi edit data ---
    function edit(id) {
        save_method = 'ubah';
        $('#form')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();

        $.ajax({
            url: "<?= base_url(); ?>ladmin/jadwal/ajax_edit/" + id,
            type: "POST",
            dataType: "JSON",
            success: function(data) {
                $('[name="id_jadwal"]').val(data.id_jadwal);
                $('[name="tipe"]').val(data.tipe);
                $('[name="nm_jadwal"]').val(data.nm_jadwal);
                $('[name="tanggal"]').val(data.tanggal);
                $('[name="imam"]').val(data.imam);
                $('[name="khatib"]').val(data.khatib);
                $('[name="muadzin"]').val(data.muadzin);
                $('[name="bilal"]').val(data.bilal);
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
            url = '<?= base_url(); ?>ladmin/jadwal/ajax_save';
        } else {
            url = '<?= base_url(); ?>ladmin/jadwal/ajax_update';
        }

        var id_jadwal = $('#id_jadwal').val();
        var nm_jadwal = $('#nm_jadwal').val();
        var tipe = $('#tipe').val();
        var tanggal = $('#tanggal').val();
        var imam = $('#imam').val();
        var khatib = $('#khatib').val();
        var bilal = $('#bilal').val();
        var muadzin = $('#muadzin').val();

        var formData = new FormData();

        formData.append('id_jadwal', id_jadwal);
        formData.append('nm_jadwal', nm_jadwal);
        formData.append('tipe', tipe);
        formData.append('tanggal', tanggal);
        formData.append('imam', imam);
        formData.append('khatib', khatib);
        formData.append('bilal', bilal);
        formData.append('muadzin', muadzin);

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
                    reload_table_jadwal();
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

    // --- fungsi hapus data jadwal ---
    function hapus_jadwal(id) {
        alertify.confirm("Apakah Anda yakin akan menghapus data ini ?", function(ev) {
            ev.preventDefault();
            $.ajax({
                url: "<?= base_url(); ?>ladmin/jadwal/ajax_delete/" + id,
                type: "POST",
                dataType: "JSON",
                success: function(data) {
                    $('#modal_form_jadwal').modal('hide');
                    reload_table_jadwal();
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