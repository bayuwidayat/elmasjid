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
                            <th>Nama Menu</th>
                            <th>URL</th>
                            <th>Parent Menu</th>
                            <th>Urutan</th>
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

<!-- Modal Tambah Data-->
<div class="modal fade" id="modal_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form" method="POST" action="#">
                    <?= csrf_field(); ?>
                    <input type="hidden" value="" id="id_menus" name="id_menus">
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Nama Menu</label>
                        <div class="col-sm-8">
                            <input type="text" id="nm_menus" name="nm_menus" class="form-control" placeholder="Nama Menu" required>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Tipe</label>
                        <div class="col-sm-8">
                            <select name="tipe" id="tipe" class="form-control" onChange="tampiltipe()">
                                <option value="">-- Pilih Tipe Menu --</option>
                                <option value="halaman">Halaman</option>
                                <option value="halaman_custom">Halaman Template</option>
                                <option value="kategori_berita">Kategori</option>
                                <option value="links">Link Custom</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row" id="halaman_r">
                        <label class="col-sm-4 col-form-label">Link Halaman</label>
                        <div class="col-sm-8">
                            <?php $halaman = 'class="form-control" id="halaman" placeholder="Halaman" required'; ?>
                            <?php echo form_dropdown('halaman', $get_all_combobox_halaman, '', $halaman) ?>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="form-group row" id="halaman_custom_r" style="display: none;">
                        <label class="col-sm-4 col-form-label">Link Halaman Template</label>
                        <div class="col-sm-8">
                            <select name="halaman_custom" id="halaman_custom" class="form-control">
                                <option value="agenda">Agenda</option>
                                <option value="berita">Berita</option>
                                <option value="galeri-foto">Galeri Foto</option>
                                <option value="video">Galeri Video</option>
                                <option value="jadwal-jumat">Jadwal Jumat</option>
                                <option value="kontak">Kontak</option>
                                <option value="laporan-infaq">Laporan Infaq</option>
                                <option value="layanan">Layanan</option>
                                <option value="pengumuman">Pengumuman</option>
                                <option value="profil">Profil</option>
                                <option value="takmir">Takmir</option>
                                <option value="tausiyah">Tausiyah</option>
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="form-group row" id="kategori_berita_r" style="display: none;">
                        <label class=" col-sm-4 col-form-label">Kategori Berita</label>
                        <div class="col-sm-8">
                            <?php $kategori = 'class="form-control" id="kategori" placeholder="Kategori Berita" required'; ?>
                            <?php echo form_dropdown('kategori', $get_all_combobox_kategori, '', $kategori) ?>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="form-group row" id="links_r" style="display: none;">
                        <label class="col-sm-4 col-form-label">Link Custom</label>
                        <div class="col-sm-8">
                            <input type="text" id="link_custom" name="link_custom" class="form-control" placeholder="Link Custom" required>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Parent Menu</label>
                        <div class="col-sm-8">
                            <div id="parent_menu"></div>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Target</label>
                        <div class="col-sm-8">
                            <select name="target" id="target" class="form-control">
                                <option value="_self">Self</option>
                                <option value="_blank">Blank</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Urutan</label>
                        <div class="col-sm-8">
                            <input type="number" id="urutan" name="urutan" class="form-control" placeholder="Urutan Menu">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Aktif</label>
                        <div class="col-sm-8">
                            <select name="aktif" id="aktif" class="form-control">
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
    // tabel ajax sikap
    var table_menus = $('#datatable').DataTable({
        "processing": true,
        "serverside": true,
        "order": [],
        "ordering": false,
        "searching": true,
        "paging": true,
        "autoWidth": false,
        "responsive": true,
        "ajax": {
            "url": "<?= base_url(); ?>/ladmin/menus/ajax_list",
            "type": "POST"
        },
    });

    function reload_table_menus() {
        table_menus.ajax.reload();
    }

    function parentmenu(id) {
        $.ajax({
            url: "<?php echo base_url(); ?>/ladmin/halaman/pilih_halaman/" + id,
            success: function(response) {
                $("#parent_menu").html(response);
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
        $('#modal_form').modal('show');
        $('.modal-title').text('Tambah Data Menu');
        parentmenu();
    }

    function tampiltipe() {
        var tipe = $('#tipe').val();
        if (tipe == 'halaman') {
            $('#halaman_r').show();
            $('#halaman_custom_r').hide();
            $('#links_r').hide();
            $('#kategori_berita_r').hide();
        }
        if (tipe == 'halaman_custom') {
            $('#halaman_custom_r').show();
            $('#halaman_r').hide();
            $('#links_r').hide();
            $('#kategori_berita_r').hide();
        }
        if (tipe == 'links') {
            $('#halaman_r').hide();
            $('#halaman_custom_r').hide();
            $('#links_r').show();
            $('#kategori_berita_r').hide();
        }
        if (tipe == 'kategori_berita') {
            $('#halaman_r').hide();
            $('#halaman_custom_r').hide();
            $('#links_r').hide();
            $('#kategori_berita_r').show();
        }
    }
    // --- fungsi edit data ---
    function edit(id) {
        save_method = 'ubah';
        $('#form')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();

        $.ajax({
            url: "<?= base_url(); ?>/ladmin/menus/ajax_edit/" + id,
            type: "POST",
            dataType: "JSON",
            success: function(data) {
                parentmenu(data.parent_id);
                $('[name="id_menus"]').val(data.id_menus);
                $('[name="nm_menus"]').val(data.nm_menus);
                $('[name="tipe"]').val(data.tipe);
                $('[name="urutan"]').val(data.urutan);
                $('[name="aktif"]').val(data.aktif);
                $('[name="target"]').val(data.target);
                $('[name="parent_id"]').val(data.parent_id);
                if (data.tipe == 'halaman') {
                    $('[name="halaman"]').val(data.url.split('halaman/')[1]);
                    $('#halaman_r').show();
                    $('#halaman_custom_r').hide();
                    $('#links_r').hide();
                    $('#kategori_berita_r').hide();
                } else if (data.tipe == 'halaman_custom') {
                    $('[name="halaman_custom"]').val(data.url);
                    $('#halaman_custom_r').show();
                    $('#halaman_r').hide();
                    $('#links_r').hide();
                    $('#kategori_berita_r').hide();
                } else if (data.tipe == 'links') {
                    $('#halaman_r').hide();
                    $('#halaman_custom_r').hide();
                    $('#links_r').show();
                    $('#kategori_berita_r').hide();
                    $('[name="link_custom"]').val(data.url);
                } else if (data.tipe == 'kategori_berita') {
                    $('[name="kategori"]').val(data.url.split('/')[1]);
                    $('#halaman_r').hide();
                    $('#halaman_custom_r').hide();
                    $('#links_r').hide();
                    $('#kategori_berita_r').show();
                }
                $('#modal_form').modal('show');
                $('.modal-title').text('Edit Data Menu');
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
            url = '<?= base_url(); ?>/ladmin/menus/ajax_save';
        } else {
            url = '<?= base_url(); ?>/ladmin/menus/ajax_update';
        }

        var id_menus = $('#id_menus').val();
        var nm_menus = $('#nm_menus').val();
        var tipe = $('#tipe').val();
        var halaman = $('#halaman').val();
        var halaman_custom = $('#halaman_custom').val();
        var kategori = $('#kategori').val();
        var link_custom = $('#link_custom').val();
        var parent_id = $('#parent_id').val();
        var target = $('#target').val();
        var urutan = $('#urutan').val();
        var aktif = $('#aktif').val();

        var formData = new FormData();

        formData.append('id_menus', id_menus);
        formData.append('nm_menus', nm_menus);
        formData.append('tipe', tipe);
        formData.append('halaman', halaman);
        formData.append('halaman_custom', halaman_custom);
        formData.append('kategori', kategori);
        formData.append('link_custom', link_custom);
        formData.append('parent_id', parent_id);
        formData.append('target', target);
        formData.append('urutan', urutan);
        formData.append('aktif', aktif);

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
                    reload_table_menus();
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

    // --- fungsi hapus data menus ---
    function hapus_menus(id) {
        alertify.confirm("Apakah Anda yakin akan menghapus data ini ?", function(ev) {
            ev.preventDefault();
            $.ajax({
                url: "<?= base_url(); ?>/ladmin/menus/ajax_delete/" + id,
                type: "POST",
                dataType: "JSON",
                success: function(data) {
                    $('#modal_form_menus').modal('hide');
                    reload_table_menus();
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