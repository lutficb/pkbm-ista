<?= $this->extend('layout/admin/template'); ?>

<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1>Dashboard</h1>
    </div>

    <div class="section-body">
        <h2 class="section-title"><?= formatHariIndonesia(date('D')) . ', ' . formatTanggalIndo(date('d-m-Y')); ?></h2>
        <p class="section-lead">Pengaturan konten-konten yang muncul di halaman utama website.</p>

        <div class="card">
            <div class="card-header">
                <h4>Pengaturan Halaman Utama</h4>
            </div>
            <div class="card-body">
                <form action="<?= base_url('home/' . $home->id); ?>" method="post" autocomplete="off">
                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="PUT">
                    <div class="form-group row">
                        <label for="headline1" class="col-sm-2 col-form-label">Headline 1</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="headline1" name="headline1" value="<?= $home->headline1; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="headline2" class="col-sm-2 col-form-label">Headline 2</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="headline2" name="headline2" value="<?= $home->headline2; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="headline3" class="col-sm-2 col-form-label">Headline 3</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="headline3" name="headline3" value="<?= $home->headline3; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="sambutan" class="col-sm-2 col-form-label">Sambutan Kepala PKBM</label>
                        <div class="col-sm-8">
                            <textarea class="summernote-simple" name="sambutan" id="sambutan"><?= $home->sambutan; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="why_us" class="col-sm-2 col-form-label">Kenapa memilih PKBM Imam Syafi'i</label>
                        <div class="col-sm-8">
                            <textarea class="summernote-simple" name="why_us" id="why_us"><?= $home->why_us; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jml_paket_b" class="col-sm-2 col-form-label">Warga Belajar Paket B</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" id="jml_paket_b" name="jml_paket_b" value="<?= $home->jml_paket_b; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jml_paket_c" class="col-sm-2 col-form-label">Warga Belajar Paket C</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" id="jml_paket_c" name="jml_paket_c" value="<?= $home->jml_paket_c; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tutor" class="col-sm-2 col-form-label">Tutor</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" id="tutor" name="tutor" value="<?= $home->tutor; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="alamat" class="col-sm-2 col-form-label">Alamat PKBM</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" name="alamat" id="alamat" rows="3"><?= $home->alamat; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control phone-number" name="phone" id="phone" value="<?= $home->phone; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-4">
                            <input type="email" class="form-control" name="email" id="email" value="<?= $home->email; ?>">
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="card-footer col-sm-4">
                            <button class="btn btn-primary btn-block"><i class="fas fa-save"></i> Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>