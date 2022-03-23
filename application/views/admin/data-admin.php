<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Super Admin / Root </h1>
        </div>
        <div class="card">
            <?= $this->session->flashdata('pesan');
            $this->session->set_flashdata('pesan', '');
            ?>
            <?php foreach ($detail as $d) : ?>
                <div class="container">
                    <div class="row p-3">
                        <div class="col-md-12">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td scope="row"> Email </td>
                                        <td> <?= $d->email ?></td>
                                    </tr>
                                    <tr>
                                        <td scope="row"> Nama Akun </td>
                                        <td> <?= $d->nama_akun ?></td>
                                    </tr>
                                    <tr>
                                        <td scope="row">Hak Akses </td>
                                        <td>
                                            <?php if ($d->hak_akses == '3') {
                                                echo "Pelanggan";
                                            } elseif ($d->hak_akses == '2') {
                                                echo "Tempat Penyewaan";
                                            } elseif ($d->hak_akses == 1) {
                                                echo "Super Admin (Root)";
                                            } else {
                                                echo " Tidak diketahui";
                                            } ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <a name="" id="" class="btn btn-primary" href="<?= base_url() ?>admin/ubahdata/<?= $d->id ?>" role="button">Ubah Data</a>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </section>
</div>