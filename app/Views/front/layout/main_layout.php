<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Manajemen Sekolah Terintegrasi - SiMaKora</title>
	<link rel="shortcut icon" type="image/jpg" href="<?= base_url(); ?>/assets-admin/img/logo/logo.ico"/>


    <!-- assets -->
    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,700,900" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url(); ?>/assets-front/fonts/icomoon/style.css">

    <link rel="stylesheet" href="<?= base_url(); ?>/assets-front/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/assets-front/css/jquery-ui.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/assets-front/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/assets-front/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/assets-front/css/owl.theme.default.min.css">

    <link rel="stylesheet" href="<?= base_url(); ?>/assets-front/css/jquery.fancybox.min.css">

    <link rel="stylesheet" href="<?= base_url(); ?>/assets-front/css/bootstrap-datepicker.css">

    <link rel="stylesheet" href="<?= base_url(); ?>/assets-front/fonts/flaticon/font/flaticon.css">

    <link rel="stylesheet" href="<?= base_url(); ?>/assets-front/css/aos.css">
    <link href="<?= base_url(); ?>/assets-front/css/jquery.mb.YTPlayer.min.css" media="all" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="<?= base_url(); ?>/assets-front/css/style.css">
    <!-- assets -->
</head>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">


    <!-- loader -->
    <div id="loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#51be78" />
        </svg></div>
    <!-- loader -->
     <div class="site-wrap">
        <!-- header -->
        <?= $this->include('front/layout/header')?>
        <!-- menu -->
        <?= $this->include('front/layout/menu')?>
        <!-- content -->
        <?= $this->renderSection('content') ?>
        <!-- footer -->
        <?= $this->include('front/layout/footer')?>
        <!-- library -->
        <?= $this->include('front/layout/script')?>
     </div>
</body>

</html>