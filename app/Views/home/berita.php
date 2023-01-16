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

    <section id="berita-terbaru" class="courses">
        <div class="container" data-aos="fade-up">
            <div class="row" data-aos="zoom-in" data-aos-delay="100">

                <?php foreach ($post as $key => $item) : ?>
                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mb-4">
                        <div class="course-item">
                            <img src="assets/img/img-post/<?= $item->thumbnail; ?>" class="img-fluid" alt="...">
                            <div class="course-content">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4><?= $item->kategori; ?></h4>
                                    <p><?= formatTanggalIndo($item->created_at); ?></p>
                                </div>

                                <h3><a href="<?= base_url('berita-lembaga/' . $item->slug); ?>"><?= $item->judul; ?></a></h3>
                                <p><?= ringkasKalimat($item->isi, 20) . '...'; ?></p>
                                <div class="trainer d-flex justify-content-between align-items-center">
                                    <div class="trainer-profile d-flex align-items-center">
                                        <a href="<?= base_url('berita-lembaga/' . $item->slug); ?>" class="btn-get-started">Selengkapnya ></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>
    </section>
</main><!-- End #main -->
<?= $this->endSection(); ?>