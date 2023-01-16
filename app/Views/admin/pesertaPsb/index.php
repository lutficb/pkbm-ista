<?= $this->extend('layout/admin/template'); ?>

<?= $this->section('content'); ?>
<section class="section">
    <div class="section-header">
        <h1><?= $subtitle; ?></h1>
    </div>

    <div class="section-body">
        <h2 class="section-title"><?= formatHariIndonesia(date('D')) . ', ' . formatTanggalIndo(date('d-m-Y')); ?></h2>
        <p class="section-lead"><?= $deskripsi; ?></p>

        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Historis PSB</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-psb">
                                <thead>
                                    <tr class="text-center">
                                        <th>#</th>
                                        <th>Nama Siswa</th>
                                        <th>Jenis Kelamin</th>
                                        <th>NISN</th>
                                        <th>Tahun PSB</th>
                                        <th>Jenjang Masuk</th>
                                        <th>No. Handphone</th>
                                        <th class="text-center">Alamat</th>
                                        <th class="text-center" style="width: 15%;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($peserta as $key => $value) : ?>
                                        <tr class="text-center">
                                            <td><?= $no; ?></td>
                                            <td class="text-left"><?= $value->nama; ?></td>
                                            <td><?= ($value->jenis_kelamin == "P") ? "Perempuan" : "Laki-laki"; ?></td>
                                            <td><?= $value->nisn; ?></td>
                                            <td><?= $value->tahun_ajaran; ?></td>
                                            <td><?= ($value->jenjang == "msw-tahfiz" || $value->jenjang == "msw") ? "MSW" : "IDAD"; ?></td>
                                            <td class="text-left">
                                                <p><span class="text-bold">Ayah</span> : <?= $value->nohp_ayah; ?></p>
                                                <p><span>Ibu</span> : <?= $value->nohp_ibu; ?></p>
                                            </td>
                                            <td class="text-left">
                                                <?= $value->alamat . " - " . $value->kabupaten . " - " . $value->provinsi; ?>
                                            </td>
                                            <td>
                                                <a href="<?= base_url('detail-peserta/' . $value->slug); ?>" class="btn btn-success btn-sm"><i class="fas fa-user-tag"></i> Detail</i></a>
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