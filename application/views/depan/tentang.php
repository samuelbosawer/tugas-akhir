 <!-- ======= About Section ======= -->
 <section id="about" class="about mt-5">
     <div class="container-fluid">
         <?php foreach ($detail as $d) : ?>
             <div class="text-center mt-3">
                 <img width="400" src="<?= base_url() ?>assets/upload/pelanggan/<?= $d->foto ?>" class="img-fluid rounded-circle" alt="">
             </div>
             <div class="row">
                 <div class="col-xl-7 col-lg-6 icon-boxes d-flex flex-column align-items-stretch justify-content-center py-5 px-lg-5" data-aos="fade-left">


                     <h3 class="mt-5"><?= $d->nama_akun ?></h3>
                     <p>Alamat : <?= $d->alamat_jalan ?>, <?= $d->alamat_distrik ?></p>

                     <div class="icon-box" data-aos="zoom-in" data-aos-delay="100">
                         <div class="icon"><i class="bx bx-atom"></i></div>
                         <h4 class="title"><a href="">Nomor HP</a></h4>
                         <p class="description"><?= $d->nm_hp ?></p>
                     </div>

                     <div class="icon-box" data-aos="zoom-in" data-aos-delay="200">
                         <div class="icon"><i class="bx bx-atom"></i></div>
                         <h4 class="title"><a href="">Email</a></h4>
                         <p class="description"><?= $d->email ?></p>
                     </div>
                     <div class="icon-box" data-aos="zoom-in" data-aos-delay="200">
                         <?php if ($d->status_validasi == 1) : ?>
                             <div class="icon"><i class="bx bx-atom"></i></div>
                             <h4 class="title"><a href="">Akun </a></h4>
                             <p class="description text-success">Sudah divalidasi</p>
                         <?php else : ?>
                             <div class="icon"><i class="bx bx-atom"></i></div>
                             <h4 class="title"><a href="">Akun </a></h4>
                             <p class="description text-danger">Belum divalidasi</p>
                             <p class="description text-danger">Silahkan isi data anda dengan benar</p>
                         <?php endif; ?>

                     </div>
                 </div>
                 <div class="col-xl-5 col-lg-6 d-flex justify-content-center align-items-stretch" data-aos="fade-right">
                     <div class="icon-box" data-aos="zoom-in" data-aos-delay="300">
                         <div class="icon"><i class="bx bx-atom"></i></div>
                         <h4 class="title"><a href="">KTP</a></h4>
                         <p class="description">
                             <img width="400" src="<?= base_url() ?>assets/upload/pelanggan/<?= $d->ktp ?>" class="img-fluid " alt="">
                         </p>
                         <p class="description mt-0">
                             <a name="" id="" target="_blank" class="btn btn-secondary btn-sm mt-3" href="<?= base_url() ?>assets/upload/pelanggan/<?= $d->ktp ?>" role="button">Full</a>
                         </p>
                     </div>
                 </div>


             </div>
             <div class="text-center m-5">
                 <a name="" id="" class="btn btn-primary text-white rounded" href="<?= base_url() ?>depan/about/ubah" role="button">UBAH DATA</a>

                 <a name="" id="" class="btn btn-primary text-white rounded" href="<?= base_url() ?>depan/about/password" role="button">UBAH PASSWORD</a>
             </div>
         <?php endforeach; ?>
     </div>
 </section><!-- End About Section -->