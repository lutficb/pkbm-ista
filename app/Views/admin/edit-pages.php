<?= $this->extend('layout/admin/template'); ?>

<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="<?= base_url('pages'); ?>" class="btn"><i class="fas fa-arrow-left"></i></a>
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
                        <h4>Edit Halaman <?= $page->judul_halaman; ?></h4>
                    </div>
                    <div class="card-body">
                        <form id="updatePages" action="<?= base_url('pages/' . $page->id); ?>" method="post" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="file-lama" id="file-lama" value="<?= $page->thumbnail; ?>">
                            <div class="form-group row mb-4">
                                <label for="judul_halaman" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Judul</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" class="form-control" name="judul_halaman" id="judul_halaman" value="<?= $page->judul_halaman; ?>" disabled required>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label for="thumbnail" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Thumbnail</label>
                                <div class="col-sm-12 col-md-3">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="thumbnail" name="thumbnail" onchange="thumbPrev()">
                                        <label class="custom-file-label label-page-thumbnail" for="inputGroupFile04"><?= $page->thumbnail; ?></label>
                                    </div>
                                    <small><b>Gunakan gambar dengan resolusi 1024 x 768 pixel untuk hasil terbaik</b></small>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <img src="<?= base_url(); ?>/assets/img/img-pages/<?= $page->thumbnail; ?>" alt="" class="img-thumbnail thumb-preview">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label for="isi_halaman" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Isi Halaman</label>
                                <div class="col-sm-12 col-md-7">
                                    <textarea class="summernote-custom" name="isi_halaman" id="isi_halaman" required><?= $page->isi_halaman; ?></textarea>
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