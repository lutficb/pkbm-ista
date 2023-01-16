<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs" data-aos="fade-in">
        <div class="container">
            <h2>Galeri <?= $kategori; ?></h2>
        </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Pricing Section ======= -->
    <section id="pricing" class="pricing">
        <div class="container" data-aos="fade-up">

            <div class="row">
                <?php foreach ($sarpras as $key => $value) : ?>
                    <div class="item col-sm-6 col-md-3 mb-4">
                        <a href="<?= base_url('assets/img/img-sarpras/' . $value->gambar); ?>" class="fancybox" data-fancybox="<?= $value->kategori; ?>">
                            <img src="<?= base_url('assets/img/img-sarpras/' . $value->gambar); ?>" width="100%" height="100%">
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>
    </section><!-- End Pricing Section -->

</main><!-- End #main -->
<?= $this->endSection(); ?>