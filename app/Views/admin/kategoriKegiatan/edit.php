<?= $this->extend('layout/admin/template'); ?>

<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="<?= base_url('kategori-kegiatan'); ?>" class="btn"><i class="fas fa-arrow-left"></i></a>
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
                        <h4>Edit kategori kegiatan siswa.</h4>
                    </div>
                    <div class="card-body">
                        <form id="updatePages" action="<?= base_url('kategori-kegiatan/' . $kategori->id); ?>" method="post" enctype="multipart/form-data">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="file_lama" value="<?= $kategori->thumbnail; ?>">
                            <div class="form-group row mb-4">
                                <label for="nama_kategori" class="col-form-label text-md-right col-12 col-md-3 col-lg-3 ">Nama Kategori</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" class="form-control <?= $validation->hasError('nama_kategori') ? 'is-invalid' : null; ?>" name="nama_kategori" id="nama_kategori" value="<?= $kategori->nama_kategori; ?>" required>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('nama_kategori'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label for="thumbnail" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Thumbnail</label>
                                <div class="col-sm-12 col-md-3">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input <?= $validation->hasError('thumbnail') ? 'is-invalid' : null; ?>" id="thumbnail" name="thumbnail" onchange="thumbPrev()">
                                        <div class="invalid-feedback mt-1">
                                            <?= $validation->getError('thumbnail'); ?>
                                        </div>
                                        <label class="custom-file-label label-page-thumbnail" for="thumbnail"><?= $kategori->thumbnail; ?></label>
                                    </div>
                                    <small><b>Gunakan gambar dengan resolusi 800 x 533 pixel untuk hasil terbaik</b></small>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <img src="<?= base_url('assets/img/img-kegiatan/' . $kategori->thumbnail); ?>" alt="" class="img-thumbnail thumb-preview">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label for="info_kategori" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Info Kategori</label>
                                <div class="col-sm-12 col-md-7">
                                    <textarea class="summernote-simple <?= $validation->hasError('info_kategori') ? 'is-invalid' : null; ?>" name="info_kategori" id="info_kategori" required><?= $kategori->info_kategori; ?></textarea>
                                    <div class="invalid-feedback mt-1">
                                        <?= $validation->getError('info_kategori'); ?>
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