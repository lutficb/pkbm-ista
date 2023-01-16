<?= $this->extend('layout/admin/template'); ?>

<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="<?= base_url('users'); ?>" class="btn"><i class="fas fa-arrow-left"></i></a>
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
                        <h4>Daftarkan User Baru</h4>
                    </div>

                    <div class="card-body">
                        <?php $validation = \Config\Services::validation(); ?>
                        <form id="updatePages" action="<?= base_url('users'); ?>" method="post">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="_method" value="POST">

                            <!-- Email -->
                            <div class="form-group row mb-4">
                                <label for="judul_post" class="col-form-label text-md-right col-12 col-md-3 col-lg-3 ">Email</label>
                                <div class="col-sm-12 col-md-5">
                                    <input type="email" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : null; ?>" name="email" inputmode="email" autocomplete="email" placeholder="<?= lang('Auth.email') ?>" value="<?= old('email') ?>" required />
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('email'); ?>
                                    </div>
                                </div>
                            </div>

                            <!-- Username -->
                            <div class="form-group row mb-4">
                                <label for=kode_kategori" class="col-form-label text-md-right col-12 col-md-3 col-lg-3 ">Username</label>
                                <div class="col-sm-12 col-md-5">
                                    <input type="text" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : null; ?>" name="username" inputmode="text" autocomplete="username" placeholder="<?= lang('Auth.username') ?>" value="<?= old('username') ?>" required />
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('username'); ?>
                                    </div>
                                </div>
                            </div>

                            <!-- Password -->
                            <div class="form-group row mb-4">
                                <label for="thumbnail" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Password</label>
                                <div class="col-sm-12 col-md-5">
                                    <input type="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : null; ?>" name="password" inputmode="text" autocomplete="new-password" placeholder="<?= lang('Auth.password') ?>" required />
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('password'); ?>
                                    </div>
                                </div>
                            </div>

                            <!-- Password Confirm -->
                            <div class="form-group row mb-4">
                                <label for="konten_post" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Password Confirm</label>
                                <div class="col-sm-12 col-md-5">
                                    <input type="password" class="form-control <?= ($validation->hasError('password_confirm')) ? 'is-invalid' : null; ?>" name="password_confirm" inputmode="text" autocomplete="new-password" placeholder="<?= lang('Auth.passwordConfirm') ?>" required />
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('password_confirm'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                <div class="col-sm-12 col-md-7">
                                    <button class="btn btn-primary"><i class="fas fa-save"></i> Register</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<?= $this->endSection(); ?>