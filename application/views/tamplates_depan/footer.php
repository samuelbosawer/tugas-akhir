<!-- ======= Footer ======= -->


<div class="">
    <footer id="footer">
        <div class="footer-top">

        </div>

        <div class="container">
            <div class="copyright">
                &copy; Copyright <strong><span>TI FIKOM USTJ</span></strong>. All Rights Reserved
            </div>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/bootslander-free-bootstrap-landing-page-template/ -->
                <!-- Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> -->
            </div>
        </div>
    </footer><!-- End Footer -->
    </>

    <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="<?= base_url() ?>assets/depan/assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/depan/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() ?>assets/depan/assets/vendor/jquery.easing/jquery.easing.min.js"></script>
    <script src="<?= base_url() ?>assets/depan/assets/vendor/php-email-form/validate.js"></script>
    <script src="<?= base_url() ?>assets/depan/assets/vendor/venobox/venobox.min.js"></script>
    <script src="<?= base_url() ?>assets/depan/assets/vendor/waypoints/jquery.waypoints.min.js"></script>
    <script src="<?= base_url() ?>assets/depan/assets/vendor/counterup/counterup.min.js"></script>
    <script src="<?= base_url() ?>assets/depan/assets/vendor/owl.carousel/owl.carousel.min.js"></script>
    <script src="<?= base_url() ?>assets/depan/assets/vendor/aos/aos.js"></script>
    <script src="<?= base_url() ?>assets/depan/assets/js/all.js"></script>

    <script type="text/javascript" src="<?= base_url() ?>assets/rating/js/star-rating.js"></script>
    <script src="<?= base_url() ?>assets/rating/themes/krajee-fa/theme.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>assets/rating/themes/krajee-svg/theme.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>assets/rating/themes/krajee-uni/theme.js" type="text/javascript"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/DataTables/datatables.min.js"></script>

    <!-- Modal Rating -->
    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on('click', '#set', function() {
                var id_sewa = $(this).data('idsewa');
                var nama = $(this).data('nama');
                var idTempat = $(this).data('idtempat');
                $('#id_sewa').val(id_sewa);
                $('#id_tempat').val(idTempat);
                $('#namatempat').text('Tempat penyewaan ' + nama);
            })

        });

        $(document).on('click', '#bayar', function() {
            var nosewa = $(this).data('nosewa')
            var idsewa = $(this).data('id_sewa')


            console.log(idsewa);
            // $('#idsewa').val('trdd');
            // $('#idsewa').text('Id Penyewaan : ' + idsewa);
            $.ajax({
                type: "POST",
                url: '<?= base_url('') ?>depan/beranda/detailbayar',
                data: {
                    id_penyewaan: nosewa,
                    id_sewa: idsewa,
                },
                cache: false,
                success: function(data) {
                    $('#detail').html(data);
                }
            })
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#table_id').DataTable();
        });
    </script>

    <script>
        $(document).ready(function() {
            document.getElementById("pay-button").disabled = true;
            $("#bintang").change(function() {});
        });
    </script>
    <script>
        function myFunction() {
            var x = document.getElementById("input_pencarian");
            kata = x.value;
            console.log(kata);
            $.ajax({
                type: 'POST',
                url: '<?= base_url() ?>depan/beranda/aksi_cari_dua',
                data: {
                    search: kata
                },
                cache: false,
                success: function(data) {
                    $('#box_pencarian').html(data);
                }
            });
        }
    </script>

    <!-- Template Main JS File -->
    <script src="<?= base_url() ?>assets/depan/assets/js/main.js"></script>
    <script>
        $(document).ready(function() {
            tampil_keranjang();

            function tampil_keranjang() {
                $.ajax({
                    type: 'GET',
                    url: '<?= base_url() ?>depan/keranjang/getKeranjang',
                    async: true,
                    dataType: 'json',
                    success: function(data) {
                        var html = '';
                        var item = '';
                        var i;
                        console.log(data);
                        for (i = 0; i < data.length; i++) {




                            if (data[i].stok_sewa == data[i].stok) {
                                disabled = 'disabled';
                            } else {
                                disabled = '';
                            }


                            if (data[i].stok_sewa == 1) {
                                disabled_krg = 'disabled';
                            } else {
                                disabled_krg = '';
                            }
                            html += `
                            <div class="row mb-4">
                                <div class="col-2">
                                    <img src="<?= base_url(); ?>assets/upload/perlengkapan/` + data[i].foto + `" style="width: 50px;">
                                </div>
                                <div class="col-5">
                                    <h5 class="m-0">` + data[i].nama_perlengkapan +
                                `</h5>
                                    <p class="m-0" style="color: #B7B7B7;">Rp. ` + data[i].harga + ` / Hari</p>
                                </div>
                              
                            </div>
                            <div class ="row">
                                <div class="col-6">
                                        <input type="hidden" class="text-center" name="id_perlengkapan[]" value="` + data[i].id_perlengkapan + `" style="width: 3rem">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <button disabled  class="btn btn-sm btn-warning text-dark"  type="button" disabled style=" color: white;" >Stok</button>
                                            </div>
                                            <div class="input-group-prepend">
                                                <button ` + disabled_krg + ` class="btn btn-primary btn-sm jml-kurang" type="button" style=" color: white;" id_perlengkapan_krg="` + data[i].id_perlengkapan + `" jumlah_krg="` + data[i].stok_sewa + `"><i class="fas fa-minus-circle"></i></button>
                                            </div>
                                            <input type="text" id="jml"  id_perlengkapan="` + data[i].id_perlengkapan + `"  onkeypress="return hanyaAngka(event)" class="form-control form-control-sm text-center jml_order" name="jml_order[]" value="` + data[i].stok_sewa + `">
                                            <div class="input-group-append">
                                                <button ` + disabled + ` type="button" class="btn btn-sm btn-success jml-tambah"  id_perlengkapan="` + data[i].id_perlengkapan + `" jumlah="` + data[i].stok_sewa + `"><i class="fas fa-plus-circle"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                <div class="col-1 text-right">
                                    <button type="button" class="btn btn-sm btn-danger hapusperlengkapan" style="color: white;" id_perlengkapan="` + data[i].id_perlengkapan + `"><i class="fas fa-times-circle"></i></button>
                                </div>
                            </div>
                        `;
                            item += `

                                <div class="row mb-3">
                                    <div class="col">
                                        <h6 class="m-0">` + data[i].nama_perlengkapan + `</h6>
                                        <small style="color: #B7B7B7;">` + data[i].stok_sewa + ` buah</small>
                                    </div>
                                    <div class="col d-flex justify-content-end">
                                        <h6 class="m-0 align-self-center text-success">Rp. ` + data[i].stok_sewa * data[i].harga + `</h6>
                                    </div>
                                </div>
                        
                        `;
                        }
                        $('#showKeranjang').html(html);
                        $('#showItemKeranjang').html(item);
                    }
                });
            }


            $('#showKeranjang').on('keyup', '.jml_order', function() {
                $('#hari').val(0).change();
                document.getElementById("pay-button").disabled = true;
                var id_perlengkapan = $(this).attr('id_perlengkapan');
                var jumlah = $(this).val();
                // jumlah = parseInt(jumlah) + 0;
                if (jumlah == '0') {
                    alert('Stok tidak boleh 0 !');
                }
                if (jumlah == '') {
                    alert('Stok tidak boleh kosong !');
                }
                console.log(jumlah);
                console.log(id_perlengkapan);
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('depan/keranjang/updateKeranjang') ?>",
                    dataType: "JSON",
                    data: {
                        id_perlengkapan: id_perlengkapan,
                        jumlah: jumlah
                    },
                    success: function(data) {
                        tampil_keranjang();
                    }
                });
                return false;
            });



            $('#showKeranjang').on('click', '.jml-tambah', function() {
                $('#hari').val(0).change();
                document.getElementById("pay-button").disabled = true;
                var id_perlengkapan = $(this).attr('id_perlengkapan');
                var jumlah = $(this).attr('jumlah');
                jumlah = parseInt(jumlah) + 1;
                // console.log(jumlah);
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('depan/keranjang/updateKeranjang') ?>",
                    dataType: "JSON",
                    data: {
                        id_perlengkapan: id_perlengkapan,
                        jumlah: jumlah
                    },
                    success: function(data) {
                        tampil_keranjang();
                    }
                });
                return false;
            });

            $('#showKeranjang').on('click', '.jml-kurang', function() {
                $('#hari').val(0).change();
                document.getElementById("pay-button").disabled = true;
                var id_perlengkapan = $(this).attr('id_perlengkapan_krg');
                var jumlah = $(this).attr('jumlah_krg');
                jumlah = parseInt(jumlah) - 1;
                // console.log(jumlah);
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('depan/keranjang/updateKeranjang') ?>",
                    dataType: "JSON",
                    data: {
                        id_perlengkapan: id_perlengkapan,
                        jumlah: jumlah
                    },
                    success: function(data) {
                        tampil_keranjang();
                    }
                });
                return false;
            });

            $('#showKeranjang').on('click', '.hapusperlengkapan', function() {
                $('#hari').val(0).change();
                var id_perlengkapan = $(this).attr('id_perlengkapan');
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('depan/keranjang/hapusKeranjang') ?>",
                    dataType: "JSON",
                    data: {
                        id_perlengkapan: id_perlengkapan
                    },
                    success: function(data) {
                        tampil_keranjang();
                    }
                });
                return false;
            });
        });
    </script>

    <script>
        function hanyaAngka(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
            var jml = 1;
            $('#jml_order').val(jml_order);

        }
    </script>

    <script>
        var jml = 1;
        var jml_order = 1;

        $('#btn-tambah').on('click', function() {
            document.getElementById("btn-kurang").disabled = false;

            jml_order = parseInt($('#jml_order').val()) + 1;
            $('#jml_order').val(jml_order);

            if ($('#stok').val() == jml_order) {
                document.getElementById("btn-tambah").disabled = true;
            }

        });

        $('#btn-kurang').on('click', function() {
            document.getElementById("btn-tambah").disabled = false;

            jml_order = parseInt($('#jml_order').val()) - 1;
            if (jml_order == 0) {
                jml_order = 1;
            }
            $('#jml_order').val(jml_order);
        });

        $('#jml_order').on('click', function() {
            jml_order = parseInt($('#jml_order').val()) - 1;
            if (jml_order == 0) {
                jml_order = 1;
            }
            $('#jml_order').val(jml_order);
        });
    </script>

    <script>
        $('#checkoutModal').modal('show');
    </script>

    <script>
        $("input[name=hari]").on("change", function() {
            var hari = document.getElementById("hari").value;
            $.ajax({
                type: 'post',
                url: '<?= base_url('depan/keranjang/labelHarga') ?>',
                data: {
                    hari: hari,
                },
                success: function(hasil_ongkir) {
                    $(".label-ongkir").html(hasil_ongkir);
                }
            });
        });
    </script>
    <script>
        $("input[name=hari]").on("change", function() {
            hari = document.getElementById("hari").value;
            $.ajax({
                type: 'post',
                url: '<?= base_url() ?>depan/keranjang/getTotal',
                data: {
                    hari: hari
                },
                success: function(hasil_cod) {
                    $(".label-total").html(hasil_cod);
                }
            });
        });
    </script>



    <!-- midtrans -->
    <script type="text/javascript">
        $('#pay-button').click(function(event) {
            event.preventDefault();
            // $(this).attr("disabled", "disabled");

            $.ajax({
                url: '<?= base_url() ?>depan/penyewaan/token',
                cache: false,

                success: function(data) {
                    //location = data;

                    console.log('token = ' + data);

                    var resultType = document.getElementById('result-type');
                    var resultData = document.getElementById('result-data');

                    function changeResult(type, data) {
                        $("#result-type").val(type);
                        $("#result-data").val(JSON.stringify(data));
                        //resultType.innerHTML = type;
                        //resultData.innerHTML = JSON.stringify(data);
                    }

                    snap.pay(data, {

                        onSuccess: function(result) {
                            changeResult('success', result);
                            console.log(result.status_message);
                            console.log(result);
                            $("#payment-form").submit();
                        },
                        onPending: function(result) {
                            changeResult('pending', result);
                            console.log(result.status_message);
                            $("#payment-form").submit();
                        },
                        onError: function(result) {
                            changeResult('error', result);
                            console.log(result.status_message);
                            $("#payment-form").submit();
                        }
                    });
                }
            });
        });
    </script>

    <script type="text/javascript">
        $(document).on('keyup', function() {
            $('#search').on('keyup', function() {
                $.ajax({
                    type: 'POST',
                    url: '<?= base_url() ?>depan/beranda/search',
                    data: {
                        search: $(this).val()
                    },
                    cache: false,
                    success: function(data) {
                        $('#tampil').html(data);
                    }
                });
            });
        });
    </script>



    <!-- Modal -->
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Perhatian</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h2> Maaf, Stok Perlengkapan Habis !! </h2>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modelId-dua" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Perhatian</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h2> Akun anda belum falid ! </h2>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    </body>

    </html>