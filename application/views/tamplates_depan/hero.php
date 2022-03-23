<!-- ======= Hero Section ======= -->
<section id="hero">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 pt-5 pt-lg-0 order-2 order-lg-1 d-flex align-items-center">
                <div data-aos="zoom-out">
                    <h1>AYO SEWA <span>Perlengkapan</span></h1>
                    <h2>Area Kota Jayapura</h2>
                    <form action="<?= base_url() ?>depan/beranda/cari_dua" method="POST">
                        <div class="text-center text-lg-left">
                            <div class="input-group input_div_beranda" data-aos="fade-up">
                                <input type="text" value="" class=" form-control" autocomplete="off" id="input_pencarian" onkeyup="myFunction()" name="search" placeholder="Kata kunci">
                                <div class="input-group-append">
                                    <button class="btn btn-warning text-dark" type="submit">Cari</button>
                                </div>
                            </div>
                            <div id="box_pencarian"></div>
                        </div>
                    </form>
                    <br><br>
                    <?= $this->session->flashdata('pesan');
                    $this->session->set_flashdata('pesan', '');
                    ?>
                    <?= $this->session->flashdata('bayar');
                    $this->session->set_flashdata('bayar', '');
                    ?>
                </div>
            </div>
            <div class="col-lg-5 order-1 order-lg-2 hero-img" data-aos="zoom-out" data-aos-delay="300">
                <img src="<?= base_url() ?>assets/depan/assets/img/hero-img.png" class="img-fluid animated" alt="">
            </div>
        </div>

    </div>
    </div>
    <br><br><br>
    <svg class="hero-waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28 " preserveAspectRatio="none">
        <defs>
            <path id="wave-path" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z">
        </defs>
        <g class="wave1">
            <use xlink:href="#wave-path" x="50" y="3" fill="rgba(255,255,255, .1)">
        </g>
        <g class="wave2">
            <use xlink:href="#wave-path" x="50" y="0" fill="rgba(255,255,255, .2)">
        </g>
        <g class="wave3">
            <use xlink:href="#wave-path" x="50" y="9" fill="#fff">
        </g>
    </svg>

</section><!-- End Hero -->

<?= $this->session->flashdata('bayar');
$this->session->set_flashdata('bayar', '');
?>