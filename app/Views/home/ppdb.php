<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<main id="main">
    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs" data-aos="fade-in">
        <div class="container">
            <h2>Penerimaan Peserta Didik Baru (PPDB)</h2>
            <p>PKBM Imam Syafi'i Tulungagung menerima Peserta Didik Baru setiap tahunnya, untuk mendaftar silahkan baca informasi di bawah</p>
        </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= PPDB Section ======= -->
    <section id="ppdb" class="contact">
        <div class="container" data-aos="fade-up">
            <div class="row mt-3">
                <div class="col-lg-12 pt-4 pt-lg-0 order-2 order-lg-1 content">
                    <h3>Cara dan Syarat Pendaftaran</h3>
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Modi labore voluptatem suscipit, quidem aperiam laudantium impedit, debitis veritatis ut beatae eius laborum vero architecto illo unde repellendus dolorum facilis autem ipsa reprehenderit atque! Dolorum sint temporibus quaerat ut quas doloribus doloremque minus animi asperiores suscipit quis mollitia aliquid ducimus, necessitatibus recusandae molestiae consequatur repudiandae consequuntur laborum, id iure inventore, nisi dolore alias! Odit facilis perferendis, eligendi quae esse repellendus corporis impedit minima vero asperiores dignissimos libero error pariatur obcaecati nesciunt accusantium quod quis, aut officiis nisi sapiente, veniam dolorem vel accusamus! Voluptate aut quibusdam aperiam animi accusamus sapiente commodi possimus quod veritatis asperiores quaerat ad mollitia corrupti doloribus laudantium suscipit itaque a quo, officia molestias? Nemo non neque sunt est velit tenetur possimus vel! Alias sit aperiam culpa ipsa, aliquam unde quo voluptates nemo deleniti! Eos ipsum sapiente aliquid adipisci. Harum eius debitis asperiores, ducimus dolorum enim quod assumenda dolore atque nisi odio fugit libero laudantium voluptatum eveniet minima molestiae veritatis quasi illum provident, repudiandae amet vel aspernatur. Non, totam veritatis quia repellendus suscipit odit numquam illum sapiente libero excepturi ex similique maiores iste a tempore, doloremque eligendi odio unde laudantium? Porro officiis expedita labore neque sint sed ab rerum.</p>
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