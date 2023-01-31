<?= $this->extend('layout/admin/template'); ?>

<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="<?= base_url('data-siswa-psb'); ?>" class="btn"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1><?= $subtitle; ?></h1>
    </div>

    <div class="section-body">
        <h2 class="section-title"><?= formatHariIndonesia(date('D')) . ', ' . formatTanggalIndo(date('d-m-Y')); ?></h2>
        <p class="section-lead"><?= $deskripsi; ?></p>

        <div class="row mt-sm-4">
            <div class="col-12 col-md-12 col-lg-5">
                <div class="card profile-widget">
                    <div class="profile-widget-header">
                        <img alt="image" src="<?= base_url('assets/berkas/foto/' . $peserta->foto_peserta); ?>" class="profile-widget-picture">
                        <div class="profile-widget-items">
                            <div class="profile-widget-item">
                                <div class="profile-widget-item-label">Umur</div>
                                <div class="profile-widget-item-value">14 Tahun</div>
                            </div>
                            <div class="profile-widget-item">
                                <div class="profile-widget-item-label">Asal Kota</div>
                                <div class="profile-widget-item-value"><?= $peserta->kabupaten; ?></div>
                            </div>
                            <div class="profile-widget-item">
                                <div class="profile-widget-item-label">Asal Sekolah</div>
                                <div class="profile-widget-item-value"><?= $peserta->asal_sekolah; ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="profile-widget-description">
                        <div class="profile-widget-name"><?= $peserta->nama; ?> <div class="text-muted d-inline font-weight-normal">
                                <div class="slash"></div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center">

                    </div>
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-7">
                <div class="card">

                    <div class="card-header">
                        <h4>Berkas Pendaftaran</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>Nama Berkas</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-center">
                                    <th>1</th>
                                    <td>Foto Peserta</td>
                                    <td>
                                        <!-- <a href="" class="btn btn-success btn-sm mr-3"><i class="fas fa-book-reader"></i> Lihat</a> -->
                                        <a href="<?= base_url('download-foto/' . $peserta->slug); ?>" target="_blank" class="btn btn-warning btn-sm"><i class="fas fa-download"></i> Unduh</a>
                                    </td>
                                </tr>
                                <tr class="text-center">
                                    <th>2</th>
                                    <td>Akta Kelahiran</td>
                                    <td>
                                        <!-- <a href="" class="btn btn-success btn-sm mr-3"><i class="fas fa-book-reader"></i> Lihat</a> -->
                                        <a href="<?= base_url('download-akta/' . $peserta->slug); ?>" target="_blank" class="btn btn-warning btn-sm"><i class="fas fa-download"></i> Unduh</a>
                                    </td>
                                </tr>
                                <tr class="text-center">
                                    <th>3</th>
                                    <td>Kartu Keluarga</td>
                                    <td>
                                        <!-- <a href="" class="btn btn-success btn-sm mr-3"><i class="fas fa-book-reader"></i> Lihat</a> -->
                                        <a href="<?= base_url('download-kk/' . $peserta->slug); ?>" target="_blank" class="btn btn-warning btn-sm"><i class="fas fa-download"></i> Unduh</a>
                                    </td>
                                </tr>
                                <tr class="text-center">
                                    <th>4</th>
                                    <td>NISN</td>
                                    <td>
                                        <!-- <a href="" class="btn btn-success btn-sm mr-3"><i class="fas fa-book-reader"></i> Lihat</a> -->
                                        <a href="<?= base_url('download-nisn/' . $peserta->slug); ?>" target="_blank" class="btn btn-warning btn-sm"><i class="fas fa-download"></i> Unduh</a>
                                    </td>
                                </tr>
                                <tr class="text-center">
                                    <th>5</th>
                                    <td>KIP</td>
                                    <td>
                                        <!-- <a href="" class="btn btn-success btn-sm mr-3"><i class="fas fa-book-reader"></i> Lihat</a> -->
                                        <a href="<?= base_url('download-kip/' . $peserta->slug); ?>" target="_blank" class="btn btn-warning btn-sm"><i class="fas fa-download"></i> Unduh</a>
                                    </td>
                                </tr>
                                <tr class="text-center">
                                    <th>6</th>
                                    <td>PKH</td>
                                    <td>
                                        <!-- <a href="" class="btn btn-success btn-sm mr-3"><i class="fas fa-book-reader"></i> Lihat</a> -->
                                        <a href="<?= base_url('download-pkh/' . $peserta->slug); ?>" target="_blank" class="btn btn-warning btn-sm"><i class="fas fa-download"></i> Unduh</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>