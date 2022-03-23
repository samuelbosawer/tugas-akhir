<main id="main" class="mt-5">
    <section id="pricing" class="pricing">
        <div class="container">
            <!-- Tempat -->
            <div class="section-title mt-5" data-aos="fade-up">
                <p>Tempat Penyewaan <br> Wilayah Distrik <?= $kata ?></p>
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
    </section>
</main>