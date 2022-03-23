<main id="main">
    <section id="pricing" class="pricing">
        <div class="container">
            <?php if ($terdekat) : ?>
                <div class="section-title" data-aos="fade-up">
                    <p>Perlengkapan Terdekat</p>
                </div>
                <div class="row" data-aos="fade-left">
                    <?php foreach ($terdekat as $t) : ?>
                        <?php $stok = $t->stok;
                        $sisa = 0;
                        foreach ($jumlah as $j) : ?>
                            <?php if ($t->id_perlengkapan == $j['id_perlengkapan']) : ?>
                                <?php $sisa = $sisa + $j['jumlah_stok']; ?>
                            <?php endif; ?>
                            <?php if ($t->id_perlengkapan == $j['id_perlengkapan']) : ?>
                                <?php $stok = $t->stok - $sisa ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <div class="col-lg-3 col-6  mb-3 ">
                            <div class="box" data-aos="zoom-in" data-aos-delay="100">
                                <h4 style="font-size: 20px;"><sup></sup><?= $t->nama_perlengkapan ?></h4>
                                <ul>
                                    <li><img style="width: 100px; height: 100px;" src="<?= base_url() ?>assets/upload/perlengkapan/<?= $t->foto ?>" alt=""></li>
                                    <li>Rp.<?= number_format($t->harga, 0, ',', '.'); ?>/Hari</li>
                                    <li><span class="badge badge-lg badge-success"><?= $t->kategori ?></span></li>
                                    <li>Stok : <?= $stok ?> </li>
                                    <li><?= $t->alamat_distrik ?></li>
                                    <li> <a href="<?= base_url() ?>depan/perlengkapan/detail/<?= $t->id_perlengkapan ?>" class="btn-buy">Detail</a></li>
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
                                            <a href="<?= base_url() ?>depan/keranjang/addperlengkapan/<?= $t->id_perlengkapan ?>" class="btn btn-sm btn-success"><i class="fa fa-shopping-cart"></i> </a>
                                        </li>
                                    <?php endif ?>
                                </ul>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            <?php endif ?>
            <!-- Perlengkapan -->
            <div class="section-title" data-aos="fade-up">
                <p>Perlengkapan</p>
            </div>
            <div class="row" data-aos="fade-left">
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
                    <div class="col-lg-3 col-6  mb-3 ">
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
            <!-- Paket -->
            <div class="section-title mt-5" data-aos="fade-up">
                <p>Paket Perlengkapan</p>
            </div>
            <div class="row" data-aos="fade-right">
                <?php foreach ($paket as $pkt) : ?>
                    <?php $stok = $pkt->stok;
                    $sisa = 0;
                    foreach ($jumlah as $j) : ?>
                        <?php if ($pkt->id_perlengkapan == $j['id_perlengkapan']) : ?>
                            <?php $sisa = $sisa + $j['jumlah_stok']; ?>
                        <?php endif; ?>
                        <?php if ($pkt->id_perlengkapan == $j['id_perlengkapan']) : ?>
                            <?php $stok = $pkt->stok - $sisa ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <div class="col-lg-3 col-6  mb-3 ">
                        <div class="box" data-aos="zoom-in" data-aos-delay="100">
                            <h4 style="font-size: 20px;"><sup></sup><?= $pkt->nama_perlengkapan ?></h4>
                            <ul>
                                <li><img style="width: 100px; height: 100px;" src="<?= base_url() ?>assets/upload/perlengkapan/<?= $pkt->foto ?>" alt=""></li>
                                <li>Rp.<?= number_format($pkt->harga, 0, ',', '.'); ?>/Hari</li>
                                <li><span class="badge badge-lg badge-success"><?= $pkt->kategori ?></span></li>
                                <li>Stok : <?= $stok ?> </li>
                                <li class="m-0"><?= $pkt->alamat_distrik ?></li>

                                <li> <a href="<?= base_url() ?>depan/perlengkapan/detail/<?= $pkt->id_perlengkapan ?>" class="btn-buy">Detail</a></li>
                                <?php if ($stok == 0) : ?>
                                    <li>
                                        <a href="#" data-toggle="modal" data-target="#modelId" class="btn btn-sm btn-success"><i class="fa fa-shopping-cart"></i> </a>
                                    </li>
                                <?php elseif ($this->session->userdata('validasi') == 0) : ?>
                                    <li>
                                        <a href="#" data-toggle="modal" data-target="#modelId-dua" class="btn btn-sm btn-success"><i class="fa fa-shopping-cart"></i> </a>
                                    </li>
                                <?php else : ?>
                                    <li>
                                        <a href="<?= base_url() ?>depan/keranjang/addperlengkapan/<?= $pkt->id_perlengkapan ?>" class="btn btn-sm btn-success"><i class="fa fa-shopping-cart"></i> </a>
                                    </li>
                                <?php endif ?>
                            </ul>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>




            <!-- Tempat -->
            <div class="section-title mt-5" data-aos="fade-up">
                <p>Tempat Penyewaan</p>
            </div>
            <div class="row" data-aos="fade-right">
                <?php foreach ($tempat as $t) : ?>
                    <div class="col-lg-3 col-md-6  mb-3 ">
                        <div class="box" data-aos="zoom-in" data-aos-delay="100">
                            <h4 style="font-size: 20px;"><sup></sup><?= $t->nama_tempat ?></h4>
                            <ul>
                                <li><img style="width: 100px; height: 100px;" src="<?= base_url() ?>assets/upload/tempat-penyewaan/<?= $t->logo ?>" alt=""></li>
                                <li><?= $t->alamat_distrik ?></li>
                                <li> <a href="<?= base_url() ?>depan/about/tentang_tempat/<?= $t->id_tempat ?>" class="btn-buy">Detail</a></li>

                                <?php
                                $rating = $this->db->query("SELECT * FROM rating WHERE id_tempat = '$t->id_tempat' ")->result();
                                $count = count($rating);
                                $nilai = 0;
                                $hasil = 0;
                                foreach ($rating as $r) {
                                    $nilai = $r->jumlah_rating + $nilai;
                                    $ulasan = $this->db->query("SELECT * FROM rating, pelanggan WHERE rating.id_tempat = '$t->id_tempat' AND rating.id_pelanggan = pelanggan.id_pelanggan ")->result();
                                    $hasil = $nilai / $count;
                                }

                                ?>
                            </ul>
                            <input type="text" id="bintang" class="rating" data-readonly="true" data-size="sm" value="<?= $hasil ?>" title="">
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </section><!-- End Pricing Section -->


</main><!-- End #main -->