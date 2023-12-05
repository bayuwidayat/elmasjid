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
                            <th>Informasi</th>
                            <th>Aktif</th>
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
                <form id="form" method="POST" action="#">
                    <?= csrf_field(); ?>
                    <input type="hidden" value="" id="id_sekilasinfo" name="id_sekilasinfo">
                    <div class="form-group">
                        <label class="col-form-label">Tulis Informasi</label>
                        <textarea id="info" name="info" class="form-control"></textarea>
                    </div>
                    <div class="form-group" id="aktif_v">
                        <label class="col-form-label">Aktif</label>
                        <select name="aktif" id="aktif" class="form-control form-control-sm">
                            <option value="Y">Ya</option>
                            <option value="N">Tidak</option>
                        </select>
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
    var table_sekilasinfo = $('#datatable').DataTable({
        "processing": true,
        "serverside": true,
        "order": [],
        "searching": true,
        "paging": true,
        "autoWidth": false,
        "responsive": true,
        "ajax": {
            "url": "<?= base_url(); ?>ladmin/sekilasinfo/ajax_list",
            "type": "POST"
        },
    });

    function reload_table_sekilasinfo() {
        table_sekilasinfo.ajax.reload();
    }

    // --- fungsi tambah data ---
    function tambah() {
        save_method = 'tambah';
        $('#form')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();
        $('#foto_ev').hide();
        $('#modal_form').modal('show');
        $('.modal-title').text('Tambah Sekilas Info');
        $('#aktif_v').hide();
    }

    // --- fungsi edit data ---
    function edit(id) {
        save_method = 'ubah';
        $('#form')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();

        $.ajax({
            url: "<?= base_url(); ?>ladmin/sekilasinfo/ajax_edit/" + id,
            type: "POST",
            dataType: "JSON",
            success: function(data) {
                $('[name="id_sekilasinfo"]').val(data.id_sekilasinfo);
                $('[name="info"]').val(data.info);
                $('[name="aktif"]').val(data.aktif);
                $('#aktif_v').show();
                $('#modal_form').modal('show');
                $('.modal-title').text('Edit Sekilas Info');
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
            url = '<?= base_url(); ?>ladmin/sekilasinfo/ajax_save';
        } else {
            url = '<?= base_url(); ?>ladmin/sekilasinfo/ajax_update';
        }

        $.ajax({
            url: url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data) {
                if (data.status) {
                    $('#modal_form').modal('hide');
                    reload_table_sekilasinfo();
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

    // --- fungsi hapus data sekilasinfo ---
    function hapus_sekilasinfo(id) {
        alertify.confirm("Apakah Anda yakin akan menghapus data ini ?", function(ev) {
            ev.preventDefault();
            $.ajax({
                url: "<?= base_url(); ?>ladmin/sekilasinfo/ajax_delete/" + id,
                type: "POST",
                dataType: "JSON",
                success: function(data) {
                    $('#modal_form_sekilasinfo').modal('hide');
                    reload_table_sekilasinfo();
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