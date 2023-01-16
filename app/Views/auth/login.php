<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Login &mdash; PKBM Imam Syafi'i</title>

    <!-- Favicons -->
    <link href="<?= base_url(); ?>/theme/assets/img/favicon-pkbm.png" rel="icon">

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="<?= base_url(); ?>/admin-theme/node_modules/bootstrap-social/bootstrap-social.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="<?= base_url(); ?>/admin-theme/assets/css/style.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/admin-theme/assets/css/components.css">
</head>

<body>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                        <div class="login-brand">
                            <img src="<?= base_url(); ?>/admin-theme/assets/img/pkbm-ista.svg" alt="logo" width="100" class="shadow-light rounded-circle">
                        </div>

                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>Login</h4>
                            </div>

                            <?php if (session('error') !== null) : ?>
                                <div class="alert alert-danger" role="alert"><?= session('error') ?></div>
                            <?php elseif (session('errors') !== null) : ?>
                                <div class="alert alert-danger" role="alert">
                                    <?php if (is_array(session('errors'))) : ?>
                                        <?php foreach (session('errors') as $error) : ?>
                                            <?= $error ?>
                                            <br>
                                        <?php endforeach ?>
                                    <?php else : ?>
                                        <?= session('errors') ?>
                                    <?php endif ?>
                                </div>
                            <?php endif ?>

                            <?php if (session('message') !== null) : ?>
                                <div class="alert alert-success" role="alert"><?= session('message') ?></div>
                            <?php endif ?>

                            <div class="card-body">
                                <form method="POST" action="<?= url_to('login') ?>" class="needs-validation" novalidate="">
                                    <?= csrf_field() ?>

                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input id="username" type="text" class="form-control" name="username" tabindex="1" required autofocus placeholder="<?= lang('Auth.username') ?>" value="<?= old('username') ?>">
                                    </div>

                                    <div class="form-group">
                                        <div class="d-block">
                                            <label for="password" class="control-label">Password</label>
                                        </div>
                                        <input id="password" type="password" class="form-control" name="password" inputmode="text" autocomplete="current-password" placeholder="<?= lang('Auth.password') ?>" tabindex="2" required>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                            Login
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="simple-footer">
                            Copyright &copy; PKBM Imam Syafi'i <?= date('Y'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- General JS Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="<?= base_url(); ?>/admin-theme/assets/js/stisla.js"></script>

    <!-- JS Libraies -->

    <!-- Template JS File -->
    <script src="<?= base_url(); ?>/admin-theme/assets/js/scripts.js"></script>
    <script src="<?= base_url(); ?>/admin-theme/assets/js/custom.js"></script>

    <!-- Page Specific JS File -->
</body>

</html>