<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/bootstrap.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/all.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700|Montserrat:200,400,600&display=swap" rel="stylesheet">

    <!-- My CSS -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/style3.css">

    <!-- Midtrans -->
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-o4jbUm5mkzPOk_pQ"></script>

    <title>Galeri UKM</title>
</head>

<body>

    <div class="container cart-header" style="margin-top: 50px;">
        <div class="row my-3 text-center">
            <div class="col">
                <h3>Keranjang Belanja Anda</h3>
                <p>Pastikan barang anda terbayar lunas</p>
            </div>
        </div>
    </div>


    <!-- Checkout -->
    <section class="checkout" style="margin-top: 50px;">
        <div class="container">
            <div class="row justify-content-between" style="margin-bottom: 100px;">
                <div class="col-lg-6">
                    <h4 class="mb-4">Produk belanjaan anda</h4>
                    <?php if ($this->session->flashdata('total_error')) { ?>
                        <?php for ($i = 0; $i < $this->session->flashdata('total_error'); $i++) { ?>
                            <?= $this->session->flashdata('pesan_error' . $i); ?> <br>
                        <?php } ?>
                    <?php } ?>
                    <form action="<?= base_url(); ?>penjualan/updatekeranjang" method="post">

                        <!-- tampil semua yang akan dibeli -->
                        <div id="showKeranjang">

                        </div>

                        <button type="submit" class="btn btn-info mb-4">Update Keranjang</button>
                    </form>

                </div>
                <div class="col-lg-5">
                    <?= $this->session->flashdata('pesan'); ?>
                    <div class="card rounded-0 checkout-detail">
                        <div class="card-body">
                            <h5 class="card-title">Informasi Biaya</h5>

                            <!-- tampil item dan harga -->
                            <div id="showItemKeranjang">

                            </div>


                            <hr>

                            <?php if ($this->session->userdata('id_kota') == 157) { ?>
                                <div class="row mb-3">
                                    <div class="col-1">
                                        <br>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" checked pilih="cod" id="radio-cod" name="pengiriman" class="custom-control-input">
                                            <label class="custom-control-label" for="radio-cod"></label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <small style="color: #B7B7B7;">COD</small>
                                        <select class="custom-select" id="cod" name="cod">
                                            <option selected disabled value="0">Pilih Distrik</option>
                                            <?php foreach ($tarif as $tr) { ?>
                                                <option value="<?= $tr['biaya_kirim'] ?>" harga_cod="<?= $tr['biaya_kirim'] ?>"><?= $tr['tujuan']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="item">

                                    </div>
                                    <div class="col d-flex justify-content-end label-cod">


                                    </div>
                                </div>
                            <?php } ?>

                            <?php if ($this->session->userdata('id_kota') == 158) { ?>
                                <div class="row mb-3">
                                    <div class="col-1">
                                        <br>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" checked pilih="cod" id="radio-cod" name="pengiriman" class="custom-control-input">
                                            <label class="custom-control-label" for="radio-cod"></label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <small style="color: #B7B7B7;">COD</small>
                                        <select class="custom-select" id="cod" name="cod">
                                            <option selected disabled value="0">Pilih Distrik</option>
                                            <?php foreach ($tarif as $tr) { ?>
                                                <option value="<?= $tr['biaya_kirim'] ?>" harga_cod="<?= $tr['biaya_kirim'] ?>"><?= $tr['tujuan']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="item">

                                    </div>
                                    <div class="col d-flex justify-content-end label-cod">


                                    </div>
                                </div>
                            <?php } ?>

                            <div class="row mb-3">

                            </div>

                            <div class="row mb-3">
                                <div class="col">
                                    <h6 class="m-0">Total Harga</h6>
                                </div>
                                <div class="col d-flex justify-content-end label-total">

                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col">
                            <button type="button" class="btn btn-block" data-toggle="modal" data-target="#editInfoPelanggan" style="background-color: #007BFF; color: #FFF;">Edit Informasi</button>
                        </div>

                        <div class="col <?= $dnone; ?>" id="pay-cod">
                            <form action="<?= base_url(); ?>penjualan/inputcod" method="post">
                                <button type="submit" id="button-cod" class="btn btn-warning btn-block text-white">Checkout COD</button>
                            </form>
                        </div>

                        <!-- Midtrans -->
                        <form id="payment-form" method="post" action="<?= base_url() ?>penjualan/finish">
                            <input type="hidden" name="result_type" id="result-type" value="">
                            <input type="hidden" name="result_data" id="result-data" value="">
                        </form>

                        <div class="col  <?= $dnonejne; ?>" id="pay-jne">
                            <button type="button" id="pay-button" class="btn btn-warning btn-block text-white">Checkout</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- Akhir Checkout -->

    <!-- Modal -->
    <form action="<?= base_url(); ?>/penjualan/editinfopelanggan" method="post">
        <div class="modal fade" id="editInfoPelanggan" tabindex="-1" role="dialog" aria-labelledby="editInfoPelangganLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editInfoPelangganLabel">Akan dikirim ke alamat berikut...</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama lengkap" value="<?= $this->session->userdata('nama_penerima'); ?>">
                        </div>
                        <div class="form-group">
                            <label for="provinsi">Provinsi</label>
                            <select class="custom-select" name="provinsi">

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="kota">Kota</label>
                            <select class="custom-select" name="kota">

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="kodepos">Kode Pos</label>
                            <input type="text" class="form-control" id="kodepos" name="kodepos" placeholder="Kode pos" value="<?= $this->session->userdata('kode_pos'); ?>">
                        </div>

                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="3"><?= $this->session->userdata('alamat'); ?></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" name="submit" class="btn btn-primary">Edit</button>
                    </div>
                </div>
            </div>
        </div>
    </form>