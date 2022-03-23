 <!-- ======= About Section ======= -->
 <section id="about" class="about mt-5">
     <div class="container-fluid">
         <?php foreach ($detail as $d) : ?>
             <form enctype="multipart/form-data" action="<?= base_url() ?>depan/about/aksi_ubah" method="post">
                 <div class="conainer">
                     <div class="card shadow-lg" style="width: 90%; margin: auto;">
                         <div class=" card-header bg-primary text-white text-center" style="background-color: #1A1D94 !important;">
                             <h5> UBAH DATA PELANGGAN </h5>
                         </div>
                         <div class="card-body">
                             <div class="row">
                                 <div class="col-md-8">
                                     <div class="form-group">
                                         <label for="">Nama</label>
                                         <input type="text" class="form-control" name="nama_akun" value="<?= $this->input->post('nama_akun') ?? $d->nama_akun ?>">
                                         <?= form_error('nama_akun', '<div class = "text-small text-danger">', ' </div>'); ?>

                                     </div>
                                     <div class="form-group">
                                         <label for="">Alamat Distrik</label>
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

                                     <div class="form-group">
                                         <label for="">Alamat Jalan</label>
                                         <input type="text" class="form-control" name="alamat_jalan" value="<?= $this->input->post('alamat_jalan') ?? $d->alamat_jalan ?>">
                                         <?= form_error('alamat_jalan', '<div class = "text-small text-danger">', ' </div>'); ?>
                                     </div>

                                     <div class="form-group">
                                         <label for="">Nomor HP</label>
                                         <input type="text" class="form-control" name="nm_hp" value="<?= $this->input->post('nm_hp') ?? $d->nm_hp ?>">
                                         <?= form_error('nm_hp', '<div class = "text-small text-danger">', ' </div>'); ?>
                                     </div>

                                     <div class="form-group">
                                         <label for="">Email</label>
                                         <input type="text" class="form-control" readonly name="" value="<?= $this->input->post('email') ?? $d->email ?>">
                                     </div>

                                 </div>


                                 <div class="col-md-4">
                                     <div class="form-group">
                                         <label for="" class="col-lg-3 col-form-label ">KTP</label>
                                         <div class="col-lg-9">
                                             <input type="File" name="ktp" class="form-control mb-3" id="" placeholder="" value="" data-default-file="">
                                             <img width="300" src="<?= base_url(); ?>assets/upload/pelanggan/<?= $d->ktp ?>" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="">
                                             <p>
                                                 <a name="" id="" target="_blank" class="btn btn-secondary btn-sm mt-3" href="<?= base_url() ?>assets/upload/pelanggan/<?= $d->ktp ?>" role="button">Full</a>
                                             </p>
                                         </div>
                                     </div>
                                     <div class="form-group">
                                         <label for="" class="col-lg-4 col-form-label">Foto Profil</label>
                                         <div class="col-lg-9">
                                             <input type="File" name="foto" class="form-control mb-3" id="" placeholder="" value="" data-default-file="">
                                             <img width="300" src="<?= base_url(); ?>assets/upload/pelanggan/<?= $d->foto ?>" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="">
                                             <p>
                                                 <a name="" id="" target="_blank" class="btn btn-secondary btn-sm mt-3" href="<?= base_url() ?>assets/upload/pelanggan/<?= $d->foto ?>" role="button">Full</a>
                                             </p>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                             <div class="text-center">
                                 <button type="submit" class="btn btn-primary ">UBAH</button>
                             </div>
                         </div>

                         <div class="card-footer bg-secondary text-white text-center mb-3" style="background-color: #1A1D94 !important;">

                         </div>
                     </div>
                 </div>

             </form>
         <?php endforeach; ?>
     </div>
 </section><!-- End About Section -->