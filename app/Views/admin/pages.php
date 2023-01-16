<?= $this->extend('layout/admin/template'); ?>

<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1><?= $subtitle; ?></h1>
    </div>

    <div class="section-body">
        <h2 class="section-title"><?= formatHariIndonesia(date('D')) . ', ' . formatTanggalIndo(date('d-m-Y')); ?></h2>
        <p class="section-lead"><?= $deskripsi; ?></p>

        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                    <?= session()->getFlashdata('success'); ?>
                </div>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')) : ?>
            <div class="alert alert-danger alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                    <?= session()->getFlashdata('error'); ?>
                </div>
            </div>
        <?php endif; ?>

        <div class="card">
            <div class="card-header justify-content-between">
                <h4>Konten-konten halaman utama</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-md table-pages">
                        <tr class="text-center">
                            <th>#</th>
                            <th style="width: 15%" class="mx-auto">Nama Halaman</th>
                            <th>Thumbnail</th>
                            <th>Isi Konten</th>
                            <th style="width: 20%;">Aksi</th>
                        </tr>
                        <?php $i = 1 ?>
                        <?php foreach ($pages as $key => $value) : ?>
                            <tr>
                                <td><?= $i; ?></td>
                                <td><?= $value->judul_halaman; ?></td>
                                <td><img src="<?= base_url(); ?>/assets/img/img-pages/<?= $value->thumbnail; ?>" alt="" class="img-thumbnail"></td>
                                <td><?= ringkasKalimat($value->isi_halaman, 30); ?></td>
                                <td class="text-center">
                                    <a href="<?= base_url('edit-pages/' . $value->id); ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                </td>
                            </tr>
                            <?php $i++ ?>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>