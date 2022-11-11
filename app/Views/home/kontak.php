<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs" data-aos="fade-in">
        <div class="container">
            <h2>Kontak Kami</h2>
            <p>Untuk informasi lebih lanjut terkait PKBM Imam Syafi'i baik dalam hal pendidikan, pendaftaran, kerja sama dan hal lainnya. Silahkan menghubungi kami pada kontak kami di bawah ini.</p>
        </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
        <div data-aos="fade-up">
            <iframe style="border:0; width: 100%; height: 350px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3950.6624290440004!2d111.92096141536652!3d-8.033696982438169!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e78fda5f392c63b%3A0x1b9257c2f867b83!2sMSU%20dan%20MSW%20Putra%20Imam%20Syafi&#39;i!5e0!3m2!1sen!2sid!4v1667644972601!5m2!1sen!2sid" frameborder="0" allowfullscreen></iframe>
        </div>

        <div class="container" data-aos="fade-up">

            <div class="row mt-5">

                <div class="col-lg-4">
                    <div class="info">
                        <div class="address">
                            <i class="bi bi-geo-alt"></i>
                            <h4>Lokasi:</h4>
                            <p>Jalan Jayeng Kusuma Gg. 1, Dusun Donorejo, Desa Tapan, Kec. Kedungwaru, Kab. Tulungagung, Jawa Timur - 66229</p>
                        </div>

                        <div class="email">
                            <i class="bi bi-envelope"></i>
                            <h4>Email:</h4>
                            <p>pkbm.ista@gmail.com</p>
                        </div>

                        <div class="phone">
                            <i class="bi bi-phone"></i>
                            <h4>No. Telpon:</h4>
                            <p>+62812-1462-6278</p>
                        </div>

                    </div>

                </div>

                <div class="col-lg-8 mt-5 mt-lg-0">

                    <form action="forms/contact.php" method="post" role="form" class="php-email-form">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="text" name="name" class="form-control" id="name" placeholder="Nama anda" required>
                            </div>
                            <div class="col-md-6 form-group mt-3 mt-md-0">
                                <input type="email" class="form-control" name="email" id="email" placeholder="Alamat Email anda" required>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <input type="text" class="form-control" name="subject" id="subject" placeholder="Topik Pertanyaan" required>
                        </div>
                        <div class="form-group mt-3">
                            <textarea class="form-control" name="message" rows="5" placeholder="Tulis pesan di sini" required></textarea>
                        </div>
                        <div class="my-3">
                            <div class="loading">Mengirim</div>
                            <div class="error-message"></div>
                            <div class="sent-message">Pesan anda telah terkirim. Terimakasih!</div>
                        </div>
                        <div class="text-center"><button type="submit">Kirim Pesan</button></div>
                    </form>

                </div>

            </div>

        </div>
    </section><!-- End Contact Section -->

</main><!-- End #main -->
<?= $this->endSection(); ?>