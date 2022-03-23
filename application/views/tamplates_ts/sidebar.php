<?php

$email = $this->session->userdata('email');
$data = $this->db->query("SELECT * FROM login WHERE email = '$email' ")->row_array();
if ($data['hak_akses'] == 2) {
    $de = $this->db->query("SELECT * FROM tempat_sewa WHERE email = '$email' ")->row_array();
}

?>

<body>
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                        <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                    </ul>
                </form>
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link nav-link-lg nav-link-user">
                            <?php if ($data['hak_akses'] == 2) : ?>
                                <img alt="image" src="<?= base_url() ?>assets/upload/tempat-penyewaan/<?= $de['logo'] ?>" class="rounded-circle mr-1">
                            <?php else : ?>
                                <img alt="image" src="<?= base_url() ?>assets/admin/assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
                            <?php endif; ?>
                            <div class="d-sm-none d-lg-inline-block"> <?= $data['nama_akun'] ?></div>
                        </a>
                    </li>
                </ul>
            </nav>
            <div class="main-sidebar">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="#">SI Penyewaan</a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="#">SIP</a>
                    </div>
                    <ul class="sidebar-menu">
                        <li class=""><a class="nav-link" href="<?= base_url() ?>tempat-sewa/dashboard"><i class="fas fa-tv"></i> <span>Dashboard</span></a></li>
                        <li class="menu-header">Data</li>
                        <li class=""><a class="nav-link" href="<?= base_url() ?>tempat-sewa/perlengkapan"><i class="fas fa-couch"></i> <span>Data Perlengkapan</span></a></li>
                        <li class=""><a class="nav-link" href="<?= base_url() ?>tempat-sewa/paket"> <i class="fas fa-luggage-cart"></i> <span>Data Paket</span></a></li>
                        <li class=""><a class="nav-link" href="<?= base_url() ?>tempat-sewa/penyewaan/datapenyewaan"> <i class="fas fa-cart-plus"></i> <span>Data Penyewaan</span></a></li>

                        <li class="menu-header">Laporan</li>
                        <li class=""><a class="nav-link" href="<?= base_url() ?>tempat-sewa/penyewaan"> <i class="fas fa-envelope-open-text"></i> <span>Laporan Penyewaan</span></a></li>
                        <li class=""><a class="nav-link" href="<?= base_url() ?>tempat-sewa/rating"> <i class="fas fa-envelope-open-text"></i> <span>Laporan Rating</span></a></li>
                        <li class=""><a class="nav-link" href="<?= base_url() ?>tempat-sewa/pendapatan"> <i class="fas fa-envelope-open-text"></i> <span>Laporan Pendapatan</span></a></li>
                        <li class="menu-header">Akun</li>
                        <li class=""><a class="nav-link" href="<?= base_url() ?>tempat-sewa/tempat"> <i class="fas fa-home"></i> <span>Data Tempat Penyewaan</span></a></li>
                        <li class=""><a class="nav-link" href="<?= base_url() ?>tempat-sewa/tempat/password"> <i class="fas fa-key"></i> <span>Ubah Password</span></a></li>
                        <li class=""><a class="nav-link" href="<?= base_url() ?>auth/keluar"> <i class="fas fa-sign-out-alt"></i> <span>Keluar</span></a></li>

                    </ul>
                </aside>
            </div>