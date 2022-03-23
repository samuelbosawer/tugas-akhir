 <!-- Main Content -->
 <div class="main-content">
     <section class="section">
         <div class="row">
             <div class="col-lg-4 col-md-4 col-sm-12">
                 <div class="card card-statistic-2">
                     <div class="card-icon shadow-primary bg-primary">
                         <i class="fas fa-home"></i>
                     </div>
                     <div class="card-wrap">
                         <div class="card-header">
                             <h4>Tempat Penyewaan</h4>
                         </div>
                         <div class="card-body">
                             <?= $tempat ?>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="col-lg-4 col-md-4 col-sm-12">
                 <div class="card card-statistic-2">
                     <div class="card-icon shadow-primary bg-primary">
                         <i class="fas fa-users"></i>
                     </div>
                     <div class="card-wrap">
                         <div class="card-header">
                             <h4>Pelanggan</h4>
                         </div>
                         <div class="card-body">
                             <?= $pelanggan ?>
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
                             <h4>Total Pemasukan</h4>
                         </div>
                         <div class="card-body">
                             Rp. <?= number_format($total); ?>
                         </div>
                     </div>
                 </div>
             </div>

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
                         <i class="fas fa-dollar-sign"></i>
                     </div>
                     <div class="card-wrap">
                         <div class="card-header">
                             <h4>Pemasukan Admin</h4>
                         </div>
                         <div class="card-body">
                             Rp. <?= number_format($admin); ?>
                         </div>
                     </div>
                 </div>
             </div>


         </div>
         <div class="row">
             <div class="col card">
                 <h5 class="m-3">Ada <?= count($tempat_login) ?> akun tempat penyewaan yang belum divalidasi</h5>
                 <div class="card-body table-responsive">
                     <table id="table_id" class="table table-hover text-center">
                         <thead>
                             <tr>
                                 <th scope="col">#</th>
                                 <th scope="col">Email</th>
                                 <th scope="col">Nama</th>
                                 <th scope="col">Status Validasi </th>
                                 <th scope="col">Aksi</th>
                             </tr>
                         </thead>
                         <tbody>
                             <?php $i = 0;
                                foreach ($tempat_login as $l) : ?>
                                 <tr>
                                     <th scope="row"><?= ++$i ?></th>
                                     <td><?= $l->email; ?></td>
                                     <td><?= $l->nama_akun; ?> </td>


                                     <td>
                                         <?php if ($l->status_validasi == 1) {
                                                echo "<i class='fa fa-check'></i>";
                                            } else {
                                                echo "<i class='fas fa-times'></i>";
                                            } ?>
                                     </td>
                                     <td>
                                         <a name="" id="" class="btn btn-primary" href="<?= base_url() ?>admin/validasi_ts/<?= $l->id ?>" role="button"><i class='fas fa-eye'></i></a>
                                     </td>
                                 </tr>
                             <?php endforeach ?>
                         </tbody>
                     </table>
                     <div class="section-body">
                     </div>
                 </div>
             </div>
         </div>
         <div class="row">
             <div class="col card">
                 <h5 class="m-3">Ada <?= count($pelanggan_login) ?> akun pelanggan yang belum divalidasi</h5>
                 <div class="card-body table-responsive">
                     <table id="table_id2" class="table table-hover text-center">
                         <thead>
                             <tr>
                                 <th scope="col">#</th>
                                 <th scope="col">Email</th>
                                 <th scope="col">Nama</th>
                                 <th scope="col">Status Validasi </th>
                                 <th scope="col">Aksi</th>
                             </tr>
                         </thead>
                         <tbody>
                             <?php $i = 0;
                                foreach ($pelanggan_login as $l) : ?>
                                 <tr>
                                     <th scope="row"><?= ++$i ?></th>
                                     <td><?= $l->email; ?></td>
                                     <td><?= $l->nama_akun; ?> </td>


                                     <td>
                                         <?php if ($l->status_validasi == 1) {
                                                echo "<i class='fa fa-check'></i>";
                                            } else {
                                                echo "<i class='fas fa-times'></i>";
                                            } ?>
                                     </td>
                                     <td>
                                         <a name="" id="" class="btn btn-primary" href="<?= base_url() ?>admin/validasi_ts/<?= $l->id ?>" role="button"><i class='fas fa-eye'></i></a>
                                     </td>
                                 </tr>
                             <?php endforeach ?>
                         </tbody>
                     </table>
                     <div class="section-body">
                     </div>
                 </div>
             </div>
         </div>
     </section>
 </div>