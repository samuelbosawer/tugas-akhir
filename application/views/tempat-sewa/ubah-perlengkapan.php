     <!-- Main Content -->
     <div class="main-content">
         <section class="section">
             <div class="section-header">
                 <h1>Ubah Data Perlengkapan</h1>
             </div>
             <form action="<?= base_url() ?>tempat-sewa/perlengkapan/aksi_ubah_perlengkapan" enctype="multipart/form-data" method="post">
                 <?php foreach ($detail as $d) : ?>
                     <input type="hidden" name="id_perlengkapan" value="<?= $d->id_perlengkapan ?>">
                     <div class="card">
                         <div class="card-body">
                             <div class="form-group row">
                                 <label for="" class="col-sm-3 col-form-label">Nama Perlengkapan</label>
                                 <div class="col-sm-9">
                                     <input type="" name="nama_perlengkapan" class="form-control" id="" placeholder="" value="<?= $d->nama_perlengkapan ?>">
                                     <?= form_error('nama_perlengkapan', '<div class = "text-small text-danger">', ' </div>'); ?>
                                 </div>
                             </div>
                             <div class="form-group row">
                                 <label for="" class="col-sm-3 col-form-label">Harga Sewa / Hari</label>
                                 <div class="col-sm-9">
                                     <input type="" name="harga" class="form-control" id="" placeholder="" value="<?= $d->harga ?>">
                                     <?= form_error(
                                            'harga',
                                            '<div class = "text-small text-danger">',
                                            '</div>'
                                        ); ?>
                                 </div>
                             </div>
                             <div class="form-group row">
                                 <label for="" class="col-sm-3 col-form-label">Jumlah Stok</label>
                                 <div class="col-sm-9">
                                     <input type="" name="stok" class="form-control" id="" placeholder="" value="<?= $d->stok ?>">
                                     <?= form_error(
                                            'stok',
                                            '<div class="text-small text-danger">',
                                            '</div>'
                                        ); ?>
                                 </div>
                             </div>
                             <div class="form-group row">
                                 <label for="" class="col-sm-3 col-form-label">Foto</label>
                                 <div class="col-sm-9">
                                     <img src="<?= base_url() ?>assets/upload/perlengkapan/<?= $d->foto ?>" width="300" alt="" srcset="">
                                     <input type="file" name="foto" class="form-control mt-2" id="" placeholder="">
                                     <?= form_error(
                                            'foto',
                                            '<div class="text-small text-danger">',
                                            '</div>'
                                        ); ?>
                                 </div>
                             </div>
                             <div class="form-group row">
                                 <label class="col-sm-3 col-form-label" for=""> Deskripsi</label>
                                 <div class="col-sm-9">

                                     <textarea class="form-control textarea" name="deskripsi" id="" style="height: 200px;"> <?= $d->deskripsi ?>  </textarea>
                                     <?= form_error(
                                            'deskripsi',
                                            '<div class="text-small text-danger">',
                                            '</div>'
                                        ); ?>
                                 </div>
                             </div>
                         </div>
                         <div class="card-footer">
                             <button type="submit" class="btn btn-primary">Simpan</button>
                         </div>
                     <?php endforeach ?>
             </form>
         </section>
     </div>