<?= $this->extend('layout/admin/template'); ?>

<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="<?= base_url('kegiatan'); ?>" class="btn"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1><?= $subtitle; ?></h1>
    </div>

    <div class="section-body">
        <h2 class="section-title"><?= formatHariIndonesia(date('D')) . ', ' . formatTanggalIndo(date('d-m-Y')); ?></h2>
        <p class="section-lead"><?= $deskripsi; ?></p>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Input kegiatan siswa baru</h4>
                    </div>
                    <div class="card-body">
                        <form id="updatePages" action="<?= base_url('kegiatan'); ?>" method="post" enctype="multipart/form-data">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="_method" value="POST">
                            <div class="form-group row mb-4">
                                <label for="nama_kegiatan" class="col-form-label text-md-right col-12 col-md-3 col-lg-3 ">Nama Kegiatan</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" class="form-control <?= $validation->hasError('nama_kegiatan') ? 'is-invalid' : null; ?>" name="nama_kegiatan" id="nama_kegiatan" value="<?= old('nama_kegiatan'); ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('nama_kegiatan'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label for=kode_kategori" class="col-form-label text-md-right col-12 col-md-3 col-lg-3 ">Kategori Kegiatan</label>
                                <div class="col-sm-12 col-md-7">
                                    <select class="form-control selectric <?= $validation->hasError('kode_kategori') ? 'is-invalid' : null; ?>" name="kode_kategori" id="kode_kategori">
                                        <option value="" disabled <?= (!old('kode_kategori')) ? 'selected' : ''; ?>>- Pilih Kategori -</option>
                                        <?php foreach ($kategori as $key => $value) : ?>
                                            <option value="<?= $value->slug; ?>"><?= $value->nama_kategori; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('kode_kategori'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label for="gambar" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Thumbnail</label>
                                <div class="col-sm-12 col-md-3">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input <?= $validation->hasError('gambar') ? 'is-invalid' : null; ?>" id="thumbnail" name="gambar" onchange="thumbPrev()">
                                        <div class="invalid-feedback mt-1">
                                            <?= $validation->getError('gambar'); ?>
                                        </div>
                                        <label class="custom-file-label label-page-thumbnail" for="gambar">Pilih file...</label>
                                    </div>
                                    <small><b>Gunakan gambar dengan resolusi 1280 x 720 pixel untuk hasil terbaik</b></small>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <img src="<?= base_url('assets/img/img-kegiatan/img-default.jpg'); ?>" alt="" class="img-thumbnail thumb-preview">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label for="info_kegiatan" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Isi Konten</label>
                                <div class="col-sm-12 col-md-7">
                                    <textarea class="summernote-simple <?= $validation->hasError('info_kegiatan') ? 'is-invalid' : null; ?>" name="info_kegiatan" id="info_kegiatan" required></textarea>
                                    <div class="invalid-feedback mt-1">
                                        <?= $validation->getError('info_kegiatan'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                <div class="col-sm-12 col-md-7">
                                    <button class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<?= $this->endSection(); ?>