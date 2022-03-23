     <!-- Main Content -->
     <div class="main-content">
         <section class="section">
             <div class="section-header">
                 <h1>Laporan Pendapatan</h1>
             </div>
             <div class="section-body">
                 <div class="card">
                     <form action="<?= base_url() ?>admin/cetak_pemasukan" method="post">
                         <div class="col-2 m-3">
                             <button type="submit" class="btn btn-primary"> <i class="fas fa-envelope-open-text"></i> Cetak Laporan </button>
                         </div>
                         <div class="row ml-5 mt-3">
                             <div class="col-4">
                                 <div class="form-group ">
                                     <label for="">Cetak Pertahun</label>
                                     <select class="form-control" name="tahun" id="">
                                         <option value="">-</option>
                                         <?php for ($i = 2020; $i < 2050; $i++) : ?>
                                             <option value="<?= $i ?>"> <?= $i ?></option>
                                         <?php endfor; ?>
                                     </select>
                                 </div>
                             </div>
                             <div class="col-4">
                                 <div class="form-group">
                                     <label for="">Cetak Perbulan</label>
                                     <input type="date" class="form-control" name="bulan">
                                 </div>
                             </div>
                         </div>
                     </form>
                     <div class="card-body table-responsive">
                         <table id="table_id" class="table table-hover text-center">
                             <thead>
                                 <tr>
                                     <th scope="col">#</th>
                                     <th scope="col">Pendapatan Tempat Penyewaan</th>
                                     <th scope="col">Pendapatan Admin</th>
                                     <th scope="col">Tanggal </th>
                                 </tr>
                             </thead>
                             <tbody>
                                 <?php $admin = 0;
                                    $tempat = 0;
                                    $i = 0;
                                    foreach ($pendapatan as $p) : ?>
                                     <tr>
                                         <td><?= ++$i ?></td>
                                         <td>Rp. <?= number_format($p->pendapatan_tempat); ?></td>
                                         <td>Rp. <?= number_format($p->pendapatan_admin); ?></td>
                                         <td> <?= date('d-m-Y', strtotime($p->tanggal))  ?></td>
                                     </tr>
                                     <?php
                                        $tempat = $tempat + $p->pendapatan_tempat;
                                        $admin  = $admin  + $p->pendapatan_admin;
                                        ?>
                                 <?php endforeach; ?>
                                 <tr class="text-align">
                                     <td>Total</td>
                                     <td> <?= number_format($tempat); ?></td>
                                     <td> <?= number_format($admin); ?></td>
                                     <td></td>
                                 </tr>
                             </tbody>
                         </table>
                         <div class="section-body">
                         </div>
                     </div>
                 </div>
             </div>
         </section>
     </div>