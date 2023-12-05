<?= $this->extend('backend/layout/app') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <?php if (session()->getFlashdata('pesan')) : ?>
                    <?= session()->getFlashdata('pesan'); ?>
                <?php endif; ?>
                <p><code>Pastikan Anda faham kode html atau javascript, kode/script yang ditambahkan akan mempengaruhi website secara umum.</code></p>
                <form action="<?= base_url('ladmin/setting/update_codex'); ?>" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id_setting" id="id_setting" value="<?= $setting->id_setting; ?>">

                    <div class="form-group row">
                        <label for="cdx_header" class="col-sm-2 col-form-label">Header</label>
                        <div class="col-sm-10">
                            <textarea name="cdx_header" id="cdx_header" rows="6" class="form-control"><?= $setting->cdx_header; ?></textarea>
                            Kode HTML, css, javascript tambahan diletakkan sebelum tag &lt;/head&gt;
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <label for="cdx_footer" class="col-sm-2 col-form-label">Footer</label>
                        <div class="col-sm-10">
                            <textarea name="cdx_footer" id="cdx_footer" rows="6" class="form-control"><?= $setting->cdx_footer; ?></textarea>
                            Kode HTML, css, javascript tambahan diletakkan sebelum tag &lt;/body&gt;
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <label for="simpan" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10">
                            <input type="submit" class="btn btn-primary" value="SIMPAN">
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>