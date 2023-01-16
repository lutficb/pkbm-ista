<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<main id="main">
    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs" data-aos="fade-in">
        <div class="container">
            <h2><?= $tutor->judul_halaman; ?></h2>
            <p>Staff pengajar, tutor dan karyawan lainnya di PKBM Imam Syafi'i adalah individu yang memiliki keahlian di bidangnya masing-masing</p>
        </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Tutor Section ======= -->
    <section id="tutor" class="about">
        <div class="container" data-aos="fade-up">

            <div class="row">
                <div class="col-lg-12 pt-4 pt-lg-0 order-2 order-lg-1 content">
                    <?= $tutor->isi_halaman; ?>
                </div>
            </div>

        </div>
    </section><!-- End About Section -->
</main><!-- End #main -->
<?= $this->endSection(); ?>