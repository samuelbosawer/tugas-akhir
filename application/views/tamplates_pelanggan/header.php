<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>

<head>
    <title><?= $title ?></title>
    <!--/tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Elite Shoppy Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script type="application/x-javascript">
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <!--//tags -->
    <!-- <link href="<?= base_url() ?>assets/pelanggan/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" /> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <link href="<?= base_url() ?>assets/pelanggan/css/style.css" rel="stylesheet" type="text/css" media="all" />
    <link href="<?= base_url() ?>assets/pelanggan/css/font-awesome.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/pelanggan/css/easy-responsive-tabs.css" rel='stylesheet' type='text/css' />
    <!-- //for bootstrap working -->
    <link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800" rel="stylesheet">
    <link href='//fonts.googleapis.com/css?family=Lato:400,100,100italic,300,300italic,400italic,700,900,900italic,700italic' rel='stylesheet' type='text/css'>
</head>

<body>
    <!-- header -->
    <div class="header" id="home">
        <div class="container">
            <ul>

                <?php if ($this->session->userdata('hak_akses') == 3) : ?>
                    <li> <a href="<?= base_url() ?>auth/keluar"> <i class="fa fa-sign-out"></i> Logout </a></li>
                    <li> <a href='#'><i class="fa fa-check" aria-hidden="true"></i> </a> <?= $this->session->userdata('nama') ?> </li>
                    <li> <a href="<?= base_url() ?>auth"><i class="fa fa-user" aria-hidden="true"></i> Profile </a></li>
                <?php elseif ($this->session->userdata('hak_akses') == 2) : ?>
                    <li> <a href="<?= base_url() ?>auth/keluar"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout </a></li>
                    <li> <a href="<?= base_url() ?>auth"><i class="fa fa-check" aria-hidden="true"></i> </a> <?= $this->session->userdata('nama') ?> </li>
                    <li> <a href="<?= base_url() ?>tempat-sewa/dashboard"><i class="fa fa-tv" aria-hidden="true"></i> Panel </a></li>
                <?php elseif ($this->session->userdata('hak_akses') == 1) : ?>
                    <li> <a href="<?= base_url() ?>auth"><i class="fa fa-unlock-alt" aria-hidden="true"></i> Logout </a></li>
                    <li> <a href="<?= base_url() ?>auth"><i class="fa fa-unlock-alt" aria-hidden="true"></i> </a> <?= $this->session->userdata('nama') ?> </li>
                    <li> <a href="<?= base_url() ?>auth"><i class="fa fa-unlock-alt" aria-hidden="true"></i> Admin Panel </a></li>
                <?php else : ?>
                    <li> <a href="<?= base_url() ?>auth"><i class="fa fa-unlock-alt" aria-hidden="true"></i> Masuk </a></li>
                    <li> <a href="<?= base_url() ?>auth/daftar"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Daftar </a></li>
                <?php endif ?>

            </ul>
        </div>
    </div>
    <!-- //header -->
    <!-- header-bot -->
    <div class="header-bot">
        <div class="header-bot_inner_wthreeinfo_header_mid">
            <div class="col-md-4 header-middle">
                <form action="#" method="post">
                    <input type="search" name="search" placeholder="Pecarian...." required="">
                    <input type="submit" value=" ">
                    <div class="clearfix"></div>
                </form>
            </div>
            <!-- header-bot -->
            <div class="col-md-4 logo_agile">
                <h1><a href="index.html"><span>SIP</span> </a></h1>
                <p style="margin-top: 10px;">Sistem Informasi Penyewaan Tenda dan Kursi</p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <!-- //header-bot -->
    <!-- banner -->
    <div class="ban-top">
        <div class="container">
            <div class="top_nav_left">
                <nav class="navbar navbar-default">
                    <div class="container-fluid">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse menu--shylock" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav menu__list">


                                <li class=" menu__item"><a class="menu__link" href="<?= base_url() ?>pelanggan/beranda">Beranda</a></li>
                                <li class=" menu__item"><a class="menu__link" href="<?= base_url() ?>pelanggan/beranda">Kontak</a></li>
                                <li class=" menu__item"><a class="menu__link" href="<?= base_url() ?>pelanggan/beranda">Kontak</a></li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="top_nav_right">
                <div class="wthreecartaits wthreecartaits2 cart cart box_1">
                    <form action="<?= base_url() ?>pelanggan/keranjang" method="post" class="last">
                        <input type="hidden" name="display" value="1">
                        <button class="w3view-cart" type="submit" name="submit" value=""><i class="fa fa-cart-arrow-down" aria-hidden="true"></i></button>
                    </form>

                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <!-- //banner-top -->