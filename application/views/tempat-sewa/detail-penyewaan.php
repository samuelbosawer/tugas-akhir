<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Detail Penyewaan </h1>
        </div>
        <div class="card">
            <?= $this->session->flashdata('pesan');
            $this->session->set_flashdata('pesan', '');
            ?>
            <?php foreach ($penyewaan as $d) : ?>
                <div class="container">
                    <div class="row p-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6-md">
                                        <img src="<?= base_url() ?>assets/upload/perlengkapan/<?= $d->foto; ?>" width="500px" alt="" srcset="">
                                    </div>
                                    <div class="col-6-md">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td scope="row"> Perlengkapan </td>
                                                    <td><?= $d->nama_perlengkapan ?></td>
                                                </tr>
                                                <tr>
                                                    <td scope="row">Kategori</td>
                                                    <td> <?= $d->kategori ?></td>
                                                </tr>
                                                <tr>
                                                    <td scope="row">Nama Pelanggan </td>
                                                    <td> <?= $d->nama ?></td>
                                                </tr>
                                                <tr>
                                                    <td scope="row">Alamat </td>
                                                    <td> <?= $d->alamat_jalan ?>, <?= $d->alamat_distrik ?></td>
                                                </tr>
                                                <tr>
                                                    <td scope="row">Email </td>
                                                    <td> <?= $d->email ?></td>
                                                </tr>
                                                <tr>
                                                    <td scope="row">No Hp Pelanggan </td>
                                                    <td> <?= $d->nm_hp ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <a name="" id="" class="btn btn-primary ml-3" href="<?= base_url() ?>tempat-sewa/penyewaan/datapenyewaan" role="button">Kembali</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </section>
</div>