 <!-- ======= About Section ======= -->
 <section id="about" class="about mt-5 mb-5">
     <div class="container-fluid">
         <div class="conainer">
             <div class="card shadow-lg" style="width: 90%; margin: auto;">
                 <div class=" card-header bg-primary text-white text-center" style="background-color: #1A1D94 !important;">
                     <h5> UBAH PASSWORD </h5>
                 </div>
                 <div class="card-body">
                     <?= $this->session->flashdata('pesan');
                        $this->session->set_flashdata('pesan', ''); ?>
                     <div class="row">
                         <div class="col-8" style="margin: auto;">
                             <form action="<?= base_url() ?>depan/about/aksi_ubah_password" method="post">
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
                                 <button type="submit" class="btn btn-primary text-center">UBAH PASSWORD</button>
                             </form>
                         </div>
                     </div>

                 </div>
             </div>
         </div>
     </div>
 </section><!-- End About Section -->