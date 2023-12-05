<?= $this->extend('backend/layout/app') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-sm-6">
        <form action="">
            <div class="input-group mb-3">
                <input type="text" class="form-control form-control-sm" name="s" placeholder="Masukkan kata kunci pencarian..">
                <div class="input-group-append">
                    <button class="btn btn-sm btn-primary" type="submit">Cari</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Judul</th>
                            <th>Kelompok</th>
                            <th>Views</th>
                            <th>Publish</th>
                            <th>Username</th>
                            <th>Tanggal</th>
                            <th>aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $jHalaman = count($halaman);
                        if ($jHalaman == 0) {
                            echo '<tr><td colspan="8">Data tidak ditemukan</td></tr>';
                        } else {
                            $no = 1 + ($jPost * ($currentPage - 1));
                            foreach ($halaman as $b) {
                        ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><a href="<?= base_url() . 'halaman/' . $b['id_halaman'] . '/' . $b['judul_seo']; ?>" target="_blank"><?= $b['judul']; ?></a></td>
                                    <td><?= $b['kelompok']; ?></td>
                                    <td class="text-center"><?= $b['hits']; ?></td>
                                    <td class="text-center">
                                        <?php if ($b['status'] == 'Y') { ?>
                                            <span class="badge bg-primary rounded-pill">Ya</span>
                                        <?php } else if ($b['status'] == 'N') { ?>
                                            <span class="badge bg-danger rounded-pill">Tidak</span>
                                        <?php } ?>
                                    </td>
                                    <td><?= $b['created_by']; ?></td>
                                    <td><?= tgl_indo2($b['created_at']); ?></td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a href="<?= base_url() . 'ladmin/halaman/edit/' . $b['id_halaman']; ?>" class="btn btn-sm btn-primary" title="Edit Halaman"><i class="fas fa-pen fa-sm"></i></a>
                                            <a href="<?= base_url() ?>ladmin/halaman/ajax_delete_halaman/<?= $b['id_halaman']; ?>" onclick="return confirm('Apakah Anda Yakin akan menghapus Data ini?')" class="btn btn-sm btn-danger" title="Hapus Halaman"><i class="fas fa-times fa-sm"></i></a>
                                        </div>
                                    </td>

                                </tr>
                        <?php }
                        } ?>
                    </tbody>
                </table>
            </div>

            <div class="card-footer">
                <?= $pager->links('default', 'lcms'); ?>
            </div>
        </div><!-- /.card -->
    </div>
</div>
<?= $this->endSection(); ?>