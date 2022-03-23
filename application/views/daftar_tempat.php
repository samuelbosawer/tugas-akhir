<div id="app">
    <section class="section">
        <div class="container mt-5">
            <div class="row">
                <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
                    <?= $this->session->flashdata('pesan');
                    $this->session->set_flashdata('pesan', '');
                    ?>
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4 class="text-center" style="margin: auto;">Buat Akun <br> Sebagai Tempat Penyewaan</h4>
                        </div>
                        <div class=" card-body">
                            <form method="POST" action="<?= base_url() ?>auth/aksi_daftar_tempat" enctype="multipart/form-data">
                                <?php
                                error_reporting(0);
                                if ($kode->id_tempat != null) {
                                    $id_tempat = $kode->id_tempat;
                                } else {
                                    $id_tempat = "ts-00";
                                }
                                $no_urut = (int)substr($id_tempat, 3, 2);
                                $no_urut++;
                                $id = "ts-";
                                $id_baru = $id . sprintf("%02s", $no_urut);
                                ?>
                                <input type="hidden" name="id_tempat" value="<?= $id_baru ?>">
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="">Nama Tempat</label>
                                        <input id="" type="text" class="form-control" name="nama">
                                        <?= form_error('nama', '<div class = "text-small text-danger">', ' </div>'); ?>

                                    </div>
                                    <div class="form-group col-6">
                                        <label for="">Alamat Distrik</label>
                                        <select class="form-control" name="alamat_distrik" id="">
                                            <option value=""> Pilih Distrik</option>
                                            <option value="Jayapura Utara"> Jayapura Utara </option>
                                            <option value="Jayapura Selatan"> Jayapura Selatan </option>
                                            <option value="Abepura"> Abepura </option>
                                            <option value="Muara Tami">Muara Tami</option>
                                            <option value="Heram">Heram</option>
                                        </select>
                                        <?= form_error('alamat_distrik', '<div class = "text-small text-danger">', ' </div>'); ?>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Alamat Jalan</label>
                                    <input id="" type="" class="form-control" name="alamat_jalan">
                                    <?= form_error('alamat_jalan', '<div class = "text-small text-danger">', ' </div>'); ?>

                                </div>
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="">Nomor Handphone</label>
                                        <input id="" type="text" class="form-control" name="nm_hp">
                                        <?= form_error('nm_hp', '<div class = "text-small text-danger">', ' </div>'); ?>

                                    </div>
                                    <div class="form-group col-6">
                                        <label for="">Email</label>
                                        <input id="" type="text" class="form-control" name="email">
                                        <?= form_error('email', '<div class = "text-small text-danger">', ' </div>'); ?>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-12">
                                        <label for="">KTP (JPG/PNG)</label>
                                        <input id="" type="file" required class="form-control" name="ktp">


                                    </div>
                                    <div class="form-group col-sm-12">
                                        <label for="">SIUP (JPG/PNG)</label>
                                        <input id="" type="file" required class="form-control" name="siup">
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <label for="">Logo (JPG/PNG)</label>
                                        <input id="" type="file" required class="form-control" name="logo">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Link Peta Google (Jika ada) </label>
                                    <input id="" type="text" class="form-control" name="peta_google">
                                </div>
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="">Password</label>
                                        <input id="" type="password" class="form-control" name="password">
                                        <?= form_error('password', '<div class = "text-small text-danger">', ' </div>'); ?>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="">Ulangi Password</label>
                                        <input id="" type="password" class="form-control" name="ulangi_password">
                                        <?= form_error('ulangi_password', '<div class = "text-small text-danger">', ' </div>'); ?>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                                        Daftar
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>