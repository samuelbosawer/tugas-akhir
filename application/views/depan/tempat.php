<form action="" method="post">
    <?php foreach ($detail as $d) : ?>
        <section id="details" class="faq section-bg">
            <div class="container mt-5">
                <div class="row content">
                    <div class="col-md-4" data-aos="fade-right">
                        <img src="<?= base_url() ?>assets/upload/tempat-penyewaan/<?= $d->logo ?>" class="img-fluid" alt="">
                    </div>
                    <div class="col-md-8 pt-5" data-aos="fade-up">
                        <table class="table">
                            <tr>
                                <th>Nama Tempat Penyewaan</th>
                                <td> <a href="<?= base_url() ?>depan/about/tentang_tempat/<?= $d->id_tempat ?>"> <?= $d->nama_tempat ?></a> </td>
                            </tr>
                            <tr>
                                <th>Alamat Tempat Penyewaan</th>
                                <td> <?= $d->alamat_jalan ?>, <?= $d->alamat_distrik ?> </td>
                            </tr>
                            <tr>
                                <th>Peta Google</th>

                                <?php if ($d->peta_google == null) : ?>
                                    <td>
                                        <span class="badge badge-secondary">Belum ada </span>

                                    </td>
                                <?php else : ?>
                                    <td>
                                        <a href="<?= $d->peta_google ?>" target="_blank"> <span class="badge badge-primary">Lihat</span></a>

                                    </td>
                                <?php endif ?>
                            </tr>
                            <tr>
                                <th>No. Hp</th>
                                <td> <?= $d->nm_hp ?> </td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td> <?= $d->email ?> </td>
                            </tr>
                        </table>
                        <?php
                        $rating = $this->db->query("SELECT * FROM rating WHERE id_tempat = '$d->id_tempat' ")->result();
                        $count = count($rating);
                        $nilai = 0;
                        $hasil = 0;
                        foreach ($rating as $r) {
                            $nilai = $r->jumlah_rating + $nilai;
                            $hasil = $nilai / $count;
                        }
                        $ulasan = $this->db->query("SELECT * FROM rating, pelanggan, penyewaan WHERE penyewaan.id_sewa = rating.id_sewa AND rating.id_tempat = '$d->id_tempat' AND rating.id_pelanggan = pelanggan.id_pelanggan ")->result();
                        ?>
                        <input type="text" id="bintang" class="rating" data-readonly="true" data-size="xsm" value="<?= $hasil ?>" title="">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <section id="faq" class="faq section-bg">
                            <div class="container">
                                <div class="faq-list">
                                    <ul>
                                        <li data-aos="fade-up" data-aos-delay="200">
                                            <i class="bx bx-help-circle icon-help"></i> <a data-toggle="collapse" href="#faq-list-3" class="collapsed">Ulasan <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                                            <div id="faq-list-3" class="collapse" data-parent=".faq-list">
                                                <?php foreach ($ulasan as $u) : ?>
                                                    <div class="row mt-3 p-3">
                                                        <div class="col-sm-2">
                                                            <h4><?= $u->nama ?></h4>
                                                            <input type="text" id="bintang" class="rating" data-readonly="true" data-size="xs" value="<?= $u->jumlah_rating ?>" title="">
                                                        </div>
                                                        <div class="col-sm-10">
                                                            <p><?= $u->komentar ?></p>
                                                        </div>
                                                    </div>
                                                <?php endforeach ?>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </section>
                    </div>

                </div>
        </section>

        <main id="main" class="mt-5">
            <section id="pricing" class="pricing">
                <div class="container">
                    <!-- Perlengkapan -->
                    <div class="section-title" data-aos="fade-up">
                        <p>PERLENGKAPAN YANG TERSEDIA</p>
                    </div>


                    <?php

                    $perlengkapan = $this->db->query("SELECT * FROM login, perlengkapan, tempat_sewa WHERE login.email = tempat_sewa.email AND login.status_validasi = '1' AND perlengkapan.id_tempat = tempat_sewa.id_tempat AND tempat_sewa.id_tempat = '$d->id_tempat'  ")->result();
                    $jumlah = $this->db->query("SELECT * FROM perlengkapan, penyewaan WHERE perlengkapan.id_perlengkapan = penyewaan.id_perlengkapan AND  penyewaan.status_pembayaran = 'settlement' AND penyewaan.status_sewa = 1 OR  penyewaan.status_sewa = 2  ")->result_array();

                    ?>
                    <div class="row" data-aos="fade-left" style="margin-top: 20px;">
                        <?php foreach ($perlengkapan as $p) : ?>
                            <?php $stok = $p->stok;
                            foreach ($jumlah as $j) : ?>
                                <?php if ($p->id_perlengkapan == $j['id_perlengkapan']) : ?>
                                    <?php $stok = $p->stok - $j['jumlah_stok']; ?>
                                <?php endif ?>
                            <?php endforeach ?>
                            <div class="col-lg-3 col-6 mb-3 ">
                                <div class="box" data-aos="zoom-in" data-aos-delay="100">
                                    <h4 style="font-size: 20px;"><sup></sup><?= $p->nama_perlengkapan ?></h4>
                                    <ul>
                                        <li><img style="width: 100px; height: 100px;" src="<?= base_url() ?>assets/upload/perlengkapan/<?= $p->foto ?>" alt=""></li>
                                        <li>Rp.<?= number_format($p->harga, 0, ',', '.'); ?>/Hari</li>
                                        <li><span class="badge badge-lg badge-success"><?= $p->kategori ?></span></li>
                                        <li>Stok : <?= $stok ?> </li>
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
    <?php endforeach ?>
</form>