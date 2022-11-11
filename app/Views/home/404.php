<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>404 &mdash; Page Not Found | PKBM Imam Syafi'i</title>

    <!-- Favicons -->
    <link href="<?= base_url(); ?>/theme/assets/img/favicon-pkbm.png" rel="icon">

    <!-- General CSS Files -->
    <link rel="stylesheet" href="<?= base_url(); ?>/admin-theme/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/admin-theme/node_modules/@fortawesome/fontawesome-free/css/all.css">

    <!-- CSS Libraries -->

    <!-- Template CSS -->
    <link rel="stylesheet" href="<?= base_url(); ?>/admin-theme/assets/css/style.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/admin-theme/assets/css/components.css">
</head>

<body>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="page-error">
                    <div class="page-inner">
                        <h1>404</h1>
                        <div class="page-description">
                            Halaman yang sedang anda cari tidak dapat ditemukan.
                        </div>
                        <div class="page-search">
                            <form>
                                <div class="form-group floating-addon floating-addon-not-append">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-search"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Search">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary btn-lg">
                                                Cari
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="mt-3">
                                <a href="<?= base_url('home'); ?>">Kembali ke halaman utama</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="simple-footer mt-5">
                    Copyright &copy; PKBM Ista <?= date('Y'); ?>
                </div>
            </div>
        </section>
    </div>

    <!-- General JS Scripts -->
    <script src="<?= base_url(); ?>/admin-theme/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="<?= base_url(); ?>/admin-theme/node_modules/popper.js/dist/umd/popper.min.js"></script>
    <script src="<?= base_url(); ?>/admin-theme/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?= base_url(); ?>/admin-theme/node_modules/nicescroll/dist/jquery.nicescroll.min.js"></script>
    <script src="<?= base_url(); ?>/admin-theme/node_modules/moment/min/moment.min.js"></script>
    <script src="<?= base_url(); ?>/admin-theme/assets/js/stisla.js"></script>

    <!-- JS Libraies -->

    <!-- Template JS File -->
    <script src="<?= base_url(); ?>/admin-theme/assets/js/scripts.js"></script>
    <script src="<?= base_url(); ?>/admin-theme/assets/js/custom.js"></script>

    <!-- Page Specific JS File -->
</body>

</html>