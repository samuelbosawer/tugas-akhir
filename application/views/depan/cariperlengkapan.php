<main id="main" class="mt-5">
    <section id="pricing" class="pricing">
        <div class="container">
            <!-- Perlengkapan -->
            <div class="section-title" data-aos="fade-up">
                <p>Perlengkapan</p>
            </div>
            <form action="" method="POST">
                <div class="text-center text-lg-left" data-aos="fade-up">
                    <div class="input-group col-6 mb-3">
                        <input type="text" class="form-control" name="search" id="search" aria-describedby="helpId" placeholder="">
                        <div class="input-group-append">
                            <button class="btn btn-warning text-dark" type="button">Cari</button>
                        </div>
                    </div>
                </div>
            </form>

            <div class="row" data-aos="fade-left">
                <?php foreach ($perlengkapan as $p) : ?>
                    <div class="col-lg-3 col-md-6 mb-3" id="tampil">
                        <div class="box" data-aos="zoom-in" data-aos-delay="100">
                            <h4 style="font-size: 20px;"><sup></sup><?= $p->nama_perlengkapan ?></h4>
                            <ul>
                                <li><img style="width: 100px; height: 100px;" src="<?= base_url() ?>assets/upload/perlengkapan/<?= $p->foto ?>" alt=""></li>
                                <li>Rp.<?= number_format($p->harga, 0, ',', '.'); ?>/Hari</li>
                                <li><span class="badge badge-lg badge-success"><?= $p->kategori ?></span></li>
                                <li>Stok : </li>
                                <li> <a href="<?= base_url() ?>depan/perlengkapan/detail/<?= $p->id_perlengkapan ?>" class="btn-buy">Detail</a></li>
                                <li>
                                    <a href="<?= base_url() ?>depan/transaksi/keranjang/<?= $p->id_perlengkapan ?>" class="btn btn-sm btn-success"><i class="fa fa-shopping-cart"></i> </a>
                                    <a href="<?= base_url() ?>depan/transaksi/bayar/<?= $p->id_perlengkapan ?>" class="btn btn-sm btn-danger"><i class="fa fa-money-check"></i></a>
                                </li>

                            </ul>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </section>
</main>