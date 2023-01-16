<?= $this->extend('layout/admin/template'); ?>

<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1><?= $subtitle; ?></h1>
    </div>

    <div class="section-body">
        <h2 class="section-title"><?= formatHariIndonesia(date('D')) . ', ' . formatTanggalIndo(date('d-m-Y')); ?></h2>
        <p class="section-lead">Pengaturan konten-konten yang muncul di halaman utama website.</p>

        <div class="card">
            <div class="card-header justify-content-between">
                <h4>Konten-konten halaman utama</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-md">
                        <tr>
                            <th>#</th>
                            <th style="width: 25%;">Nama Konten</th>
                            <th>Isi Konten</th>
                        </tr>
                    </table>
                </div>
                <p class="text-center"><?= $pesan; ?></p>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>