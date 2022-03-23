<main id="main" class="mt-5">
    <section id="pricing" class="pricing">
        <div class="container">
            <!-- Perlengkapan -->
            <div class="section-title" data-aos="fade-up">
                <p>Pencarian</p>
            </div>

            <form action="" method="POST">
                <div class="input-group col-sm-4 col-10 mb-3 input_div" data-aos="fade-up">
                    <input type="text" value="<?= $this->input->post('search') ?? $kata ?>" autocomplete="off" class="form-control" id="input_pencarian" onkeyup="myFunction()" name="search" placeholder="Kata kunci">
                    <div class="input-group-append">
                        <button class="btn btn-warning text-dark" type="submit">Cari</button>
                    </div>
                </div>
                <div id="box_pencarian"></div>
            </form>

            <div class="row" data-aos="fade-left" style="margin-top: 20px;">
                <?php foreach ($perlengkapan as $p) : ?>
                    <?php $stok = $p->stok;
                    $sisa = 0;
                    foreach ($jumlah as $j) : ?>
                        <?php if ($p->id_perlengkapan == $j['id_perlengkapan']) : ?>
                            <?php $sisa = $sisa + $j['jumlah_stok']; ?>
                        <?php endif; ?>
                        <?php if ($p->id_perlengkapan == $j['id_perlengkapan']) : ?>
                            <?php $stok = $p->stok - $sisa ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <div class="col-lg-3 col-6 mb-3 ">
                        <div class="box" data-aos="zoom-in" data-aos-delay="100">
                            <h4 style="font-size: 20px;"><sup></sup><?= $p->nama_perlengkapan ?></h4>
                            <ul>
                                <li><img style="width: 100px; height: 100px;" src="<?= base_url() ?>assets/upload/perlengkapan/<?= $p->foto ?>" alt=""></li>
                                <li>Rp.<?= number_format($p->harga, 0, ',', '.'); ?>/Hari</li>
                                <li><span class="badge badge-lg badge-success"><?= $p->kategori ?></span></li>
                                <li>Stok : <?= $stok ?> </li>
                                <li class="m-0"><?= $p->alamat_distrik ?></li>
                                <li> <a href="<?= base_url() ?>depan/perlengkapan/detail/<?= $p->id_perlengkapan ?>" class="btn-buy">Detail</a></li>
                                <?php if ($stok == 0) : ?>
                                    <li>
                                        <a href="#" data-toggle="modal" data-target="#modelId" class="btn btn-sm btn-success"><i class="fa fa-shopping-cart"></i> </a>
                                    </li>
                                <?php elseif ($this->session->userdata('validasi') == '0') : ?>
                                    <li>
                                        <a href="#" data-toggle="modal" data-target="#modelId-dua" class="btn btn-sm btn-success"><i class="fa fa-shopping-cart"></i> </a>
                                    </li>
                                <?php else : ?>
                                    <li>
                                        <a href="<?= base_url() ?>depan/keranjang/addperlengkapan/<?= $p->id_perlengkapan ?>" class="btn btn-sm btn-success"><i class="fa fa-shopping-cart"></i> </a>
                                    </li>
                                <?php endif ?>
                            </ul>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </section>
</main>