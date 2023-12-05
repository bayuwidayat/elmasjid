<?= $this->extend('backend/layout/app') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <?php if (session()->getFlashdata('pesan')) : ?>
                    <?= session()->getFlashdata('pesan'); ?>
                <?php endif; ?>
                <form action="<?= base_url('ladmin/setting/ajax_update'); ?>" method="POST">
                    <div class="row">
                        <div class="col-5 col-sm-3">
                            <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                                <a class="nav-link active" id="vert-tabs-home-tab" data-toggle="pill" href="#vert-tabs-home" role="tab" aria-controls="vert-tabs-home" aria-selected="true"><b>Setting Dasar</b></a>
                                <a class="nav-link" id="vert-tabs-profile-tab" data-toggle="pill" href="#vert-tabs-profile" role="tab" aria-controls="vert-tabs-profile" aria-selected="false"><b>Profil</b></a>
                                <a class="nav-link" id="vert-tabs-jadwal-tab" data-toggle="pill" href="#vert-tabs-jadwal" role="tab" aria-controls="vert-tabs-jadwal" aria-selected="false"><b>Jadwal Sholat</b></a>
                                <a class="nav-link" id="vert-tabs-messages-tab" data-toggle="pill" href="#vert-tabs-messages" role="tab" aria-controls="vert-tabs-messages" aria-selected="false"><b>Tombol Whatsapp</b></a>
                                <a class="nav-link" id="vert-tabs-settings-tab" data-toggle="pill" href="#vert-tabs-settings" role="tab" aria-controls="vert-tabs-settings" aria-selected="false"><b>Akun Sosial Media</b></a>
                            </div>
                        </div>
                        <div class="col-7 col-sm-9">
                            <div class="tab-content" id="vert-tabs-tabContent">
                                <!-- Informasi Dasar -->
                                <div class="tab-pane text-left fade show active" id="vert-tabs-home" role="tabpanel" aria-labelledby="vert-tabs-home-tab">
                                    <input type="hidden" name="id_setting" id="id_setting" value="<?= $setting->id_setting; ?>">
                                    <div class="form-group row">
                                        <label for="maintenance" class="col-sm-2 col-form-label">Mode Maintenance</label>
                                        <div class="col-sm-2">
                                            <select name="maintenance" id="maintenance" class="form-control form-control-sm">
                                                <option value="Y" <?php if ($setting->maintenance == 'Y') echo "selected"; ?>>Ya</option>
                                                <option value="N" <?php if ($setting->maintenance == 'N') echo "selected"; ?>>Tidak</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="nm_website" class="col-sm-2 col-form-label">Judul Website</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="nm_website" id="nm_website" class="form-control form-control-sm" value="<?= $setting->nm_website; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="singkatan" class="col-sm-2 col-form-label">Singkatan</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="singkatan" id="singkatan" class="form-control form-control-sm" value="<?= $setting->singkatan; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="slogan" class="col-sm-2 col-form-label">Slogan/Tagline</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="slogan" id="slogan" class="form-control form-control-sm" value="<?= $setting->slogan; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="meta_deskripsi" class="col-sm-2 col-form-label">Meta Deskripsi</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="meta_deskripsi" id="meta_deskripsi" class="form-control form-control-sm" value="<?= $setting->meta_deskripsi; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="meta_keyword" class="col-sm-2 col-form-label">Meta Keyword</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="meta_keyword" id="meta_keyword" class="form-control form-control-sm" value="<?= $setting->meta_keyword; ?>">
                                        </div>
                                    </div>
                                </div>
                                <!-- profile -->
                                <div class="tab-pane fade" id="vert-tabs-profile" role="tabpanel" aria-labelledby="vert-tabs-profile-tab">
                                    <div class="form-group row">
                                        <label for="tentang" class="col-sm-2 col-form-label">Tentang Website</label>
                                        <div class="col-sm-10">
                                            <textarea id="summernote" name="tentang"><?= $setting->tentang; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi Singkat</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="deskripsi" id="deskripsi" class="form-control form-control-sm" value="<?= $setting->deskripsi; ?>" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="email" name="email" id="email" class="form-control form-control-sm" value="<?= $setting->email; ?>" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="no_telp" class="col-sm-2 col-form-label">No Telepon</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="no_telp" id="no_telp" class="form-control form-control-sm" value="<?= $setting->no_telp; ?>" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="no_wa" class="col-sm-2 col-form-label">No WA</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="no_wa" id="no_wa" class="form-control form-control-sm" value="<?= $setting->no_wa; ?>" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="alamat" id="alamat" class="form-control form-control-sm" value="<?= $setting->alamat; ?>" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="google_map" class="col-sm-2 col-form-label">Google Map</label>
                                        <div class="col-sm-10">
                                            <textarea id="google_map" name="google_map" class="form-control form-control-sm"><?= $setting->google_map; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <!-- Jadwal Sholat -->
                                <div class="tab-pane fade" id="vert-tabs-jadwal" role="tabpanel" aria-labelledby="vert-tabs-jadwal-tab">
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <b>eL Masjid</b> menggunakan sumber muslimpro.com untuk menampilkan Jadwal Shalat otomatis berdasarkan kota. Silahkan cari ID dari lokasi Kota Anda, atau setidaknya Kota terdekat di wilayah Anda untuk ditampilkan jadwal shalatnya. Dapatkan <a href="javascript:void(0)" data-toggle="modal" data-target="#modal-default">ID Kota</a>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="kota_id" class="col-sm-2 col-form-label">ID Kota</label>
                                        <div class="col-sm-3">
                                            <input type="text" name="kota_id" id="kota_id" class="form-control form-control-sm" value="<?= $setting->kota_id; ?>" />
                                        </div>
                                        <div class="col-sm-7">Masukan angka ID misal 1639900</div>
                                    </div>
                                </div>
                                <!-- kontak WA -->
                                <div class="tab-pane fade" id="vert-tabs-messages" role="tabpanel" aria-labelledby="vert-tabs-messages-tab">
                                    <div class="form-group row">
                                        <label for="btn_wa" class="col-sm-2 col-form-label">Tampilkan</label>
                                        <div class="col-sm-2">
                                            <select name="btn_wa" id="btn_wa" class="form-control form-control-sm">
                                                <option value="Y" <?= ($setting->btn_wa == 'Y') ? 'selected' : ''; ?>>Ya</option>
                                                <option value="N" <?= ($setting->btn_wa == 'N') ? 'selected' : ''; ?>>Tidak</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="pesan_wa" class="col-sm-2 col-form-label">Pesan Default</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="pesan_wa" id="pesan_wa" class="form-control form-control-sm" value="<?= $setting->pesan_wa; ?>" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="letak_wa" class="col-sm-2 col-form-label">Letak</label>
                                        <div class="col-sm-2">
                                            <select name="letak_wa" id="letak_wa" class="form-control form-control-sm">
                                                <option value="kanan" <?= ($setting->letak_wa == 'kanan') ? 'selected' : ''; ?>>Kanan</option>
                                                <option value="kiri" <?= ($setting->letak_wa == 'kiri') ? 'selected' : ''; ?>>Kiri</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!-- akun sosial media -->
                                <div class="tab-pane fade" id="vert-tabs-settings" role="tabpanel" aria-labelledby="vert-tabs-settings-tab">
                                    <div class="form-group row">
                                        <label for="facebook" class="col-sm-2 col-form-label">Facebook</label>
                                        <div class="col-sm-6">
                                            <input type="text" name="facebook" id="facebook" class="form-control form-control-sm" value="<?= $setting->facebook; ?>" />
                                            <small class="form-text text-muted">Alamat link akun, kosongkan jika tidak punya</small>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="instagram" class="col-sm-2 col-form-label">Instagram</label>
                                        <div class="col-sm-6">
                                            <input type="text" name="instagram" id="instagram" class="form-control form-control-sm" value="<?= $setting->instagram; ?>" />
                                            <small class="form-text text-muted">Alamat link akun, kosongkan jika tidak punya</small>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="twitter" class="col-sm-2 col-form-label">Twitter</label>
                                        <div class="col-sm-6">
                                            <input type="text" name="twitter" id="twitter" class="form-control form-control-sm" value="<?= $setting->twitter; ?>" />
                                            <small class="form-text text-muted">Alamat link akun, kosongkan jika tidak punya</small>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="youtube" class="col-sm-2 col-form-label">Youtube</label>
                                        <div class="col-sm-6">
                                            <input type="text" name="youtube" id="youtube" class="form-control form-control-sm" value="<?= $setting->youtube; ?>" />
                                            <small class="form-text text-muted">Alamat link akun, kosongkan jika tidak punya</small>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="linkedin" class="col-sm-2 col-form-label">LinkedIn</label>
                                        <div class="col-sm-6">
                                            <input type="text" name="linkedin" id="linkedin" class="form-control form-control-sm" value="<?= $setting->linkedin; ?>" />
                                            <small class="form-text text-muted">Alamat link akun, kosongkan jika tidak punya</small>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="tiktok" class="col-sm-2 col-form-label">Tiktok</label>
                                        <div class="col-sm-6">
                                            <input type="text" name="tiktok" id="tiktok" class="form-control form-control-sm" value="<?= $setting->tiktok; ?>" />
                                            <small class="form-text text-muted">Alamat link akun, kosongkan jika tidak punya</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="submit" class="btn btn-primary mt-3" value="SIMPAN">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Dapatkan Id Kota -->
