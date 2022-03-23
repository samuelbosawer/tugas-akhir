<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Ubah Password </h1>
        </div>
        <div class="card">
            <?= $this->session->flashdata('pesan');
            $this->session->set_flashdata('pesan', '');
            ?>
            <div class="container">
                <div class="row p-3">
                    <div class="col-10">
                        <form action="<?= base_url() ?>tempat-sewa/tempat/aksi_ubah_password" method="post">
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Password Lama</label>
                                <div class="col-sm-9">
                                    <input type="password" name="password_lama" class="form-control" id="" placeholder="" value="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Password Baru</label>
                                <div class="col-sm-9">
                                    <input type="password" name="passwordbaru1" class="form-control" id="" placeholder="" value="">
                                    <?= form_error('passwordbaru1', '<div class = "text-small text-danger">', ' </div>'); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Ulangi Password Baru</label>
                                <div class="col-sm-9">
                                    <input type="password" name="passwordbaru2" class="form-control" id="" placeholder="" value="">
                                    <?= form_error('passwordbaru2', '<div class = "text-small text-danger">', ' </div>'); ?>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Ubah</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>