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
                            <th style="width: 300px;">Video</th>
                            <th>Judul Video</th>
                            <th>Playlist</th>
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
                <form id="form" method="POST" action="#">
                    <?= csrf_field(); ?>
                    <input type="hidden" value="" id="id_video" name="id_video">
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Judul Video</label>
                        <div class="col-sm-8">
                            <input type="text" id="nm_video" name="nm_video" class="form-control" placeholder="Judul Video" required>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Link Video Youtube</label>
                        <div class="col-sm-8">
                            <input type="text" id="youtube" name="youtube" class="form-control" placeholder="Link Video Youtube" required>
                            <small>Contoh : <span class="text-danger">https://www.youtube.com/watch?v=QdAhdv94MFk</span></small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Playlist</label>
                        <div class="col-sm-8">
                            <div id="playlist_v"></div>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Keterangan Video</label>
                        <div class="col-sm-8">
                            <input type="text" id="ket_video" name="ket_video" class="form-control" placeholder="Keterangan" required>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Tag Video</label>
                        <div class="col-sm-8">
                            <input type="text" id="tagvid" name="tagvid" class="form-control" placeholder="Pisahkan dengan tanda koma" required>
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
    var table_video = $('#datatable').DataTable({
        "processing": true,
        "serverside": true,
        "order": [],
        "searching": true,
        "paging": true,
        "ajax": {
            "url": "<?= base_url(); ?>/ladmin/video/ajax_list_video",
            "type": "POST"
        },
        "columnDefs": [{
            "targets": [-1],
            "orderable": false,
        }]
    });

    function reload_table() {
        table_video.ajax.reload();
    }

    function pilih_playlist(id) {
        $.ajax({
            url: "<?php echo base_url(); ?>/ladmin/playlist/pilih_playlist/" + id,
            success: function(response) {
                $("#playlist_v").html(response);
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
        $('#modal_form').modal('show');
        $('.modal-title').text('Tambah Data');
        pilih_playlist();
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
            url: "<?= base_url(); ?>/ladmin/video/edit/" + id,
            type: "POST",
            dataType: "JSON",
            success: function(data) {
                $('[name="id_video"]').val(data.id_video);
                $('[name="nm_video"]').val(data.nm_video);
                $('[name="ket_video"]').val(data.ket_video);
                $('[name="youtube"]').val(data.youtube);
                $('[name="tagvid"]').val(data.tagvid);
                $('#modal_form').modal('show');
                $('.modal-title').text('Edit Data');
                pilih_playlist(data.playlist_id);
                $("#foto").change(function() {
                    readURL(this);
                });
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alertify.delay(2000).error('Error getting data from ajax');
            }
        });

    }

    // --- fungsi simpan data ---
    function simpan() {
        $('#btnSimpan').text('Menyimpan...');
        $('#btnSimpan').attr('disabled', true);
        var url;
        if (save_method == 'tambah') {
            url = '<?= base_url(); ?>/ladmin/video/ajax_save';
        } else {
            url = '<?= base_url(); ?>/ladmin/video/ajax_update';
        }

        var id_video = $('#id_video').val();
        var foto_lm = $('#foto_lm').val();
        var nm_video = $('#nm_video').val();
        var ket_video = $('#ket_video').val();
        var youtube = $('#youtube').val();
        var playlist = $('#playlist').val();
        var tagvid = $('#tagvid').val();

        var formData = new FormData();

        formData.append('id_video', id_video);
        formData.append('foto_lm', foto_lm);
        formData.append('nm_video', nm_video);
        formData.append('ket_video', ket_video);
        formData.append('youtube', youtube);
        formData.append('playlist', playlist);
        formData.append('tagvid', tagvid);

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
                alertify.delay(2000).success("Data Berhasil Disimpan");
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alertify.delay(2000).error('Error adding / update data');
                $('#btnSimpan').text('Simpan');
                $('#btnSimpan').attr('disabled', false);
            }
        });
    }


    // --- fungsi hapus data foto ---
    function hapus_video(id) {
        alertify.confirm("Apakah Anda yakin akan menghapus data ini ?", function(ev) {
            ev.preventDefault();
            $.ajax({
                url: "<?= base_url(); ?>/ladmin/video/ajax_delete_video/" + id,
                type: "POST",
                dataType: "JSON",
                success: function(data) {
                    $('#modal_form').modal('hide');
                    reload_table();
                    alertify.delay(2000).success("Data Berhasil diHapus");
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alertify.delay(2000).error("Error Deleting Data");
                }
            });
        }, function(ev) {
            ev.preventDefault();
        });
    }
</script>

<?= $this->endSection() ?>