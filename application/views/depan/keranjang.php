 <!-- Checkout -->
 <section class="checkout " id="form" style="margin-top: 100px;">
     <div class="container">
         <div class="row justify-content-between" style="margin-bottom: 100px;">
             <div class="col-lg-6">
                 <h4 class="mb-4">Perlengkapan yang akan disewa</h4>
                 <?php if ($this->session->flashdata('total_error')) { ?>
                     <?php for ($i = 0; $i < $this->session->flashdata('total_error'); $i++) { ?>
                         <?= $this->session->flashdata('pesan_error' . $i); ?> <br>
                     <?php } ?>
                 <?php } ?>
                 <form action="<?= base_url(); ?>depan/transaksi/updatekeranjang" method="post">

                     <!-- tampil semua yang akan dibeli -->
                     <div id="showKeranjang">

                     </div>

                 </form>

             </div>
             <div class="col-lg-5">
                 <?= $this->session->flashdata('pesan');
                    $this->session->set_flashdata('pesan', ''); ?>
                 <div class="card rounded-0 checkout-detail">
                     <div class="card-body">
                         <h5 class="card-title">Informasi Biaya</h5>

                         <!-- tampil item dan harga -->
                         <div id="showItemKeranjang">

                         </div>


                         <hr>



                         <div class="row mb-3">
                             <div class="col">
                                 <small style="color: #B7B7B7;">Tanggal Mulai Sewa</small><br>
                                 <label for=""><?= date('d/m/Y') ?></label>
                                 <input type="hidden" class="form-control mulai_sewa" value="<?= date('m-d-Y') ?>" name="mulai_sewa" id="mulai_sewa" aria-describedby="helpId" placeholder="">
                                 <!-- <select id="jne" class="custom-select" name="estimasi">
                                 </select> -->
                             </div>
                             <div class="item">

                             </div>

                         </div>

                         <div class="row mb-3">
                             <div class="col-6">
                                 <small style="color: #B7B7B7;">Pengembalian</small>
                                 <input type="date" class="form-control hari" value="" name="hari" id="hari" aria-describedby="helpId" placeholder="">

                                 <!-- <select id="jne" class="custom-select" name="estimasi">
                                 </select> -->
                             </div>
                             <div class="item">

                             </div>
                             <div class="col d-flex justify-content-end label-ongkir">

                                 <!-- <h6 class="m-0 align-self-center text-success"></h6> -->

                             </div>
                         </div>
                         <div class="row mb-3">
                             <div class="col">
                                 <h6 class="m-0">Total Harga</h6>
                             </div>
                             <div class="col d-flex justify-content-end label-total">

                             </div>
                         </div>

                     </div>
                 </div>

                 <div class="row mt-3">
                     <div class="col">
                         <button type="button" class="btn btn-block" data-toggle="modal" data-target="#editInfoPelanggan" style="background-color: #007BFF; color: #FFF;">Edit Informasi</button>
                     </div>



                     <!-- Midtrans -->
                     <form id="payment-form" method="post" action="<?= base_url() ?>depan/penyewaan/finish">
                         <input type="hidden" name="result_type" id="result-type" value="">
                         <input type="hidden" name="result_data" id="result-data" value="">
                     </form>

                     <div class="col" id="pay-jne">
                         <button type="button" id="pay-button" class="btn btn-warning btn-block text-white">Checkout</button>
                     </div>
                 </div>

             </div>
         </div>
     </div>
 </section>
 <!-- Akhir Checkout -->

 <!-- Modal -->
 <form action="<?= base_url(); ?>depan/keranjang/editinfopelanggan" method="post">
     <div class="modal fade" id="editInfoPelanggan" tabindex="-1" role="dialog" aria-labelledby="editInfoPelangganLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="editInfoPelangganLabel">Perlengkapan akan diantar ke alamat berikut...</h5>
                 </div>
                 <div class="modal-body">
                     <div class="form-group">
                         <label for="nama">Nama Lengkap</label>
                         <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama lengkap" value="<?= $pelanggan['nama']; ?>">
                     </div>
                     <div class="form-group">
                         <label for="nm_hp">No Hp</label>
                         <input type="text" class="form-control" id="nm_hp" name="nm_hp" placeholder="Nomor HP" value="<?= $pelanggan['nm_hp'] ?>">
                     </div>
                     <div class="form-group">
                         <label for="">Alamat Distrik</label>
                         <select class="form-control" name="alamat_distrik" id="">
                             <option value="<?= $pelanggan['alamat_distrik'] ?>"> <?= $pelanggan['alamat_distrik'] ?></option>
                             <option value="Jayapura Utara"> Jayapura Utara </option>
                             <option value="Jayapura Selatan"> Jayapura Selatan </option>
                             <option value="Muara Tami">Muara Tami</option>
                             <option value="Heram">Heram</option>
                         </select>
                         <div class="form-group">
                             <label for="alamat">Alamat Jalan</label>
                             <textarea class="form-control" id="alamat" name="alamat_jalan" rows="3"><?= $pelanggan['alamat_jalan'] ?></textarea>
                         </div>
                     </div>
                     <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                         <button type="submit" name="submit" class="btn btn-primary">Ubah</button>
                     </div>
                 </div>
             </div>
         </div>
 </form>