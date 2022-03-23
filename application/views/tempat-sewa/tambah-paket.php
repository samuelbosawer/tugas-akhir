     <!-- Main Content -->
     <div class="main-content">
         <section class="section">
             <div class="section-header">
                 <h1>Tambah Data Paket</h1>
             </div>
             <form action="<?= base_url() ?>tempat-sewa/paket/aksi_tambah_paket" enctype="multipart/form-data" method="post">
                 <?php
                    error_reporting(0);
                    if ($kode->id_perlengkapan != null) {
                        $id_perlengkapan = $kode->id_perlengkapan;
                    } else {
                        $id_perlengkapan = "plg-0000";
                    }
                    $no_urut = (int)substr($id_perlengkapan, 4, 4);
                    $no_urut++;
                    $id = "plg-";
                    $id_baru = $id . sprintf("%04s", $no_urut);
                    ?>
                 <input type="hidden" name="id_perlengkapan" value="<?= $id_baru ?>">
                 <div class="card">
                     <div class="card-body">
                         <div class="form-group row">
                             <label for="" class="col-sm-3 col-form-label">Paket Perlengkapan</label>
                             <div class="col-sm-9">
                                 <input type="" name="nama_perlengkapan" class="form-control" id="" placeholder="" value="<?= set_value('nama_perlengkapan') ?>">
                                 <?= form_error('nama_perlengkapan', '<div class = "text-small text-danger">', ' </div>'); ?>
                             </div>
                         </div>
                         <div class="form-group row">
                             <label for="" class="col-sm-3 col-form-label">Harga Sewa / Hari</label>
                             <div class="col-sm-9">
                                 <input type="" name="harga" class="form-control" id="" placeholder="" value="<?= set_value('harga') ?>">
                                 <?= form_error(
                                        'harga',
                                        '<div class = "text-small text-danger">',
                                        '</div>'
                                    ); ?>
                             </div>
                         </div>

                         <div class="form-group row">
                             <label for="" class="col-sm-3 col-form-label">Jumlah Stok Paket</label>
                             <div class="col-sm-9">
                                 <input type="" name="stok" class="form-control" id="" placeholder="" value="<?= set_value('stok') ?>">
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
                                 <input type="file" name="foto" required class="form-control" id="" placeholder="" value="<?= set_value('foto') ?>">
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
                                 <textarea class="form-control" name="deskripsi" id="" style="height: 200px;"> <?= set_value('deskripsi') ?></textarea>
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
             </form>
         </section>
     </div>