<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Super Admin / Root </h1>
        </div>
        <div class="card">
            <?php foreach ($detail as $d) : ?>
                <div class="container">
                    <div class="row p-3">
                        <div class="col-10">
                            <form action="<?= base_url() ?>admin/aksi_ubah_admin" method="post">
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-9">
                                        <input type="" name="email" readonly class="form-control" id="" placeholder="" value="<?= $this->input->post('email') ?? $d->email; ?>">
                                        <?= form_error('email', '<div class = "text-small text-danger">', ' </div>'); ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">Nama Akun</label>
                                    <div class="col-sm-9">
                                        <input type="" name="nama_akun" class="form-control" id="" placeholder="" value="<?= $this->input->post('nama_akun') ?? $d->nama_akun; ?>">
                                        <?= form_error('nama_akun', '<div class = "text-small text-danger">', ' </div>'); ?>
                                    </div>
                                </div>
                                <input type="hidden" value="<?= $d->id ?>" name="id">
                                <button type="submit" class="btn btn-primary">Ubah</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </section>
</div>