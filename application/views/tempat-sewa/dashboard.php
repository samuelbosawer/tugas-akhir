 <!-- Main Content -->
 <div class="main-content">
     <section class="section">
         <div class="row">
             <div class="col-lg-4 col-md-4 col-sm-12">
                 <div class="card card-statistic-2">
                     <div class="card-icon shadow-primary bg-primary">
                         <i class="fas fa-couch"></i>
                     </div>
                     <div class="card-wrap">
                         <div class="card-header">
                             <h4>Perlengkapan</h4>
                         </div>
                         <div class="card-body">
                             <?= $perlengkapan ?>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="col-lg-4 col-md-4 col-sm-12">
                 <div class="card card-statistic-2">
                     <div class="card-icon shadow-primary bg-primary">
                         <i class="fas fa-luggage-cart"></i>
                     </div>
                     <div class="card-wrap">
                         <div class="card-header">
                             <h4>Paket</h4>
                         </div>
                         <div class="card-body">
                             <?= $paket ?>
                         </div>
                     </div>
                 </div>
             </div>


             <?php
                $tempat = 0;
                $admin = 0;
                $total = 0;
                foreach ($pendapatan as $p) {
                    $tempat = $p->pendapatan_tempat + $tempat;
                    $admin = $p->pendapatan_admin + $admin;
                    $total = $p->pendapatan_admin + $p->pendapatan_tempat + $total;
                } ?>


             <div class="col-lg-4 col-md-4 col-sm-12">
                 <div class="card card-statistic-2">
                     <div class="card-icon shadow-primary bg-primary">
                         <i class="fas fa-dollar-sign"></i>
                     </div>
                     <div class="card-wrap">
                         <div class="card-header">
                             <h4>Pemasukan Tempat Penyewaan</h4>
                         </div>
                         <div class="card-body">
                             Rp. <?= number_format($tempat); ?>
                         </div>
                     </div>
                 </div>
             </div>

             <div class="col-lg-4 col-md-4 col-sm-12">
                 <div class="card card-statistic-2">
                     <div class="card-icon shadow-primary bg-primary">
                         <i class="fas fa-archive"></i>
                     </div>
                     <div class="card-wrap">
                         <div class="card-header">
                             <h4>Penyewaan</h4>
                         </div>
                         <div class="card-body">
                             <?= ($sewa); ?>
                         </div>
                     </div>
                     <br>
                 </div>
             </div>

             <div class="col-lg-4 col-md-4 col-sm-12">
                 <div class="card card-statistic-2">
                     <div class="card-icon shadow-primary bg-primary">
                         <i class="fas fa-star"></i>
                     </div>
                     <div class="card-wrap">
                         <div class="card-header">
                             <h4>Rating</h4>
                         </div>
                         <div class="card-body">
                             <?php $bintang = 0;
                                $nilai = count($rating);
                                $hasil = 0;
                                if ($rating) {
                                    foreach ($rating as $r) {
                                        $bintang = $bintang + $r->jumlah_rating;
                                        $hasil = $bintang / $nilai;
                                    }
                                }
                                echo number_format($hasil);
                                ?>
                         </div>
                     </div>
                     <input type="text" id="bintang" class="rating" data-readonly="true" data-size="xs" value="<?= $hasil ?>" title="">
                 </div>
             </div>


             <div class="col-lg-4 col-md-4 col-sm-12">
                 <div class="card card-statistic-2">
                     <?php
                        foreach ($validasi as $t) :  ?>
                         <?php if ($t->status_validasi == 1) : $kata = 'Sudah'; ?>
                             <div class="card-icon shadow-primary bg-success">
                                 <i class="fa fa-check text-white"></i>
                             </div>
                         <?php endif; ?>

                         <?php if ($t->status_validasi == 0) : $kata = 'Belum';  ?>
                             <div class="card-icon shadow-primary bg-danger">
                                 <i class="fas fa-times text-white"></i>
                                 <script>
                                     alert('Perhatian Data Anda Belum Divalidasi, Harap Periksa Data Anda Kemudian Bersabar Agar Data Anda Diperiksa Oleh Admin !!');
                                 </script>
                             </div>
                         <?php endif ?>
                     <?php endforeach ?>

                     <div class="card-wrap">
                         <div class="card-header">
                             <h4> Validasi Data</h4>
                         </div>
                         <div class="card-body">
                             <?= $kata ?>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
         <?php

            $data['pelanggan'] = $this->db->get_where('tempat_sewa', ['email' => $this->session->userdata('email')])->row_array();
            $id_pelanggan = $data['pelanggan']['id_tempat'];

            $cek1 = $this->db->query("SELECT * FROM penyewaan, tempat_sewa, pelanggan,  perlengkapan WHERE tempat_sewa.id_tempat ='$id_pelanggan' AND penyewaan.id_pelanggan = pelanggan.id_pelanggan AND penyewaan.id_perlengkapan = perlengkapan.id_perlengkapan AND perlengkapan.id_tempat = tempat_sewa.id_tempat AND penyewaan.status_pembayaran = 'settlement' AND penyewaan.status_sewa = '0'   ")->result();

            $cek2 = $this->db->query("SELECT * FROM penyewaan, tempat_sewa, pelanggan,  perlengkapan WHERE tempat_sewa.id_tempat ='$id_pelanggan' AND penyewaan.id_pelanggan = pelanggan.id_pelanggan AND penyewaan.id_perlengkapan = perlengkapan.id_perlengkapan AND perlengkapan.id_tempat = tempat_sewa.id_tempat AND penyewaan.status_pembayaran = 'settlement' AND penyewaan.status_sewa = '1'   ")->result();

            $cek3 = $this->db->query("SELECT * FROM penyewaan, tempat_sewa, pelanggan,  perlengkapan WHERE tempat_sewa.id_tempat ='$id_pelanggan' AND penyewaan.id_pelanggan = pelanggan.id_pelanggan AND penyewaan.id_perlengkapan = perlengkapan.id_perlengkapan AND perlengkapan.id_tempat = tempat_sewa.id_tempat AND penyewaan.status_pembayaran = 'settlement' AND penyewaan.status_sewa = '2'   ")->result();


            ?>
         <?php if ($cek1) : ?>
             <div class="row">
                 <div class="col">
                     <div class="alert alert-danger" role="alert">
                         <strong>Ada perlengkapan yang harus diantar dan data yang perlu dikonfirmasi !!</strong>
                         Harap Cek Data Penyewaan Sekarang !!
                     </div>
                 </div>
             </div>
         <?php endif; ?>

         <!-- <?php if ($cek3) : ?>
             <div class="row">
                 <div class="col">
                     <div class="alert alert-danger" role="alert">
                         <strong>Ada perlengkapan yang harus diambil dan data yang perlu dikonfirmasi !!</strong>
                         Harap Cek Data Penyewaan Sekarang !!
                     </div>
                 </div>
             </div>
         <?php endif; ?>


         <?php if ($cek2) : ?>
             <div class="row">
                 <div class="col">
                     <div class="alert alert-danger" role="alert">
                         <strong>Ada perlengkapan yang sudah selesai disewa dan data yang perlu dikonfirmasi !!</strong>
                         Harap Cek Data Penyewaan Sekarang !!
                     </div>
                 </div>
             </div>
         <?php endif; ?> -->
         <!-- <div class="row">
             <div class="col-lg-8">
                 <div class="card">
                     <div class="card-header">
                         <h4>Budget vs Sales</h4>
                     </div>
                     <div class="card-body">
                         <canvas id="myChart" height="158"></canvas>
                     </div>
                 </div>
             </div>
             <div class="col-lg-4">
                 <div class="card gradient-bottom">
                     <div class="card-header">
                         <h4>Top 5 Products</h4>
                     </div>
                     <div class="card-body" id="top-5-scroll">
                         <ul class="list-unstyled list-unstyled-border">
                             <li class="media">
                                 <img class="mr-3 rounded" width="55" src="../assets/img/products/product-3-50.png" alt="product">
                                 <div class="media-body">
                                     <div class="float-right">
                                         <div class="font-weight-600 text-muted text-small">86 Sales</div>
                                     </div>
                                     <div class="media-title">oPhone S9 Limited</div>
                                     <div class="mt-1">
                                         <div class="budget-price">
                                             <div class="budget-price-square bg-primary" data-width="64%"></div>
                                             <div class="budget-price-label">$68,714</div>
                                         </div>
                                         <div class="budget-price">
                                             <div class="budget-price-square bg-danger" data-width="43%"></div>
                                             <div class="budget-price-label">$38,700</div>
                                         </div>
                                     </div>
                                 </div>
                             </li>
                         </ul>
                     </div>
                     <div class="card-footer pt-3 d-flex justify-content-center">

                     </div>
                 </div>
             </div>
         </div> -->
         <!-- Button trigger modal -->