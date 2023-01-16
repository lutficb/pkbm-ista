<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>PKBM Imam Syafi'i | <?= $title; ?></title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="<?= base_url(); ?>/theme/assets/img/favicon-pkbm.png" rel="icon">
    <link href="<?= base_url(); ?>/theme/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?= base_url(); ?>/theme/assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>/theme/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="<?= base_url(); ?>/theme/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>/theme/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= base_url(); ?>/theme/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>/theme/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="<?= base_url(); ?>/theme/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0.31/dist/fancybox.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="<?= base_url(); ?>/theme/assets/css/style.css" rel="stylesheet">

    <!-- Custom style -->
    <link href="<?= base_url(); ?>/assets/css/mystyle.css" rel="stylesheet">
</head>

<body>
    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top">
        <div class="container d-flex align-items-center">

            <h1 class="logo me-auto"><a href="<?= base_url('home'); ?>">PKBM IMAM SYAFI'I</a></h1>

            <nav id="navbar" class="navbar order-last order-lg-0">
                <ul class="navbar-menu">
                    <li><a id="home" href="<?= base_url('home'); ?>">Home</a></li>
                    <li class="dropdown"><a href="#"><span>Profil</span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li><a href="<?= base_url('tentang-lembaga'); ?>">Tentang Lembaga</a></li>
                            <li><a href="<?= base_url('visi-dan-misi'); ?>">Visi & Misi</a></li>
                            <li><a href="<?= base_url('legalitas-lembaga'); ?>">Legalitas Lembaga</a></li>
                            <li><a href="<?= base_url('sarana-prasarana'); ?>">Sarana & Prasarana</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a href="#"><span>Program</span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li><a href="<?= base_url('kesetaraan-paket-b'); ?>">Paket B (SMP/MTs/MSW)</a></li>
                            <li><a href="<?= base_url('kesetaraan-paket-c'); ?>">Paket C (SMA/MA/MSU</a></li>
                        </ul>
                    </li>
                    <li><a href="<?= base_url('tutor-dan-staff'); ?>">Tutor & Staff</a></li>
                    <li><a href="<?= base_url('kegiatan-siswa'); ?>">Kegiatan Siswa</a></li>
                    <li><a href="<?= base_url('berita-lembaga'); ?>">Berita</a></li>
                    <li><a href="<?= base_url('penerimaan-peserta-didik-baru'); ?>">PPDB</a></li>
                    <li><a href="<?= base_url('kontak-kami'); ?>">Kontak</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->
        </div>
    </header><!-- End Header -->

    <!-- ======= Main Content ======= -->
    <?= $this->renderSection('content'); ?>

    <!-- ======= Footer ======= -->
    <footer id="footer">
        <div class="footer-top">
            <div class="container">
                <div class="row">

                    <!-- view cell untuk menampilkan data dari database pada partial view -->
                    <?= view_cell('\App\Libraries\Widget::footer'); ?>

                    <div class="col-lg-2 col-md-6 footer-links">
                        <h4>Link Lainnya</h4>
                        <ul>
                            <li><i class="bx bx-chevron-right"></i> <a href="<?= base_url('home'); ?>">Home</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="<?= base_url('tentang-lembaga'); ?>">Tentang Kami</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="<?= base_url('legalitas-lembaga'); ?>">Legalitas</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="<?= base_url('sarana-prasarana'); ?>">Sarpras</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="<?= base_url('dashboard'); ?>">Login</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Partner Kami</h4>
                        <ul>
                            <li><i class="bx bx-chevron-right"></i> <a href="https://ponpesimamsyafii.or.id">Ponpes Imam Syafi'i</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="https://psb.ponpesimamsyafii.or.id">PSB Ponpes Imam Syafi'i</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">KSMI Tulungagung</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-4 col-md-6 footer-newsletter">
                        <h4>Langganan Berita Kami</h4>
                        <p>Untuk terus mendapatkan update dari kami. Silahkan masukan email anda.</p>
                        <form action="" method="post">
                            <input type="email" name="email"><input type="submit" value="Langganan">
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <div class="container d-md-flex py-4">

            <div class="me-md-auto text-center text-md-start">
                <div class="copyright">
                    &copy; <?= date('Y'); ?> Copyright <strong><span>PKBM Imam Syafi'i</span></strong>. All Rights Reserved
                </div>
            </div>
        </div>
    </footer><!-- End Footer -->

    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="<?= base_url(); ?>/theme/assets/vendor/aos/aos.js"></script>
    <script src="<?= base_url(); ?>/theme/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url(); ?>/theme/assets/vendor/php-email-form/validate.js"></script>
    <script src="<?= base_url(); ?>/theme/assets/vendor/purecounter/purecounter.js"></script>
    <script src="<?= base_url(); ?>/theme/assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="<?= base_url(); ?>/admin-theme/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0.31/dist/fancybox.umd.min.js"></script>

    <!-- Template Main JS File -->
    <script src="<?= base_url(); ?>/theme/assets/js/main.js"></script>

    <!-- My Custom Script -->
    <script src="<?= base_url(); ?>/assets/js/myscript.js"></script>

</body>

</html>