<?= $this->extend('layout/admin/template'); ?>

<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="<?= base_url('kategori-blog'); ?>" class="btn"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1><?= $subtitle; ?></h1>
    </div>

    <div class="section-body">
        <h2 class="section-title"><?= formatHariIndonesia(date('D')) . ', ' . formatTanggalIndo(date('d-m-Y')); ?></h2>
        <p class="section-lead"><?= $deskripsi; ?></p>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit kategori blog.</h4>
                    </div>
                    <div class="card-body">
                        <div class="empty-state" data-height="400">
                            <div class="empty-state-icon">
                                <i class="fas fa-question"></i>
                            </div>
                            <h2>Data tidak ditemukan</h2>
                            <p class="lead">
                                <?= $pesan; ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<?= $this->endSection(); ?>