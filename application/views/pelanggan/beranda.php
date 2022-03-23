<!-- /new_arrivals -->
<div class="new_arrivals_agile_w3ls_info">
    <div class="container">
        <h3 class="wthree_text_info"> <span>Perlengkapan</span> </h3>
        <div id="horizontalTab">
            <!--/tab_one-->
            <div class="tab1 row">
                <?php foreach ($perlengkapan as $p) : ?>
                    <div class="col-md-3 product-men">
                        <div class="men-pro-item simpleCart_shelfItem">
                            <div class="men-thumb-item">
                                <img style="width: 250px; height: 200px;" src="<?= base_url() ?>assets/upload/perlengkapan/<?= $p->foto ?>" alt="" class="pro-image-front">
                                <img style="width: 250px; height: 200px;" src="<?= base_url() ?>assets/upload/perlengkapan/<?= $p->foto ?>" alt="" class="pro-image-back">
                                <div class="men-cart-pro">
                                    <div class="inner-men-cart-pro">
                                        <a href="<?= base_url() ?>pelanggan/perlengkapan/detail/<?= $p->id_perlengkapan ?>" class="link-product-add-cart">Detail</a>
                                    </div>
                                </div>
                                <span class="product-new-top">Perlengkapan</span>
                            </div>
                            <div class="item-info-product ">
                                <h4><a href="single.html"><?= $p->nama_perlengkapan ?></a></h4>
                                <div class="info-product-price">
                                    <span class="item_price"> Rp. <?= number_format($p->harga, 0, ',', '.'); ?></span>
                                    <!-- <del>$69.71</del> -->
                                </div>
                                <a name="" id="" class="btn btn-success" href="<?= base_url() ?>pelanggan/keranjang/tambahperlengkapan/<?= $p->id_perlengkapan ?>" role="button"> <i class="fa fa-cart-arrow-down"></i> </a>
                                <a name="" id="" class="btn btn-primary" href="<?= base_url() ?>pelanggan/keranjang/tambah/<?= $p->id_perlengkapan ?>" role="button"> Bayar</a>

                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>

    <!-- Paket -->
    <div class="container" style="margin-top: 50px;">
        <h3 class="wthree_text_info"> Paket <span>Perlengkapan</span> </h3>
        <div id="horizontalTab">
            <!--/tab_one-->
            <div class="tab1 row">
                <?php foreach ($paket as $pkt) : ?>
                    <div class="col-md-3 product-men">
                        <div class="men-pro-item simpleCart_shelfItem">
                            <div class="men-thumb-item">
                                <img style="width: 250px; height: 200px;" src="<?= base_url() ?>assets/upload/paket/<?= $pkt->foto ?>" alt="" class="pro-image-front">
                                <img style="width: 250px; height: 200px;" src="<?= base_url() ?>assets/upload/paket/<?= $pkt->foto ?>" alt="" class="pro-image-back">
                                <div class="men-cart-pro">
                                    <div class="inner-men-cart-pro">
                                        <a href="<?= base_url() ?>pelanggan/paket/detail/<?= $pkt->id_paket ?>" class="link-product-add-cart">Detail</a>
                                    </div>
                                </div>
                                <span class="product-new-top">Paket</span>
                            </div>
                            <div class="item-info-product ">
                                <h4><a href="single.html"><?= $pkt->paket_perlengkapan ?></a></h4>
                                <div class="info-product-price">
                                    <span class="item_price"> Rp. <?= number_format($pkt->harga, 0, ',', '.'); ?></span>
                                    <!-- <del>$69.71</del> -->
                                </div>
                                <a name="" id="" class="btn btn-success" href="<?= base_url() ?>pelanggan/paket/keranjang/<?= $pkt->id_paket ?>" role="button"> <i class="fa fa-cart-arrow-down"></i> </a>
                                <a name="" id="" class="btn btn-primary" href="<?= base_url() ?>pelanggan/paket/keranjang/<?= $pkt->id_paket ?>" role="button"> Bayar</a>

                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>

    <!-- Tempat sewa -->
    <div class="container" style="margin-top: 50px;">
        <h3 class="wthree_text_info"> Tempat <span>Sewa</span> </h3>
        <div id="horizontalTab">
            <!--/tab_one-->
            <div class="tab1 row">
                <?php foreach ($tempat as $t) : ?>
                    <div class="col-md-3 product-men">
                        <div class="men-pro-item simpleCart_shelfItem">
                            <div class="men-thumb-item">
                                <img src="<?= base_url() ?>assets/upload/tempat-penyewaan/<?= $t->logo ?>" alt="" class="pro-image-front">
                                <img src="<?= base_url() ?>assets/upload/tempat-penyewaan/<?= $t->logo ?>" alt="" class="pro-image-back">
                                <div class="men-cart-pro">
                                    <div class="inner-men-cart-pro">
                                        <a href="<?= base_url() ?>pelanggan/tempat-penyewaan/detail/<?= $t->id_tempat ?>" class="link-product-add-cart">Detail</a>
                                    </div>
                                </div>
                                <span class="product-new-top">Tempat Sewa</span>
                            </div>
                            <div class="item-info-product ">
                                <h4><a href="single.html"><?= $t->nama_tempat ?></a></h4>
                                <div class="info-product-price">
                                    <p> <?= $t->alamat_distrik ?>, <?= $t->alamat_jalan ?> </p>
                                </div>
                                <a name="" id="" class="btn btn-success" href="#" role="button"> <i class="fa fa-cart-arrow-down"></i> </a>


                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>

</div>
<!-- //new_arrivals -->