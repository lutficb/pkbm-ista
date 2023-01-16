<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<main id="main">
    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs" data-aos="fade-in">
        <div class="container">
            <h2><?= $ppdb->judul_halaman; ?></h2>
            <p>PKBM Imam Syafi'i Tulungagung menerima Peserta Didik Baru setiap tahunnya, untuk mendaftar silahkan baca informasi di bawah</p>
        </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= PPDB Section ======= -->
    <section id="ppdb" class="contact">
        <div class="container" data-aos="fade-up">
            <div class="row mt-3">
                <div class="col-lg-12 pt-4 pt-lg-0 order-2 order-lg-1 content">
                    <?= $ppdb->isi_halaman; ?>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-lg-12 pt-4 pt-lg-0 order-2 order-lg-1 content">
                    <h4>Formulir Pendataran</h4>
                    <form action="" method="post" role="form" class="php-email-form mt-3">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="mb-2" for="namaLengkap">Nama Lengkap</label>
                                <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama lengkap" required>
                            </div>
                            <div class="col-md-6 form-group mt-3 mt-md-0">
                                <label class="mb-2" for="namaOrtu">Nama Orang Tua</label>
                                <input type="text" class="form-control" name="namaOrtu" id="namaOrtu" placeholder="Nama orang tua" required>
                            </div>
                        </div>
                        <div class="row form-group mt-3">
                            <div class="col-md-6 form-group">
                                <label class="mb-2" for="nisn">NISN (Jika ada)</label>
                                <input type="text" name="nisn" class="form-control" id="nisn" placeholder="NISN" required>
                            </div>
                            <div class="col-md-6 form-group mt-3 mt-md-0">
                                <label class="mb-2" for="jenjang">Pilihan Jenjang</label>
                                <select class="custom-select form-control" id="jenjang" required>
                                    <option selected>-- Pilih Jenjang --</option>
                                    <option value="paketb">Kesetaraan Paket B</option>
                                    <option value="paketc">Kesetaraan Paket C</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <div class="col-md-12 form-group">
                                <label class="mb-2" for="alamat">Pilihan Jenjang</label>
                                <textarea class="form-control" name="alamat" id="alamat" rows="10" placeholder="Alamat lengkap" required></textarea>
                            </div>
                        </div>
                        <div class="text-center"><button type="submit">Kirim Pendaftaran</button></div>
                    </form>
                </div>
            </div>
        </div>
    </section><!-- End About Section -->
</main><!-- End #main -->
<?= $this->endSection(); ?>