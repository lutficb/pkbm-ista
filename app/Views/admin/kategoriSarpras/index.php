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
                <h4>Manajemen Kategori Sarpras</h4>
                <a href="<?= base_url('kategori-sarpras/new'); ?>" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-md table-pages">
                        <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th style="width: 15%" class="mx-auto">Nama Kategori</th>
                                <th>Slug</th>
                                <th>Deskripsi Kategori</th>
                                <th>Thumbnail</th>
                                <th style="width: 20%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $page = isset($_GET['page']) ? $_GET['page'] : 1;
                            $no = 1 + (5 * ($page - 1));
                            foreach ($kategori as $key => $value) : ?>
                                <tr>
                                    <td><?= $no; ?></td>
                                    <td><?= $value->nama_kategori; ?></td>
                                    <td><?= $value->slug; ?></td>
                                    <td><?= $value->info_kategori; ?></td>
                                    <td><img src="<?= base_url(); ?>/assets/img/img-sarpras/<?= $value->thumbnail; ?>" alt="" class="img-thumbnail"></td>
                                    <td class="text-center">
                                        <a href="<?= base_url('kategori-sarpras/' . $value->id . '/edit'); ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                        <form action="<?= base_url('kategori-sarpras/' . $value->id); ?>" method="post" class="d-inline form-del-blog-kategori">
                                            <?= csrf_field(); ?>
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button class="btn btn-danger btn-sm" type="submit">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                <?php $no++ ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer text-right">
                <?= $pager->links('default', 'pagination'); ?>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>