     <!-- Main Content -->
     <div class="main-content">
         <section class="section">
             <div class="section-header">
                 <h1>Laporan Data Pelanggan</h1>
             </div>
             <div class="section-body">
                 <div class="card">
                     <?= $this->session->flashdata('pesan');
                        $this->session->set_flashdata('pesan', '');
                        ?>
                     <div class="card-body table-responsive">
                         <table id="table_id" class="table table-hover text-center">
                             <thead>
                                 <tr>
                                     <th scope="col">#</th>
                                     <th scope="col">Email</th>
                                     <th scope="col">Nama</th>
                                     <th scope="col">Hak Akses</th>
                                     <th scope="col">Status Aktivasi </th>
                                     <th scope="col">Status Validasi </th>
                                 </tr>
                             </thead>
                             <tbody>
                                 <?php $i = 0;
                                    foreach ($login as $l) : ?>
                                     <tr>
                                         <th scope="row"><?= ++$i ?></th>
                                         <td><?= $l->email; ?></td>
                                         <td><?= $l->nama_akun; ?> </td>
                                         <td>
                                             <?php if ($l->hak_akses == '3') {
                                                    echo "Pelanggan";
                                                } elseif ($l->hak_akses == '2') {
                                                    echo "Tempat Penyewaan";
                                                } elseif ($l->hak_akses == 1) {
                                                    echo "Super Admin (Root)";
                                                } else {
                                                    echo " Tidak diketahui";
                                                } ?>
                                         </td>
                                         <td>
                                             <?php if ($l->status_aktivasi == 1) {
                                                    echo "<i class='fa fa-check'></i>";
                                                } else {
                                                    echo "<i class='fas fa-times'></i>";
                                                } ?>
                                         </td>
                                         <td>
                                             <?php if ($l->status_validasi == 1) {
                                                    echo "<i class='fa fa-check'></i>";
                                                } else {
                                                    echo "<i class='fas fa-times'></i>";
                                                } ?>
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