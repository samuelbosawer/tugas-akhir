<form action="" method="post">
    <?php foreach ($detail as $d) : ?>
        <?php $stok = $d->stok;
        $sisa = 0;
        foreach ($jumlah as $j) : ?>
            <?php if ($d->id_perlengkapan == $j['id_perlengkapan']) : ?>
                <?php $sisa = $sisa + $j['jumlah_stok']; ?>
            <?php endif; ?>
            <?php if ($d->id_perlengkapan == $j['id_perlengkapan']) : ?>
                <?php $stok = $d->stok - $sisa ?>
            <?php endif; ?>
        <?php endforeach; ?>
        <section id="details" class="details">
            <div class="container mt-5">
                <div class="row content">
                    <div class="col-md-4" data-aos="fade-right">
                        <img src="<?= base_url() ?>assets/upload/perlengkapan/<?= $d->foto ?>" class="img-fluid" alt="">
                    </div>
                    <div class="col-md-8 pt-5" data-aos="fade-up">
                        <h3><?= $d->nama_perlengkapan ?></h3>
                        <table class="table table-borderless">
                            <tr>
                                <th>Stok yang tersedia</th>
                                <td><?= $stok ?></td>
                            </tr>
                            <tr>
                                <th>Harga Sewa / Hari</th>
                                <td>Rp.<?= number_format($d->harga, 0, ',', '.'); ?></td>
                            </tr>
                            <tr>
                                <th>Nama Tempat Penyewaan</th>
                                <td> <a href="<?= base_url() ?>depan/about/tentang_tempat/<?= $d->id_tempat ?>"> <?= $d->nama_tempat ?></a> </td>
                            </tr>
                            <tr>
                                <th>Alamat Tempat Penyewaan</th>
                                <td> <?= $d->alamat_jalan ?>, <?= $d->alamat_distrik ?> </td>
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
                    </div>
                </div>
                <div class="row content">
                    <div class="col-md-6" data-aos="fade-right">
                        <div class=" form-group">
                            <label for="" class="font-weight-bold">Deskripsi</label>
                            <textarea class="form-control" readonly name="" id="" rows="3"><?= $d->deskripsi ?></textarea>
                        </div>
                    </div>
                    <div class="col-md-6" data-aos="fade-right">
                        <div class=" form-group">
                            <?php if ($stok == 0) : ?>
                                <a href="#" data-toggle="modal" data-target="#modelId" class="btn btn-lg mt-5 btn-success"><i class="fa fa-shopping-cart"></i> </a>
                            <?php else : ?>
                                <a href="<?= base_url() ?>depan/keranjang/addperlengkapan/<?= $d->id_perlengkapan ?>" class="btn btn-lg mt-5 btn-success"><i class="fa fa-shopping-cart"></i> </a>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
                <div class="row content">
                    <span id="business_list" data-aos="fade-right"></span>
                </div>
            </div>
        </section><!-- End Details Section -->
    <?php endforeach ?>
</form>