<body>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <?= $this->session->flashdata('pesan');
                $this->session->set_flashdata('pesan', '');
                ?>
                <div class="row">
                    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>Masuk</h4>
                            </div>

                            <div class="card-body">
                                <form method="POST" action="#">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input id="email" type="text" class="form-control" name="email" tabindex="1" autofocus>
                                        <?= form_error('email', '<div class = "text-small text-danger">', ' </div>'); ?>
                                    </div>

                                    <div class="form-group">
                                        <div class="d-block">
                                            <label for="password" class="control-label">Password</label>
                                            <div class="float-right">
                                                <!-- <a href="auth-forgot-password.html" class="text-small">
                                                    Lupa Password?
                                                </a> -->
                                            </div>
                                        </div>
                                        <input id="password" type="password" class="form-control" name="password" tabindex="2">
                                        <?= form_error('password', '<div class = "text-small text-danger">', ' </div>'); ?>
                                    </div>



                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                            Masuk
                                        </button>
                                    </div>
                                </form>


                            </div>
                        </div>
                        <div class="mt-5 text-muted text-center">
                            Belum memiliki akun? <a href="<?= base_url() ?>auth/daftar">Buat Akun</a>
                        </div>