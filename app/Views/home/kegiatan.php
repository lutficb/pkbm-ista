<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs" data-aos="fade-in">
        <div class="container">
            <h2>Kegiatan Siswa</h2>
        </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Events Section ======= -->
    <section id="events" class="events">
        <div class="container" data-aos="fade-up">

            <div class="row">
                <?php foreach ($kegiatan as $key => $value) : ?>
                    <div class="col-md-6 d-flex align-items-stretch">
                        <div class="card">
                            <div class="card-img">
                                <img src="<?= base_url('assets/img/img-kegiatan/' . $value->thumbnail); ?>" alt="<?= $value->nama_kategori; ?>">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"><a href="<?= base_url('galeri-kegiatan/' . $value->slug); ?>"><?= $value->nama_kategori; ?></a></h5>
                                <p class="card-text"><?= $value->info_kategori; ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>
    </section><!-- End Events Section -->

</main><!-- End #main -->
<?= $this->endSection(); ?>