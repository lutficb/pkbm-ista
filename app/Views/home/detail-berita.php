<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<main id="main">
    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs" data-aos="fade-in">
        <div class="container">
            <h2>Berita Terbaru</h2>
            <p>Kumpulan artikel dan informasi terbaru terkait dengan PKBM Imam Syafi'i Tulungagung</p>
        </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Detail Berita Section ======= -->
    <section id="course-details" class="course-details">
        <div class="container" data-aos="fade-up">

            <div class="row">
                <div class="col-lg-8">
                    <img src="<?= base_url('assets/img/img-post/' . $post->thumbnail); ?>" class="img-fluid" alt="">
                    <h3><?= $post->judul; ?></h3>
                    <?= $post->isi; ?>
                </div>
                <div class="col-lg-4">

                </div>
            </div>

        </div>
    </section><!-- End Detail Berita Section -->

    <section id="cource-details-tabs" class="cource-details-tabs">
        <div class="container" data-aos="fade-up">

            <div class="row">
                <div class="col-lg-8">
                    <h4 class="mb-3">Berita lainnya</h4>
                    <div class="row justify-content-between p-3">
                        <div class="col-lg-6">
                            <?php if ($postPrev != null) : ?>
                                <a href="<?= base_url('berita-lembaga/' . $postPrev->slug); ?>" class="btn-get-started">
                                    <div class="row justify-content-start">
                                        <div class="col-lg-2">
                                            <div class="chevron-left"></div>
                                        </div>
                                        <div class="col-lg-8">
                                            <img src="<?= base_url('assets/img/img-post/' . $postPrev->thumbnail); ?>" alt="" style="width: 50%;">
                                            <p><?= $postPrev->judul; ?></p>
                                        </div>
                                    </div>
                                </a>
                            <?php endif; ?>
                        </div>
                        <div class="col-lg-6">
                            <?php if ($postNext != null) : ?>
                                <a href="<?= base_url('berita-lembaga/' . $postNext->slug); ?>" class="btn-get-started">
                                    <div class="row justify-content-end">
                                        <div class="col-lg-8 text-end">
                                            <img src="<?= base_url('assets/img/img-post/' . $postNext->thumbnail); ?>" alt="" style="width: 50%;">
                                            <p><?= $postNext->judul; ?></p>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="chevron-right"></div>
                                        </div>
                                    </div>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section><!-- End Cource Details Tabs Section -->

</main><!-- End #main -->
<?= $this->endSection(); ?>