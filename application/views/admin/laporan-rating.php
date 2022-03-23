     <!-- Main Content -->
     <div class="main-content">
         <section class="section">
             <div class="section-header">
                 <h1>Laporan Rating</h1>
             </div>
             <div class="section-body">
                 <div class="card">
                     <!-- <form action="<?= base_url() ?>admin/cetak_penyewaan_banyak" method="post">
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
                     </form> -->
                     <div class="card-body table-responsive">
                         <table class=" table table-hover text-center" id="table_id">
                             <thead>
                                 <tr>
                                     <th>#</th>
                                     <th>Nama Tempat</th>
                                     <th>Nama Pelanggan</th>
                                     <th>Rating</th>
                                     <th>Komentar</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 <?php $i = 0;
                                    foreach ($rating as $r) : ?>
                                     <tr>
                                         <td><?= ++$i ?></td>
                                         <td scope="row"> <?= $r->nama_tempat ?></td>
                                         <td><?= $r->nama ?></td>
                                         <td> <input type="text" id="bintang" class="rating" data-readonly="true" data-size="sm" value="<?= $r->jumlah_rating ?>" title=""></td>
                                         <td><?= $r->komentar ?></td>

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