<?php
$id = $this->session->userdata('id');
if ($id) {
    $data = $this->db->query("SELECT * FROM login WHERE id = '$id' ")->row_array();
    $validasi = $data['status_validasi'];
    $data['pelanggan'] = $this->db->get_where('pelanggan', ['email' => $this->session->userdata('email')])->row_array();
    if ($data['pelanggan']) {
        $id_pelanggan = $data['pelanggan']['id_pelanggan'];
        $query = "SELECT * FROM keranjang, perlengkapan WHERE keranjang.id_pelanggan = '$id_pelanggan' AND perlengkapan.id_perlengkapan = keranjang.id_perlengkapan GROUP BY perlengkapan.id_perlengkapan";
        $hasil = $this->db->query($query)->result_array();
        $info = $this->db->query("SELECT * FROM penyewaan WHERE id_pelanggan = '$id_pelanggan' AND status_pembayaran = 'pending' ")->result();
        if ($info) {
            $this->session->set_flashdata('bayar', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button> Silahkan lakukan pembayaran !  </div>');
        }
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title><?= $title ?></title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?= base_url() ?>assets/depan/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/depan/assets/vendor/icofont/icofont.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/depan/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/depan/assets/vendor/venobox/venobox.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/depan/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/depan/assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/depan/assets/vendor/aos/aos.css" rel="stylesheet">
    <!-- Template Main CSS File -->
    <link href="<?= base_url() ?>assets/depan/assets/css/style.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/depan/assets/css/style2.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/depan/assets/css/all.css">





    <!-- Midtrans -->
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-o4jbUm5mkzPOk_pQ"></script>
    <!-- <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"> -->
    <!-- ranting -->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/rating/css/star-rating.css">
    <link href="<?= base_url() ?>assets/rating/themes/krajee-fas/theme.css" media="all" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>assets/rating/themes/krajee-svg/theme.css" media="all" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>assets/rating/themes/krajee-uni/theme.css" media="all" rel="stylesheet" type="text/css" />

    <!-- Data Tables -->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/DataTables/datatables.min.css" />

</head>

<body>
    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top d-flex align-items-center ">
        <div class="container d-flex align-items-center">

            <div class="logo mr-auto">
                <h1 class="text-light"><a href="<?= base_url() ?>depan/beranda"><span style="font-size: 20px;">Sistem Informasi Penyewaan</span></a></h1>
                <!-- Uncomment below if you prefer to use an image logo -->
                <a href="<?= base_url() ?>assets/depan/assets/img/logo.png" alt="" class="img-fluid"></a>
            </div>

            <nav class="nav-menu d-none d-lg-block">
                <ul>
                    <li class=""><a href="<?= base_url() ?>depan/beranda">Beranda</a></li>
                    <li class="drop-down"><a href="#">Perlengkapan</a>
                        <ul>
                            <li><a href="<?= base_url() ?>depan/beranda/cari_dua/tenda">Tenda</a></li>
                            <li><a href="<?= base_url() ?>depan/beranda/cari_dua/kursi">Kursi</a></li>
                            <li><a href="<?= base_url() ?>depan/beranda/cari_dua/piring">Piring</a></li>
                        </ul>
                    </li>
                    <li class="drop-down"><a href="#">Tempat Penyewaan</a>
                        <ul>
                            <li><a href="<?= base_url() ?>depan/beranda/wilayah_tempat/jayapura Utara">Jayapura Utara</a></li>
                            <li><a href="<?= base_url() ?>depan/beranda/wilayah_tempat/Jayapura Selatan">Jayapura Selatan</a></li>
                            <li><a href="<?= base_url() ?>depan/beranda/wilayah_tempat/Abepura">Abepura</a></li>
                            <li><a href="<?= base_url() ?>depan/beranda/wilayah_tempat/Muara Tami">Muara Tami</a></li>
                            <li><a href="<?= base_url() ?>depan/beranda/wilayah_tempat/Heram">Heram</a></li>
                            <li><a href="<?= base_url() ?>depan/beranda/rating_tempat">Rating</a></li>
                        </ul>
                    </li>

                    <?php if ($this->session->userdata('hak_akses') == 3) : ?>
                        <li> <a href="<?= base_url() ?>auth/keluar"> <i class="fa fa-sign-out-alt"></i> Keluar </a></li>
                        <li> <a href="<?= base_url() ?>depan/about"><i class="fa fa-user" aria-hidden="true"></i> <?= $data["nama_akun"] ?> </a></li>
                        <li> <a href="<?= base_url(); ?>depan/transaksi/keranjang" class="nav-link"><i class="fas fa-shopping-cart"> </i> <label for="" class="text-danger"> (<?= count($hasil) ?>)</label></a> </li>
                        <li> <a href="<?= base_url(); ?>depan/beranda/info" class="nav-link"><i class="fas fa-envelope-open-text"></i><label for="" class="text-danger"> (<?= count($info) ?>) </a></li>
                    <?php elseif ($this->session->userdata('hak_akses') == 2) : ?>
                        <li> <a href="<?= base_url() ?>auth/keluar"><i class="fa fa-sign-out-alt" aria-hidden="true"></i> Keluar </a></li>
                        <li> <a href="<?= base_url() ?>tempat-sewa/dashboard"><i class="fa fa-tv" aria-hidden="true"></i> <?= $data["nama_akun"] ?></a></li>
                    <?php elseif ($this->session->userdata('hak_akses') == 1) : ?>
                        <li> <a href="<?= base_url() ?>auth/keluar"><i class="fa fa-unlock-alt" aria-hidden="true"></i> Keluar </a></li>
                        <li> <a href="<?= base_url() ?>auth"><i class="fa fa-tv" aria-hidden="true"></i> <?= $data["nama_akun"] ?> </a></li>
                    <?php else : ?>
                        <li> <a href="<?= base_url() ?>auth"><i class="fa fa-sign-in-alt" aria-hidden="true"></i> Masuk </a></li>
                        <li> <a href="<?= base_url() ?>auth/daftar"><i class="fa fa-registered" aria-hidden="true"></i> Daftar </a></li>
                    <?php endif; ?>
                    <!-- <li><a href="#contact">Daftar Akun</a></li> -->
                    <!-- <li><a href="#contact">Masuk</a></li>
                    <li><a href="#contact">Keluar</a></li> -->

                </ul>
            </nav><!-- .nav-menu -->
        </div>
    </header><!-- End Header -->