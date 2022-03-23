     <!-- Main Content -->
     <div class="main-content">
         <section class="section">
             <div class="section-header">
                 <h1>Laporan Penyewaan</h1>
             </div>
             <div class="section-body">
                 <div class="card">
                     <form action="<?= base_url() ?>admin/cetak_penyewaan_banyak" method="post">
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
                         <table class=" table table-hover text-center" id="table_id">
                             <thead>
                                 <tr>
                                     <th>No Resi</th>
                                     <th>Nama Perlengkapan</th>
                                     <!-- <th>Harga</th> -->
                                     <th>Mulai Sewa</th>
                                     <th>Akhir Sewa</th>
                                     <th>Jumlah Stok</th>
                                     <th>Total Harga</th>
                                     <th>Pembayaran</th>
                                     <th>Status</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 <?php foreach ($penyewaan as $p) : ?>
                                     <tr>
                                         <td scope="row"> <?= $p->no_penyewaan ?></td>
                                         <td><?= $p->nama_perlengkapan ?></td>
                                         <!-- <td>Rp. <?= number_format($p->harga)  ?></td> -->
                                         <td> <?= date('d-m-Y', strtotime($p->mulai_sewa))  ?></td>
                                         <td> <?= date('d-m-Y', strtotime($p->akhir_sewa))  ?></td>
                                         <td> <?= $p->jumlah_stok  ?></td>
                                         <td>Rp. <?= number_format($p->harga * $p->jumlah_stok);   ?></td>
                                         <td>
                                             <?php
                                                if ($p->status_pembayaran == 'pending') {
                                                    echo '<span class="badge badge-danger">Belum bayar</span>';
                                                } elseif ($p->status_pembayaran == 'settlement') {
                                                    echo '<span class="badge badge-success">Sudah bayar</span>';
                                                }
                                                ?>
                                         </td>
                                         <td>
                                             <?php
                                                if ($p->status_pembayaran == 'settlement' and $p->status_sewa == '1') {
                                                    echo '<span class="badge badge-primary">Perlengkapan sudah diterima </span>';
                                                }
                                                if ($p->status_sewa == '0') {
                                                    echo '<span class="badge badge-danger"> Belum diterima </span>';
                                                }
                                                if ($p->status_sewa == '2') {
                                                    echo '<span class="badge badge-primary">Sedang disewa </span>';
                                                }
                                                if ($p->status_sewa == '3') {
                                                    echo '<span class="badge badge-success">Penyewaan selesai </span>';
                                                }
                                                if ($p->status_sewa == '4') {
                                                    echo '<span class="badge badge-success">Penyewaan selesai </span>';
                                                }
                                                ?>
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