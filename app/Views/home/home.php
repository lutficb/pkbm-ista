<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex justify-content-center align-items-center">
    <div class="container position-relative" data-aos="zoom-in" data-aos-delay="100">
        <h1><?= $home->headline1; ?><br><?= $home->headline2; ?></h1>
        <h2><?= $home->headline3; ?></h2>
        <a href="<?= base_url('tentang-lembaga'); ?>" class="btn-get-started">Selanjutnya</a>
    </div>
</section><!-- End Hero -->

<main id="main">
    <!-- ======= About Section ======= -->
    <section id="about" class="about">
        <div class="container" data-aos="fade-up">
            <div class="row">
                <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="100">
                    <img src="theme/assets/img/pkbm/ponpes2.jpg" class="img-fluid" alt="">
                </div>
                <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content">
                    <h3>Sambutan Kepala PKBM IMAM SYAFI'I Tulungagung</h3>
                    <?= $home->sambutan; ?>
                </div>
            </div>
        </div>
    </section><!-- End About Section -->

    <!-- ======= Counts Section ======= -->
    <section id="counts" class="counts section-bg">
        <div class="container">

            <div class="row counters">

                <div class="col-lg-3 col-6 text-center">
                    <span data-purecounter-start="0" data-purecounter-end="<?= $home->jml_paket_b + $home->jml_paket_c; ?>" data-purecounter-duration="1" class="purecounter"></span>
                    <p>Warga Belajar</p>
                </div>

                <div class="col-lg-3 col-6 text-center">
                    <span data-purecounter-start="0" data-purecounter-end="<?= $home->jml_paket_b; ?>" data-purecounter-duration="1" class="purecounter"></span>
                    <p>Paket B</p>
                </div>

                <div class="col-lg-3 col-6 text-center">
                    <span data-purecounter-start="0" data-purecounter-end="<?= $home->jml_paket_c; ?>" data-purecounter-duration="1" class="purecounter"></span>
                    <p>Paket C</p>
                </div>

                <div class="col-lg-3 col-6 text-center">
                    <span data-purecounter-start="0" data-purecounter-end="30" data-purecounter-duration="1" class="purecounter"></span>
                    <p>Tutor</p>
                </div>

            </div>

        </div>
    </section><!-- End Counts Section -->

    <!-- ======= Why Us Section ======= -->
    <section id="why-us" class="why-us">
        <div class="container" data-aos="fade-up">

            <div class="row">
                <div class="col-lg-4 d-flex align-items-stretch">
                    <div class="content">
                        <h3>Kenapa Memilih PKBM Imam Syafi'i?</h3>
                        <?= $home->why_us; ?>
                        <div class="text-center">
                            <a href="<?= base_url('tentang-lembaga'); ?>" class="more-btn">Selanjutnya <i class="bx bx-chevron-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                    <div class="icon-boxes d-flex flex-column justify-content-center">
                        <div class="row">
                            <div class="col-xl-4 d-flex align-items-stretch">
                                <div class="icon-box mt-4 mt-xl-0">
                                    <i class='bx bxs-home-smile'></i>
                                    <h4><?= $home->judul_keunggulan1; ?></h4>
                                    <p><?= $home->keunggulan1; ?></p>
                                </div>
                            </div>
                            <div class="col-xl-4 d-flex align-items-stretch">
                                <div class="icon-box mt-4 mt-xl-0">
                                    <i class='bx bx-money'></i>
                                    <h4><?= $home->judul_keunggulan2; ?></h4>
                                    <p><?= $home->keunggulan2; ?></p>
                                </div>
                            </div>
                            <div class="col-xl-4 d-flex align-items-stretch">
                                <div class="icon-box mt-4 mt-xl-0">
                                    <i class='bx bx-landscape'></i>
                                    <h4><?= $home->judul_keunggulan3; ?></h4>
                                    <p><?= $home->keunggulan3; ?></p>
                                </div>
                            </div>
                        </div>
                    </div><!-- End .content-->
                </div>
            </div>

        </div>
    </section><!-- End Why Us Section -->

    <!-- ======= Berita Terbaru Section ======= -->
    <section id="popular-courses" class="courses">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Berita</h2>
                <p>Berita Terbaru</p>
            </div>

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
                </div> <!-- End Course Item-->
            </div>

        </div>
    </section><!-- End Berita Terbaru Section -->

</main><!-- End #main -->
<?= $this->endSection(); ?>