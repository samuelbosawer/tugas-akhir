     <!-- Main Content -->
     <div class="main-content">
         <section class="section">
             <div class="section-header">
                 <h1>Data Paket Perlengkapan</h1>
             </div>
             <div class="card">
                 <div class="card-header">
                     <a id="" class="btn btn-primary" href="<?= base_url() ?>tempat-sewa/paket/tambah_paket" role="button"> <i class="fas fa-plus"></i> Tambah Data Paket</a>
                 </div>
                 <?= $this->session->flashdata('pesan');
                    $this->session->set_flashdata('pesan', '');
                    ?>
                 <div class="card-body table-responsive">
                     <table id="table_id" class="table table-hover text-center">
                         <thead>
                             <tr>
                                 <th scope="col">#</th>
                                 <th scope="col">Paket Perlengkapan</th>
                                 <th scope="col">Harga Sewa / Hari</th>
                                 <th scope="col">Stok</th>
                                 <th scope="col">Stok Yang Disewa</th>
                                 <th scope="col">Stok Digudang</th>
                                 <th scope="col">Foto</th>
                                 <th scope="col">Aksi</th>
                             </tr>
                         </thead>
                         <tbody>
                             <?php $i = 0;
                                foreach ($paket as $p) : ?>
                                 <tr>
                                     <th scope="row"><?= ++$i ?></th>
                                     <td><?= $p->nama_perlengkapan; ?></td>
                                     <td> Rp. <?= number_format($p->harga, 0, ',', '.'); ?> </td>
                                     <td> <?= $p->stok; ?></td>
                                     <td>
                                         <?php
                                            $cek = $this->db->query("SELECT * FROM penyewaan WHERE id_perlengkapan = '$p->id_perlengkapan' AND status_pembayaran = 'settlement' ")->result();
                                            $sewa = 0;
                                            if ($cek) {
                                                foreach ($cek as $c) {
                                                    if ($c->status_sewa == 1 or $c->status_sewa == 2) {
                                                        $sewa = $c->jumlah_stok;
                                                    } else {
                                                        $sewa = 0;
                                                    }
                                                }
                                            }
                                            echo $sewa;
                                            ?>
                                     </td>
                                     <td> <?= $p->stok - $i ?> </td>
                                     <td> <img src="<?= base_url() ?>assets/upload/perlengkapan/<?= $p->foto; ?>" width="100px" alt="" srcset=""> </td>
                                     <td>
                                         <a name="" id="" class="btn btn-info" href="<?= base_url() ?>tempat-sewa/paket/detail_paket/<?= $p->id_perlengkapan ?>" role="button"> <i class="fas fa-eye"></i> </a>
                                         <a name="" id="" class="btn btn-success" href="<?= base_url() ?>tempat-sewa/paket/update_paket/<?= $p->id_perlengkapan ?>" role="button"> <i class="fas fa-pencil-alt"></i> </a>
                                         <a name="" onclick="return confirm('Apakah anda yakin ?')" id="" class="btn btn-danger" href="<?= base_url() ?>tempat-sewa/paket/delete_paket/<?= $p->id_perlengkapan ?>" role="button"> <i class="fas fa-trash-alt"></i> </a>
                                     </td>
                                 </tr>
                             <?php endforeach ?>
                         </tbody>
                     </table>
                     <div class="section-body">
                     </div>
         </section>
     </div>