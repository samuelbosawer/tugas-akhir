     <!-- Main Content -->
     <div class="main-content">
         <section class="section">
             <div class="section-header">
                 <h1>Data Penyewaan</h1>
             </div>
             <div class="section-body">
                 <div class="card">
                     <div class="card-body table-responsive">
                         <table class=" table table-hover text-center" id="table_id">
                             <thead>
                                 <tr>
                                     <th>Aksi</th>
                                     <th>No Resi</th>
                                     <th>Nama Perlengkapan</th>
                                     <!-- <th>Harga</th> -->
                                     <th>Tanggal Sewa</th>
                                     <th>Jumlah Stok</th>
                                     <th>Total Harga</th>
                                     <th>Konfirmasi</th>
                                     <th>Pembayaran</th>
                                     <th>Status</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 <?php foreach ($penyewaan as $p) : ?>
                                     <tr>
                                         <td><a name="" id="" class="btn btn-primary" href="<?= base_url() ?>tempat-sewa/penyewaan/detail/<?= $p->id_sewa ?>" role="button">Detail Pelanggan </a></td>
                                         <td scope="row"> <?= $p->no_penyewaan ?></td>
                                         <td><?= $p->nama_perlengkapan ?></td>
                                         <!-- <td>Rp. <?= number_format($p->harga)  ?></td> -->
                                         <td> <?= date('d-m-Y', strtotime($p->mulai_sewa))  ?> -
                                             <?= date('d-m-Y', strtotime($p->akhir_sewa))  ?></td>
                                         <td> <?= $p->jumlah_stok  ?></td>
                                         <td>Rp. <?= number_format($p->harga * $p->jumlah_stok);   ?></td>
                                         <td>
                                             <form action="<?= base_url() ?>tempat-sewa/penyewaan/konfirmasi" method="post">
                                                 <?php
                                                    if ($p->status_pembayaran == 'settlement' and $p->status_sewa == '0') : ?>
                                                     <button onclick="return confirm('Apakah Anda Yakin ?')" type="submit" class="btn btn-primary">Apakah Perlengkapan sudah diantar ? <br> (Klik jika sudah) </button>
                                                     <input type="hidden" name="status" value="1">
                                                 <?php endif ?>
                                                 <?php if ($p->status_sewa == '1') : ?>
                                                     <button onclick="return confirm('Apakah Anda Yakin ?')" type="submit" class="btn btn-info">Apakah Perlengkapan sudah selesai disewa ? <br> (Klik jika sudah) </button>
                                                     <input type="hidden" name="status" value="2">
                                                 <?php endif ?>
                                                 <?php if ($p->status_sewa == '2') : ?>
                                                     <span class="badge badge-success">Penyewaan selesai </span>
                                                 <?php endif ?>

                                                 <?php if ($p->status_sewa == '0' and $p->status_pembayaran == 'pending') : ?>
                                                     <span class="badge badge-danger"> Belum ada konfimarsi </span>
                                                 <?php endif ?>

                                                 <?php
                                                    if ($p->status_sewa == '3') {
                                                        echo '<span class="badge badge-success">Penyewaan selesai </span>';
                                                    }
                                                    ?>
                                                 <input type="hidden" name="id_sewa" value="<?= $p->id_sewa ?>">
                                             </form>

                                         </td>
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
                                                if ($p->status_pembayaran == 'settlement' and $p->status_sewa == '0') {
                                                    echo '<span class="badge badge-primary">Segera diantar </span>';
                                                }
                                                if ($p->status_pembayaran == 'settlement' and $p->status_sewa == '1') {
                                                    echo '<span class="badge badge-primary">Perlengkapan sudah diterima </span>';
                                                }
                                                if ($p->status_pembayaran == 'pending' and $p->status_sewa == '0') {
                                                    echo '<span class="badge badge-danger"> Belum diterima </span>';
                                                }
                                                if ($p->status_sewa == '2') {
                                                    echo '<span class="badge badge-success">Penyewaan selesai </span>';
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