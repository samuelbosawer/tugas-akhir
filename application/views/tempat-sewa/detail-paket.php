     <!-- Main Content -->
     <div class="main-content">
         <section class="section">
             <div class="section-header">
                 <h1>Detail Data Paket Perlengkapan</h1>
             </div>
             <?php foreach ($detail as $d) : ?>
                 <?php $stok = $d->stok ?>
                 <?php foreach ($jumlah as $j) : ?>
                     <?php if ($d->id_perlengkapan == $j['id_perlengkapan']) : ?>
                         <?php $stok = $d->stok - $j['jumlah_stok']; ?>
                     <?php endif ?>
                 <?php endforeach ?>
                 <div class="card">
                     <div class="card-body">
                         <div class="row">
                             <div class="col-6-md">
                                 <img src="<?= base_url() ?>assets/upload/perlengkapan/<?= $d->foto; ?>" width="500px" alt="" srcset="">
                             </div>
                             <div class="col-6-md">
                                 <table class="table">
                                     <tbody>
                                         <tr>
                                             <td scope="row">Paket Perlengkapan </td>
                                             <td><?= $d->nama_perlengkapan ?></td>
                                         </tr>
                                         <tr>
                                             <td scope="row">Harga Sewa / Hari </td>
                                             <td> Rp. <?= number_format($d->harga, 0, ',', '.'); ?></td>
                                         </tr>
                                         <tr>
                                             <td scope="row">Jumlah Stok </td>
                                             <td> <?= $d->stok ?></td>
                                         </tr>
                                         <tr>
                                             <td scope="row">Deskripsi </td>
                                             <td> <?= $d->deskripsi ?></td>
                                         </tr>
                                     </tbody>
                                 </table>
                                 <a name="" id="" class="btn btn-primary ml-3" href="<?= base_url() ?>tempat-sewa/perlengkapan" role="button">Kembali</a>
                             </div>
                         </div>
                     </div>
                 </div>
             <?php endforeach; ?>

         </section>
     </div>