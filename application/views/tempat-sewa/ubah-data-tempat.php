<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Ubah Data Tempat Penyewaan </h1>
        </div>
        <div class="card">
            <?php foreach ($detail as $d) : ?>
                <div class="container">
                    <div class="row p-3">
                        <div class="col-md-10">
                            <form enctype="multipart/form-data" action="<?= base_url() ?>tempat-sewa/tempat/aksi_ubah_data  " method="post">
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">Nama Tempat</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="nama_tempat" class="form-control" id="" placeholder="" value="<?= $this->input->post('nama_tempat') ?? $d->nama_tempat; ?>">
                                        <?= form_error('nama_tempat', '<div class = "text-small text-danger">', ' </div>'); ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">Alamat Distrik</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="alamat_distrik" id="">
                                            <option selected value="<?= $d->alamat_distrik ?>"><?= $d->alamat_distrik ?></option>
                                            <option value="Jayapura Utara"> Jayapura Utara </option>
                                            <option value="Jayapura Selatan"> Jayapura Selatan </option>
                                            <option value="Abepura"> Abepura </option>
                                            <option value="Muara Tami">Muara Tami</option>
                                            <option value="Heram">Heram</option>
                                        </select>
                                        <?= form_error('alamat_distrik', '<div class = "text-small text-danger">', ' </div>'); ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">Alamat Jalan</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="alamat_jalan" class="form-control" id="" placeholder="" value="<?= $this->input->post('alamat_jalan') ?? $d->alamat_jalan; ?>">
                                        <?= form_error('alamat_jalan', '<div class = "text-small text-danger">', ' </div>'); ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">Nomor HP</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="nm_hp" class="form-control" id="" placeholder="" value="<?= $this->input->post('nm_hp') ?? $d->nm_hp; ?>">
                                        <?= form_error('nm_hp', '<div class = "text-small text-danger">', ' </div>'); ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="" readonly class="form-control" id="" placeholder="" value="<?= $this->input->post('email') ?? $d->email; ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">Peta</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="peta_google" class="form-control" id="" placeholder="" value="<?= $this->input->post('peta_google') ?? $d->peta_google; ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">KTP</label>
                                    <div class="col-sm-9">
                                        <input type="File" name="ktp" class="form-control" id="" placeholder="" value="" data-default-file="">
                                        <img width="100" src="<?= base_url(); ?>assets/upload/tempat-penyewaan/<?= $d->ktp ?>" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">SIUP</label>
                                    <div class="col-sm-9">
                                        <input type="File" name="siup" class="form-control" id="" placeholder="" value="" data-default-file="">
                                        <img width="100" src="<?= base_url(); ?>assets/upload/tempat-penyewaan/<?= $d->siup ?>" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">Logo</label>
                                    <div class="col-sm-9">
                                        <input type="File" name="logo" class="form-control" id="" placeholder="" value="" data-default-file="">
                                        <img width="100" src="<?= base_url(); ?>assets/upload/tempat-penyewaan/<?= $d->logo ?>" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="">
                                    </div>
                                </div>
                                <input type="hidden" value="<?= $d->id ?>" name="id">
                                <input type="hidden" value="<?= $d->id_tempat ?>" name="id_tempat">
                                <button type="submit" class="btn btn-primary">Ubah</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </section>
</div>