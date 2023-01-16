<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<main id="main">
    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs" data-aos="fade-in">
        <div class="container">
            <h2><?= $paketb->judul_halaman; ?></h2>
            <p>Program Kesetaraan Paket B adalah program pendidikan non formal setara dengan SMP/MTs/MSW </p>
        </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
        <div class="container" data-aos="fade-up">

            <div class="row">
                <div class="col-lg-12 pt-4 pt-lg-0 order-2 order-lg-1 content">
                    <?= $paketb->isi_halaman; ?>
                </div>
            </div>

        </div>
    </section><!-- End About Section -->
</main><!-- End #main -->
<?= $this->endSection(); ?>