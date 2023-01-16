<?php foreach ($post as $key => $value) : ?>
    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mb-3">
        <div class="course-item">
            <img src="<?= base_url('assets/img/img-post/' . $value->thumbnail); ?>" class="img-fluid" alt="...">
            <div class="course-content">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4><?= $value->kategori; ?></h4>
                    <p class=""><?= formatTanggalIndo($value->created_at); ?></p>
                </div>

                <h3><a href="<?= base_url('berita-lembaga/' . $value->slug); ?>"><?= $value->judul; ?></a></h3>
                <p><?= ringkasKalimat($value->isi, 20) . '...'; ?></p>
                <div class="trainer d-flex justify-content-between align-items-center">
                    <div class="trainer-profile d-flex align-items-center">
                        <a href="<?= base_url('berita-lembaga/' . $value->slug); ?>" class="btn-get-started">Selengkapnya ></a>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End Course Item-->
<?php endforeach; ?>