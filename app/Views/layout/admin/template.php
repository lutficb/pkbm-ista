<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Admin PKBM | <?= $title; ?></title>

    <!-- Favicons -->
    <link href="<?= base_url(); ?>/theme/assets/img/favicon-pkbm.png" rel="icon">

    <!-- General CSS Files -->
    <link rel="stylesheet" href="<?= base_url(); ?>/admin-theme/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/admin-theme/node_modules/@fortawesome/fontawesome-free/css/all.css">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="<?= base_url(); ?>/admin-theme/node_modules/summernote/dist/summernote-bs4.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/admin-theme/node_modules/codemirror/lib/codemirror.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/admin-theme/node_modules/codemirror/theme/duotone-dark.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/admin-theme/node_modules/selectric/public/selectric.css">


    <!-- Template CSS -->
    <link rel="stylesheet" href="<?= base_url(); ?>/admin-theme/assets/css/style.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/admin-theme/assets/css/components.css">
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <!-- Navbas -->
            <?= $this->include('layout/admin/navbar'); ?>

            <!-- Sidebar -->
            <?= $this->include('layout/admin/sidebar'); ?>

            <!-- Main Content -->
            <div class="main-content">
                <?= $this->renderSection('content'); ?>
            </div>

            <!-- Footer -->
            <?= $this->include('layout/admin/footer'); ?>
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="<?= base_url(); ?>/admin-theme/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="<?= base_url(); ?>/admin-theme/node_modules/popper.js/dist/umd/popper.min.js"></script>
    <script src="<?= base_url(); ?>/admin-theme/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?= base_url(); ?>/admin-theme/node_modules/nicescroll/dist/jquery.nicescroll.min.js"></script>
    <script src="<?= base_url(); ?>/admin-theme/node_modules/moment/min/moment.min.js"></script>
    <script src="<?= base_url(); ?>/admin-theme/assets/js/stisla.js"></script>

    <!-- JS Libraies -->
    <script src="<?= base_url(); ?>/admin-theme/node_modules/cleave.js/dist/cleave.min.js"></script>
    <script src="<?= base_url(); ?>/admin-theme/node_modules/cleave.js/dist/addons/cleave-phone.us.js"></script>
    <script src="<?= base_url(); ?>/admin-theme/node_modules/summernote/dist/summernote-bs4.js"></script>
    <script src="<?= base_url(); ?>/admin-theme/node_modules/codemirror/lib/codemirror.js"></script>
    <script src="<?= base_url(); ?>/admin-theme/node_modules/codemirror/mode/javascript/javascript.js"></script>
    <script src="<?= base_url(); ?>/admin-theme/node_modules/selectric/public/jquery.selectric.min.js"></script>

    <!-- Template JS File -->
    <script src="<?= base_url(); ?>/admin-theme/assets/js/scripts.js"></script>
    <script src="<?= base_url(); ?>/admin-theme/assets/js/custom.js"></script>

    <!-- Page Specific JS File -->
</body>

</html>x