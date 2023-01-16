<?= $this->extend('layout/admin/template'); ?>

<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1><?= $subtitle; ?></h1>
        <div class="section-header-button">
            <a href="<?= base_url('users/new'); ?>" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Users</a>
        </div>
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
                        <h4>Manajemen Users</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr class="text-center">
                                        <th>#</th>
                                        <th>Username</th>
                                        <th>Group Users</th>
                                        <th>Last Login</th>
                                        <th class="text-center" style="width: 15%;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($users as $key => $value) : ?>
                                        <tr class="text-center">
                                            <td><?= $no; ?></td>
                                            <td><?= ucwords($value->username); ?></td>
                                            <td><?= $value->group; ?></td>
                                            <td><?= $value->last_login; ?></td>
                                            <td>
                                                <form action="<?= base_url('users/' . $value->id); ?>" method="post" class="d-inline form-del-post">
                                                    <?= csrf_field(); ?>
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button class="btn btn-outline-danger btn-sm" type="submit"><i class="fas fa-trash"></i>
                                                        Hapus
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
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>