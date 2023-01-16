<?= $this->extend('layout/admin/template'); ?>

<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="<?= base_url('posts'); ?>" class="btn"><i class="fas fa-arrow-left"></i></a>
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
                        <h4>Input postingan berita baru</h4>
                    </div>
                    <div class="card-body">
                        <?php $validation = Config\Services::validation(); ?>
                        <form id="updatePages" action="<?= base_url('posts'); ?>" method="post" enctype="multipart/form-data">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="_method" value="POST">
                            <div class="form-group row mb-4">
                                <label for="judul_post" class="col-form-label text-md-right col-12 col-md-3 col-lg-3 ">Judul Post</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" class="form-control <?= ($validation->hasError('judul_post')) ? 'is-invalid' : null; ?>" name="judul_post" id="judul_post" value="<?= old('judul_post'); ?>">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('judul_post'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label for=kode_kategori" class="col-form-label text-md-right col-12 col-md-3 col-lg-3 ">Kategori Post</label>
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
                                <label for="thumbnail" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Thumbnail</label>
                                <div class="col-sm-12 col-md-3">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input <?= $validation->hasError('thumbnail') ? 'is-invalid' : null; ?>" id="thumbnail" name="thumbnail" onchange="thumbPrev()">
                                        <div class="invalid-feedback mt-1">
                                            <?= $validation->getError('thumbnail'); ?>
                                        </div>
                                        <label class="custom-file-label label-page-thumbnail" for="thumbnail">Pilih file...</label>
                                    </div>
                                    <small><b>Gunakan gambar dengan resolusi 1100 x 523 pixel untuk hasil terbaik</b></small>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <img src="<?= base_url('assets/img/img-post/img-default.jpg'); ?>" alt="" class="img-thumbnail thumb-preview">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label for="konten_post" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Isi Konten</label>
                                <div class="col-sm-12 col-md-7">
                                    <textarea class="summernote-custom <?= $validation->hasError('konten_post') ? 'is-invalid' : null; ?>" name="konten_post" id="konten_post" required></textarea>
                                    <div class="invalid-feedback mt-1">
                                        <?= $validation->getError('konten_post'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label for=status" class="col-form-label text-md-right col-12 col-md-3 col-lg-3 ">Status</label>
                                <div class="col-sm-12 col-md-7">
                                    <select class="form-control selectric <?= $validation->hasError('status') ? 'is-invalid' : null; ?>" name="status" id="status">
                                        <option value="" disabled <?= (!old('status')) ? 'selected' : ''; ?>>- Status Post -</option>
                                        <option value="draft">Draft</option>
                                        <option value="publish">Publish</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('kode_kategori'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                <div class="col-sm-12 col-md-7">
                                    <button class="btn btn-primary"><i class="fas fa-save"></i> Buat Post</button>
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

<?= $this->section('script'); ?>
<script>
    $(document).ready(function() {
        $(".summernote-custom").summernote({
            dialogsInBody: true,
            minHeight: 250,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear', 'italic']],
                ['fontname', ['fontname']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['link', ['unlink']],
                ['view', ['fullscreen', 'help']],
            ],
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
            let data = new FormData();
            data.append('img', image);

            $.ajax({
                type: "POST",
                url: "<?= base_url('/home/uploadImgArticle'); ?>",
                cache: false,
                contentType: false,
                processData: false,
                data: data,
                success: function(url) {
                    $('.summernote-custom').summernote("insertImage", url);
                },
                error: function(data) {
                    console.log(data);
                }
            });
        }

        function deleteImage(src) {
            $.ajax({
                data: {
                    image: src
                },
                type: "POST",
                url: "<?= base_url('home/deleteImgArticle') ?>",
                cache: false,
                success: function(rest) {
                    console.log(rest);
                }
            });
        }
    });
</script>
<?= $this->endSection(); ?>