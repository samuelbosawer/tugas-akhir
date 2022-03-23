<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Tempat Penyewaan </h1>
        </div>
        <div class="card">
            <?= $this->session->flashdata('pesan');
            $this->session->set_flashdata('pesan', '');
            ?>
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
                                        <td><a name="" target="_blank" class="btn btn-warning" href="<?= base_url() ?>assets/upload/tempat-penyewaan/<?= $d->logo ?>" role="button">Lihat Logo</a></td>
                                    </tr>
                                    <tr>
                                        <td scope="row">
                                            <img src="<?= base_url() ?>assets/upload/tempat-penyewaan/<?= $d->ktp ?>" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="">
                                        </td>
                                        <td><a name="" target="_blank" class="btn btn-warning" href="<?= base_url() ?>assets/upload/tempat-penyewaan/<?= $d->ktp ?>" role="button">Lihat KTP</a></td>
                                    </tr>
                                    <tr>
                                        <td scope="row">
                                            <img src="<?= base_url() ?>assets/upload/tempat-penyewaan/<?= $d->siup ?>" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="">
                                        </td>
                                        <td><a name="" target="_blank" class="btn btn-warning" href="<?= base_url() ?>assets/upload/tempat-penyewaan/<?= $d->siup ?>" role="button">Lihat siup</a></td>
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
                                                echo "<i class='fa fa-check'></i>";
                                            } else {
                                                echo "<i class='fas fa-times'></i>";
                                            } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td scope="row">Status Validasi </td>
                                        <td>
                                            <?php if ($d->status_validasi == 1) {
                                                echo "<i class='fa fa-check'></i>";
                                            } else {
                                                echo "<i class='fas fa-times'></i>";
                                            } ?>
                                        </td>
                                    </tr>
                                    <a href="http://" target="_blank"></a>
                                    <tr>
                                        <td scope="row">Peta Google </td>
                                        <td>
                                            <?php if ($d->peta_google == null) {
                                                echo "Belum ada";
                                            } else {
                                                echo "<a href='http://$d->peta_google' rel='noopener noreferrer' target='_blank'>Ada</a>";
                                            } ?>

                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <a name="" id="" class="btn btn-primary" href="<?= base_url() ?>tempat-sewa/tempat/ubah_data" role="button">Ubah Data</a>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </section>
</div>