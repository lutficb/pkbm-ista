<?= $this->extend('layout/admin/template'); ?>

<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1><?= $subtitle; ?></h1>
        <div class="section-header-button">
            <a href="<?= base_url('sarpras/new'); ?>" class="btn btn-primary"><i class="fas fa-plus"></i> Sarpras Baru</a>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title"><?= formatHariIndonesia(date('D')) . ', ' . formatTanggalIndo(date('d-m-Y')); ?></h2>
        <p class="section-lead"><?= $deskripsi; ?></p>

        <div class="row">
            <div class="col-12">
                <div class="card mb-0">
                    <div class="card-header">
                        <ul class="nav nav-pills">
                            <li class="nav-item">
                                <a class="nav-link" href="#">All <span class="badge badge-primary"><?= $countAll; ?></span></a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('sarpras/trash'); ?>" class="nav-link" href="#">Trash <span class="badge badge-danger"><?= $trash; ?></span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

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
                        <h4>Manajemen Sarpras</h4>
                        <div class="card-header-form">
                            <?php $request = \Config\Services::request(); ?>
                            <form action="" method="get" autocomplete="off">
                                <div class="input-group">
                                    <input type="text" name="keyword" value="<?= $request->getVar('keyword'); ?>" class="form-control" placeholder="Pencarian">
                                    <div class="input-group-btn">
                                        <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr class="text-center">
                                        <th>#</th>
                                        <th>Judul</th>
                                        <th>Kategori</th>
                                        <th>Thumbnail</th>
                                        <th style="width: 20%;">Info Sarpras</th>
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $page = isset($_GET['page']) ? $_GET['page'] : 1;
                                    $no = 1 + (5 * ($page - 1));
                                    foreach ($sarpras as $key => $value) : ?>
                                        <tr class="text-center">
                                            <td><?= $no; ?></td>
                                            <td class="text-left"><?= $value->judul; ?>
                                                <div class="table-links">
                                                    <a href="<?= base_url('sarpras/' . $value->id . '/edit'); ?>">Edit</a>
                                                    <div class="bullet"></div>
                                                    <form action="<?= base_url('sarpras/' . $value->id); ?>" method="post" class="d-inline form-del-post">
                                                        <?= csrf_field(); ?>
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <button class="btn btn-outline-danger btn-sm" type="submit">
                                                            Sampah
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                            <td><?= $value->kategori; ?></td>
                                            <td><img src="assets/img/img-sarpras/<?= $value->gambar; ?>" alt="" class="img-thumbnail img-10rem"></td>
                                            <td class="text-left"><?= ringkasKalimat($value->info, 20); ?></td>
                                            <td><?= date('d-m-Y H:i:s', strtotime($value->created_at)); ?></td>
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
        </div>
    </div>
</section>
<?= $this->endSection(); ?>