<div class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cara Mendapatkan ID Kota</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Untuk menemukan ID kota dari kota tertentu, cukup gunakan Google dan cari waktu sholat di kota Anda di Muslim Pro.</p>

                <p>Misalnya, cari "<b>Prayer Times Jakarta site:muslimpro.com</b>" di Google jika Anda mencari ID Kota Jakarta. Pastikan untuk menyertakan "site:muslimpro.com" dalam permintaan pencarian Anda untuk membatasi hasil pencarian hanya untuk Muslim Pro.</p>

                <p>ID kota yang Anda cari disertakan di akhir URL yang dikembalikan oleh Google. Dalam contoh di atas:</p>

                <p>http://www.muslimpro.com/Prayer-times-in-Jakarta-Indonesia-<b>1642911</b></p>

                <p>ID kota Anda adalah <b>1642911</b></p>

                <p>Sumber : https://support.muslimpro.com/hc/en-us/articles/202886274-How-do-I-add-Muslim-Pro-prayer-times-on-my-own-web-page-</p>
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
<link rel="stylesheet" href="<?= base_url() ?>assets/backend/plugins/summernote/summernote-bs4.min.css">
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script src="<?= base_url() ?>assets/backend/plugins/summernote/summernote-bs4.min.js"></script>
<script>
    jQuery(document).ready(function() {
        $('#summernote').summernote({
            height: 150, // set editor height
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
                url: "<?php echo site_url('ladmin/setting/upload_image') ?>",
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
                url: "<?php echo site_url('ladmin/setting/delete_image') ?>",
                cache: false,
                success: function(response) {
                    console.log(response);
                }
            });
        }
    });
</script>
<?= $this->endSection() ?>