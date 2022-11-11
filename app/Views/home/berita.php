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
                <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                    <div class="course-item">
                        <img src="assets/img/img-1.png" class="img-fluid" alt="...">
                        <div class="course-content">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4>Kegiatan Santri</h4>
                                <p class="price"><?= date('d-m-Y'); ?></p>
                            </div>

                            <h3><a href="course-details.html">Pelatihan Perawatan Jenazah</a></h3>
                            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Soluta itaque sit molestias quod? Illo, molestiae, animi fugiat est facere distinctio fuga obcaecati eaque eveniet aperiam, aut tenetur impedit dolor maxime.</p>
                            <div class="trainer d-flex justify-content-between align-items-center">
                                <div class="trainer-profile d-flex align-items-center">
                                    <img src="assets/img/user-default.png" class="img-fluid" alt="">
                                    <span>Admin</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->
<?= $this->endSection(); ?>