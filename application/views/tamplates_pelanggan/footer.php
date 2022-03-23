  <!-- footer -->
  <div class="footer">
      <div class="footer_agile_inner_info_w3l">
          <div class="col-md-3 footer-left">
              <h2><a href="index.html"><span>E</span>lite Shoppy </a></h2>
              <p>Lorem ipsum quia dolor
                  sit amet, consectetur, adipisci velit, sed quia non
                  numquam eius modi tempora.</p>
              <ul class="social-nav model-3d-0 footer-social w3_agile_social two">
                  <li><a href="#" class="facebook">
                          <div class="front"><i class="fa fa-facebook" aria-hidden="true"></i></div>
                          <div class="back"><i class="fa fa-facebook" aria-hidden="true"></i></div>
                      </a></li>
                  <li><a href="#" class="twitter">
                          <div class="front"><i class="fa fa-twitter" aria-hidden="true"></i></div>
                          <div class="back"><i class="fa fa-twitter" aria-hidden="true"></i></div>
                      </a></li>
                  <li><a href="#" class="instagram">
                          <div class="front"><i class="fa fa-instagram" aria-hidden="true"></i></div>
                          <div class="back"><i class="fa fa-instagram" aria-hidden="true"></i></div>
                      </a></li>
                  <li><a href="#" class="pinterest">
                          <div class="front"><i class="fa fa-linkedin" aria-hidden="true"></i></div>
                          <div class="back"><i class="fa fa-linkedin" aria-hidden="true"></i></div>
                      </a></li>
              </ul>
          </div>
          <div class="col-md-9 footer-right">
              <div class="sign-grds">
                  <div class="col-md-4 sign-gd">
                      <h4>Our <span>Information</span> </h4>
                      <ul>
                          <li><a href="index.html">Home</a></li>
                          <li><a href="mens.html">Men's Wear</a></li>
                          <li><a href="womens.html">Women's wear</a></li>
                          <li><a href="about.html">About</a></li>
                          <li><a href="typography.html">Short Codes</a></li>
                          <li><a href="contact.html">Contact</a></li>
                      </ul>
                  </div>

                  <div class="col-md-5 sign-gd-two">
                      <h4>Store <span>Information</span></h4>
                      <div class="w3-address">
                          <div class="w3-address-grid">
                              <div class="w3-address-left">
                                  <i class="fa fa-phone" aria-hidden="true"></i>
                              </div>
                              <div class="w3-address-right">
                                  <h6>Phone Number</h6>
                                  <p>+1 234 567 8901</p>
                              </div>
                              <div class="clearfix"> </div>
                          </div>
                          <div class="w3-address-grid">
                              <div class="w3-address-left">
                                  <i class="fa fa-envelope" aria-hidden="true"></i>
                              </div>
                              <div class="w3-address-right">
                                  <h6>Email Address</h6>
                                  <p>Email :<a href="mailto:example@email.com"> mail@example.com</a></p>
                              </div>
                              <div class="clearfix"> </div>
                          </div>
                          <div class="w3-address-grid">
                              <div class="w3-address-left">
                                  <i class="fa fa-map-marker" aria-hidden="true"></i>
                              </div>
                              <div class="w3-address-right">
                                  <h6>Location</h6>
                                  <p>Broome St, NY 10002,California, USA.

                                  </p>
                              </div>
                              <div class="clearfix"> </div>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-3 sign-gd flickr-post">
                      <h4>Flickr <span>Posts</span></h4>
                      <ul>
                          <li><a href="single.html"><img src="images/t1.jpg" alt=" " class="img-responsive" /></a></li>
                          <li><a href="single.html"><img src="images/t2.jpg" alt=" " class="img-responsive" /></a></li>
                          <li><a href="single.html"><img src="images/t3.jpg" alt=" " class="img-responsive" /></a></li>
                          <li><a href="single.html"><img src="images/t4.jpg" alt=" " class="img-responsive" /></a></li>
                          <li><a href="single.html"><img src="images/t1.jpg" alt=" " class="img-responsive" /></a></li>
                          <li><a href="single.html"><img src="images/t2.jpg" alt=" " class="img-responsive" /></a></li>
                          <li><a href="single.html"><img src="images/t3.jpg" alt=" " class="img-responsive" /></a></li>
                          <li><a href="single.html"><img src="images/t2.jpg" alt=" " class="img-responsive" /></a></li>
                          <li><a href="single.html"><img src="images/t4.jpg" alt=" " class="img-responsive" /></a></li>
                      </ul>
                  </div>
                  <div class="clearfix"></div>
              </div>
          </div>
          <div class="clearfix"></div>

      </div>
  </div>
  <!-- //footer -->


  <a href="#home" class="scroll" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>

  <!-- js -->
  <script type="text/javascript" src="<?= base_url() ?>assets/pelanggan/js/jquery-2.1.4.min.js"></script>
  <!-- //js -->
  <script src="<?= base_url() ?>assets/pelanggan/js/modernizr.custom.js"></script>
  <!-- Custom-JavaScript-File-Links -->
  <!-- cart-js -->
  <script src="<?= base_url() ?>assets/pelanggan/js/minicart.min.js"></script>
  <script>
      // Mini Cart
      paypal.minicart.render({
          action: '#'
      });

      if (~window.location.search.indexOf('reset=true')) {
          paypal.minicart.reset();
      }
  </script>

  <!-- //cart-js -->
  <!-- script for responsive tabs -->
  <script src="<?= base_url() ?>assets/pelanggan/js/easy-responsive-tabs.js"></script>
  <script>
      $(document).ready(function() {
          $('#horizontalTab').easyResponsiveTabs({
              type: 'default', //Types: default, vertical, accordion           
              width: 'auto', //auto or any width like 600px
              fit: true, // 100% fit in a container
              closed: 'accordion', // Start closed if in accordion view
              activate: function(event) { // Callback function if tab is switched
                  var $tab = $(this);
                  var $info = $('#tabInfo');
                  var $name = $('span', $info);
                  $name.text($tab.text());
                  $info.show();
              }
          });
          $('#verticalTab').easyResponsiveTabs({
              type: 'vertical',
              width: 'auto',
              fit: true
          });
      });
  </script>
  <!-- //script for responsive tabs -->
  <!-- stats -->
  <script src="<?= base_url() ?>assets/pelanggan/js/jquery.waypoints.min.js"></script>
  <script src="<?= base_url() ?>assets/pelanggan/js/jquery.countup.js"></script>
  <script>
      $('.counter').countUp();
  </script>
  <!-- //stats -->
  <!-- start-smoth-scrolling -->
  <script type="text/javascript" src="<?= base_url() ?>assets/pelanggan/js/move-top.js"></script>
  <script type="text/javascript" src="<?= base_url() ?>assets/pelanggan/js/jquery.easing.min.js"></script>
  <script type="text/javascript">
      jQuery(document).ready(function($) {
          $(".scroll").click(function(event) {
              event.preventDefault();
              $('html,body').animate({
                  scrollTop: $(this.hash).offset().top
              }, 1000);
          });
      });
  </script>
  <!-- here stars scrolling icon -->
  <script type="text/javascript">
      $(document).ready(function() {
          /*
          	var defaults = {
          	containerID: 'toTop', // fading element id
          	containerHoverID: 'toTopHover', // fading element hover id
          	scrollSpeed: 1200,
          	easingType: 'linear' 
          	};
          */

          $().UItoTop({
              easingType: 'easeOutQuart'
          });

      });
  </script>
  <!-- //here ends scrolling icon -->


  <!-- for bootstrap working -->
  <script type="text/javascript" src="<?= base_url() ?>assets/pelanggan/js/bootstrap.js"></script>
  <script type="text/javascript" src="<?= base_url() ?>assets/pelanggan/js/myscript5.js"></script>



  <!-- Keranjang -->
  <script>
      $(document).ready(function() {
          tampil_keranjang();

          function tampil_keranjang() {
              $.ajax({
                  type: 'GET',
                  url: '<?= base_url() ?>pelanggan/keranjang/getKeranjang',
                  async: true,
                  dataType: 'json',
                  success: function(data) {
                      var html = '';
                      var item = '';
                      var i;
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
                                <div class="col-4">
                                    <h5 class="m-0">` + data[i].nama_perlengkapan +
                              `</h5>
                                    <p class="m-0" style="color: #B7B7B7;">Rp. ` + data[i].harga + `</p>
                                </div>
                                <div class="col-1">

                                    

                                    <input type="hidden" class="text-center" name="id_perlengkapan[]" value="` + data[i].id_perlengkapan + `" style="width: 3rem">

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <button ` + disabled_krg + `  class="btn btn-sm btn-warning stok_sewa-kurang" type="button"  id_perlengkapan_krg="` + data[i].id_perlengkapan + `" jumlah_krg="` + data[i].stok_sewa + `"><i class="fa fa-minus-circle"></i></button>
                                        </div>
                                        <input type="text" class="form-control form-control-sm text-center stok_sewa_order" name="stok_sewa_order[]" value="` + data[i].stok_sewa + `">
                                        <div class="input-group-append">
                                            <button ` + disabled + ` type="button" class="btn btn-sm btn-success stok_sewa-tambah"  id_perlengkapan="` + data[i].id_perlengkapan + `" jumlah="` + data[i].stok_sewa + `"><i class="fa fa-plus-circle"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3 text-right">
                                    <button type="button" class="btn btn-sm btn-danger hapusperlengkapan" style="color: white;" id_perlengkapan="` + data[i].id_perlengkapan + `"><i class="fa fa-times-circle"></i></button>
                                </div>
                            </div>
                        `;
                          item += `

                                <div class="row mb-3">
                                    <div class="col">
                                        <h6 class="m-0">` + data[i].nama_perlengkapan + `</h6>
                                        <small style="color: #B7B7B7;">` + data[i].stok_sewa + ` items</small>
                                    </div>
                                    <div class="col d-flex justify-content-end">
                                        <h6 class="m-0 align-self-center text-success">Rp. ` + data[i].stok_sewa * data[i].harga_jual + `</h6>
                                    </div>
                                </div>
                        
                        `;
                      }
                      $('#showKeranjang').html(html);
                      $('#showItemKeranjang').html(item);
                  }

              });
          }
          $('#showKeranjang').on('click ', '.stok_sewa-tambah', function() {

              $('#jne').val(0).change();
              //   $('#cod').val(0).change();
              document.getElementById("pay-button").disabled = true;
              //   document.getElementById("pay-cod").disabled = true;
              var id_perlengkapan = $(this).attr('id_perlengkapan');
              var jumlah = $(this).attr('jumlah');
              console.log(jumlah);
              $.ajax({
                  type: "POST",
                  url: "<?= base_url('pelanggan/keranjang/updateKeranjang') ?>",
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
          $('#showKeranjang').on('click', '.stok_sewa-kurang', function() {
              //   $('#jne').val(0).change();
              //   $('#cod').val(0).change();
              document.getElementById("pay-button").disabled = true;
              document.getElementById("button-cod").disabled = true;

              var id_perlengkapan = $(this).attr('id_perlengkapan_krg');
              var jumlah = $(this).attr('jumlah_krg');
              jumlah = parseInt(jumlah) - 1;
              console.log(jumlah);
              $.ajax({
                  type: "POST",
                  url: "<?= base_url('pelanggan/keranjang/updateKeranjang') ?>",
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
          $('#showKeranjang').on('click', 'hapusperlengkapan', function() {
              var id_perlengkapan = $(this).attr('id_perlengkapan');
              $.ajax({
                  type: "POST".id_perlengkapan,
                  url: "<?= base_url('pelanggan/keranjang/hapusKeranjang') ?>",
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
      var jml = 1;
      var stok_sewa_order = 1;

      $('#btn-tambah').on('click', function() {
          document.getElementById("btn-kurang").disabled = false;

          stok_sewa_order = parseInt($('#stok_sewa_order').val()) + 1;
          $('#stok_sewa_order').val(stok_sewa_order);

          if ($('#stok').val() == stok_sewa_order) {
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
  </script>

  </body>

  </html>