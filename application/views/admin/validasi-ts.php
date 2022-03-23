<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Akun Detail </h1>
        </div>
        <div class="card">
            <?php foreach ($detail as $d) : ?>
                <div class="container">
                    <div class="row p-3">
                        <div class="col-md-4">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td scope="row">
                                            <img src="<?= base_url() ?>assets/upload/tempat-penyewaan/<?= $d->logo ?>" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="">
                                        </td>
                                        <td><a name="" target="_blank" class="btn btn-primary" href="<?= base_url() ?>assets/upload/tempat-penyewaan/<?= $d->logo ?>" role="button">Lihat Logo</a></td>
                                    </tr>
                                    <tr>
                                        <td scope="row">
                                            <img src="<?= base_url() ?>assets/upload/tempat-penyewaan/<?= $d->ktp ?>" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="">
                                        </td>
                                        <td><a name="" target="_blank" class="btn btn-primary" href="<?= base_url() ?>assets/upload/tempat-penyewaan/<?= $d->ktp ?>" role="button">Lihat KTP</a></td>
                                    </tr>
                                    <tr>
                                        <td scope="row">
                                            <img src="<?= base_url() ?>assets/upload/tempat-penyewaan/<?= $d->siup ?>" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="">
                                        </td>
                                        <td><a name="" target="_blank" class="btn btn-primary" href="<?= base_url() ?>assets/upload/tempat-penyewaan/<?= $d->siup ?>" role="button">Lihat siup</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-8">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td scope="row">Nama Tempat </td>
                                        <td><?= $d->nama_tempat ?></td>
                                    </tr>
                                    <tr>
                                        <td scope="row">Alamat</td>
                                        <td> <?= $d->alamat_jalan ?>, <?= $d->alamat_distrik ?></td>
                                    </tr>
                                    <tr>
                                        <td scope="row">Nomor HP </td>
                                        <td> <?= $d->nm_hp ?></td>
                                    </tr>
                                    <tr>
                                        <td scope="row">Email </td>
                                        <td> <?= $d->email ?></td>
                                    </tr>
                                    <tr>
                                        <td scope="row">Status Aktivasi </td>
                                        <td>
                                            <?php if ($d->status_aktivasi == 1) {
                                                echo "Aktif <i class='fa fa-check'></i> ";
                                            } else {
                                                echo "Belum Aktif <i class='fas fa-times'></i>";
                                            } ?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td scope="row">Status Validasi </td>
                                        <td>
                                            <?php if ($d->status_validasi == 1) {
                                                echo "Validasi <i class='fa fa-check'></i>";
                                            } else {
                                                echo "Belum Validasi <i class='fas fa-times'></i>";
                                            } ?>

                                        </td>
                                    </tr>
                                    <a href="http://" target="_blank"></a>
                                    <tr>
                                        <td scope="row">Peta Google </td>
                                        <td>
                                            <?php if ($d->peta_google == null) {
                                                echo "Belum ada <i class='fas fa-times'></i>";
                                            } else {
                                                echo "<a href='http://$d->peta_google' rel='noopener noreferrer' target='_blank'>Ada</a>";
                                            } ?>

                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <form action="<?= base_url() ?>admin/aksivalidasi_ts" method="post">
                                <input type="hidden" readonly name="id" value="<?= $d->id ?>">
                                <?php if ($d->status_validasi == 1) : ?>
                                    <button type="submit" class="btn btn-danger"> Matikan Validasi</button>
                                    <input type="hidden" readonly name="validasi" value="0">
                                <?php else : ?>
                                    <button type="submit" class="btn btn-warning"> Validasi</button>
                                    <input type="hidden" readonly name="validasi" value="1">
                                <?php endif ?>
                                <a name="" id="" class="btn btn-info" href="<?= base_url() ?>admin/data_ts" role="button">Kembali</a>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </section>
</div>