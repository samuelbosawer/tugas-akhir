 <!-- ======= About Section ======= -->
 <section id="about" class="about mt-5 section-bg">
     <div class="container-fluid">
         <div class="conainer">
             <div class="card shadow-lg section-bg" style="width: 90%; margin: auto; margin-bottom: 80px; margin-top: 80px;">
                 <div class=" card-header bg-primary text-white text-center" style="background-color: #1A1D94 !important;">
                     <h5> LAPORAN </h5>
                 </div>
                 <div class="card-body">
                     <div class="row">
                         <div class="col">
                             <section id="faq" class="faq section-bg">
                                 <div class="container">
                                     <div class="faq-list">
                                         <ul>
                                             <li data-aos="fade-up" data-aos-delay="200">

                                                 <div class="row mt-3 p-3">
                                                     <div class="col table-responsive">
                                                         <table class=" table table-hover text-center" id="table">
                                                             <thead>
                                                                 <tr>
                                                                     <th>Konfirmasi</th>
                                                                     <th>Nama Perlengkapan</th>
                                                                     <th>Sewa</th>
                                                                     <th> Stok</th>
                                                                     <th>Total Harga</th>
                                                                     <th>Pembayaran</th>
                                                                     <th>Status</th>
                                                                 </tr>
                                                             </thead>
                                                             <tbody>
                                                                 <?php foreach ($penyewaan as $p) :  $id = $p->id_sewa;  ?>
                                                                     <tr>
                                                                         <td>
                                                                             <form action="<?= base_url() ?>depan/beranda/konfirmasi" method="post">
                                                                                 <?php
                                                                                    if ($p->status_pembayaran == 'settlement' and $p->status_sewa == '0') : ?>
                                                                                     <button onclick="return confirm('Apakah Anda Yakin ?')" type="submit" class="btn btn-primary">Apakah Perlengkapan sudah diterima ? <br> (Klik jika sudah) </button>
                                                                                     <input type="hidden" name="status" value="1">
                                                                                 <?php endif ?>
                                                                                 <?php if ($p->status_sewa == '1') : ?>
                                                                                     <button onclick="return confirm('Apakah Anda Yakin ?')" type="submit" class="btn btn-info">Apakah Perlengkapan sudah selesai disewa ? <br> (Klik jika sudah) </button>
                                                                                     <input type="hidden" name="status" value="2">
                                                                                 <?php endif ?>
                                                                                 <?php if ($p->status_sewa == '2') : ?>
                                                                                     <?php
                                                                                        $cek = $this->db->query("SELECT * FROM rating WHERE id_sewa = '$p->id_sewa'");
                                                                                        if ($cek) : ?>
                                                                                         <a data-toggle="modal" data-idsewa="<?= $p->id_sewa ?>" data-nama="<?= $p->nama_tempat ?>" data-idtempat="<?= $p->id_tempat ?>" data-target="#ulasan" type="button" id="set" class="btn btn-warning">Silahkan berikan ulasan anda ! <br> </a>
                                                                                     <?php else : ?>
                                                                                         <span class="badge badge-success">Penyewaan selesai </span>
                                                                                     <?php endif ?>
                                                                                 <?php endif ?>

                                                                                 <?php if ($p->status_sewa == '0' and $p->status_pembayaran == 'pending') : ?>
                                                                                     <span class="badge badge-danger"> Belum ada konfimarsi </span>
                                                                                     <?php endif ?>
                                                                                     
                                                                                     <?php
                                                                                    if ($p->status_sewa == '3') {
                                                                                        echo '<span class="badge badge-success">Penyewaan selesai </span>';
                                                                                    }
                                                                                    ?>
                                                                                 <input type="hidden" name="id_sewa" value="<?= $id ?>">
                                                                                 <a data-toggle="modal" data-nosewa="<?= $p->no_penyewaan ?>"   data-id_sewa="<?= $p->id_sewa ?>"    data-target="#bayarinfo" type="button" id="bayar" class="btn btn-info mt-2"> Detail<br> </a>
                                                                             </form>
                                                                         </td>
                                                                         <td><?= $p->nama_perlengkapan ?></td>
                                                                         <td> <?= date('d/m/Y', strtotime($p->mulai_sewa))  ?> -
                                                                             <?= date('d/m/Y', strtotime($p->akhir_sewa))  ?></td>
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
                                                                                if ($p->status_pembayaran == 'settlement' and $p->status_sewa == '0') {
                                                                                    echo '<span class="badge badge-primary">Perlengkapan  sedang diantar </span>';
                                                                                }
                                                                                if ($p->status_pembayaran == 'pending' and $p->status_sewa == '0') {
                                                                                    echo '<span class="badge badge-danger">Perlengkapan belum  diantar </span>';
                                                                                }
                                                                                if ($p->status_sewa == '1') {
                                                                                    echo '<span class="badge badge-primary">Sedang disewa </span>';
                                                                                }
                                                                                if ($p->status_sewa == '2') {
                                                                                    echo '<span class="badge badge-success">Penyewaan selesai </span>';
                                                                                }
                                                                                if ($p->status_sewa == '3') {
                                                                                    echo '<span class="badge badge-success">Penyewaan selesai </span>';
                                                                                }
                                                                                ?>
                                                                     </tr>
                                                                 <?php endforeach ?>
                                                             </tbody>
                                                         </table>
                                                     </div>
                                                 </div>

                                             </li>
                                         </ul>
                                     </div>
                                 </div>

                             </section>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </section>

 <!-- End About Section -->


 <!-- Modal -->
 <div class="modal fade" id="ulasan" tabindex="-1" style="position: fixed;  z-index: 9999;" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <form action="<?= base_url() ?>depan/beranda/aksi_ulasan" method="post">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title">Ulasan </h5>
                 </div>
                 <span class="text-center m-3" id="namatempat"> </span>
                 <input type="hidden" id="id_sewa" name="id_sewa" value="">
                 <input type="hidden" id="id_tempat" name="id_tempat" value="">
                 <div class="text-center">
                     <input type="text" id="bintang" name="rating" class="rating" data-size="md" value="" title="">
                 </div>

                 <div class="modal-body">
                     <div class="form-group">
                         <textarea class="form-control" name="komentar" placeholder="komentar" id="" rows="3"></textarea>
                     </div>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                     <button type="submit" class="btn btn-primary">Simpan</button>
                 </div>
             </div>
         </form>
     </div>
 </div>




 <!-- Modal -->
 <div class="modal fade" id="bayarinfo" tabindex="-1" style="position: fixed;  z-index: 9999;" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <form action="<?= base_url() ?>depan/beranda/aksi_ulasan" method="post">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title">Detail Pembayaran </h5>
                 </div>
                 <span class="text-center m-3" id="idsewa"> </span>
                 <input type="hidden" id="id_sewa" name="id_sewa" value="">
                 <input type="hidden" id="id_tempat" name="id_tempat" value="">

                 <div class="modal-body">
                     <div class="form-group">
                         <div class="" id="detail"></div>
                     </div>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                 </div>
             </div>
         </form>
     </div>
 </div>