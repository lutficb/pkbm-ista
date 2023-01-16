<?= $this->extend('layout/admin/template'); ?>

<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="<?= base_url('sarpras'); ?>" class="btn"><i class="fas fa-arrow-left"></i></a>
        </div>
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

        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Manajemen Post</h4>
                        <div class="card-header-action">
                            <a href="<?= base_url('sarpras/restore'); ?>" class="btn btn-info"><i class="fas fa-undo-alt"></i> Restore Semua</a>
                            <form action="<?= base_url('sarpras/delpermanent'); ?>" method="post" class="d-inline form-del-post-permanent-all">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button class="btn btn-danger btn-sm" type="submit">
                                    <i class="fas fa-window-close"></i> Hapus Semua
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>Nama Sarpras</th>
                                    <th>Kategori</th>
                                    <th>Thumbnail</th>
                                    <th>Deleted At</th>
                                    <th>Aksi</th>
                                </tr>
                                <?php $i = 1; ?>
                                <?php foreach ($sarpras as $key => $value) : ?>
                                    <tr>
                                        <td class="text-center"><?= $i; ?></td>
                                        <td><?= $value->judul; ?></td>
                                        <td class="text-center"><?= $value->kategori; ?></td>
                                        <td><img src="../assets/img/img-sarpras/<?= $value->gambar; ?>" alt="" class="img-thumbnail img-10rem"></td>
                                        <td class="text-center"><?= date('d-m-Y H:i:s', strtotime($value->delete)); ?></td>
                                        <td class="text-center">
                                            <a href="<?= base_url('sarpras/restore/' . $value->id); ?>" class="btn btn-info btn-sm"><i class="fas fa-undo-alt"></i> Restore</a>
                                            <form action="<?= base_url('sarpras/delpermanent/' . $value->id); ?>" method="post" class="d-inline form-del-post-permanent">
                                                <?= csrf_field(); ?>
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button class="btn btn-danger btn-sm" type="submit">
                                                    <i class="fas fa-window-close"></i> Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php $i++ ?>
                                <?php endforeach; ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>