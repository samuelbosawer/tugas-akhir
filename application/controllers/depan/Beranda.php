<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Beranda extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $params = array('server_key' => 'SB-Mid-server-CPFhEb941poDUZmwImeJ-GiQ', 'production' => false);
        $this->load->library('midtrans');
        $this->midtrans->config($params);
        // cek_login_tempat_sewa();
    }
    public function index()
    {
        // $time =  "1625702927";
        // echo "<br>";
        // echo date('Y-m-d', $time);
        // die;
        $data['title'] = 'Beranda';
        $data['perlengkapan'] = $this->db->query("SELECT * FROM login, tempat_sewa, perlengkapan WHERE perlengkapan.kategori = 'perlengkapan' AND login.status_validasi = '1' and login.email = tempat_sewa.email GROUP BY perlengkapan.id_perlengkapan ORDER BY RAND() LIMIT 0, 8 ")->result();

        $data['paket']  = $this->db->query("SELECT * FROM login, tempat_sewa, perlengkapan WHERE perlengkapan.kategori = 'paket' AND login.status_validasi = '1' and login.email = tempat_sewa.email GROUP BY perlengkapan.id_perlengkapan ORDER BY RAND() LIMIT 0, 8   ")->result();

        $data['tempat']  = $this->db->query("SELECT * FROM login, tempat_sewa WHERE login.status_validasi = '1' and login.email = tempat_sewa.email ")->result();

        $data['jumlah'] = $this->db->query("SELECT * FROM perlengkapan, penyewaan WHERE perlengkapan.id_perlengkapan = penyewaan.id_perlengkapan AND  penyewaan.status_pembayaran = 'settlement' AND penyewaan.status_sewa = 1")->result_array();

        $data['pelanggan'] = $this->db->get_where('pelanggan', ['email' => $this->session->userdata('email')])->row_array();
        $data['terdekat'] = '';
        if ($data['pelanggan']) {
            $id_pelanggan = $data['pelanggan']['id_pelanggan'];
            $data['terdekat'] = $this->db->query("SELECT perlengkapan.foto, perlengkapan.stok, perlengkapan.nama_perlengkapan, perlengkapan.harga, perlengkapan.id_perlengkapan, perlengkapan.kategori, tempat_sewa.alamat_distrik FROM  tempat_sewa, perlengkapan, pelanggan WHERE pelanggan.id_pelanggan = '$id_pelanggan' AND tempat_sewa.id_tempat = perlengkapan.id_tempat AND tempat_sewa.alamat_distrik = pelanggan.alamat_distrik GROUP BY perlengkapan.id_perlengkapan  LIMIT 0, 8 ")->result();
        }
        $this->load->view('tamplates_depan/header', $data);
        $this->load->view('tamplates_depan/hero');
        $this->load->view('depan/beranda', $data);
        $this->load->view('tamplates_depan/footer');
    }
    public function cari_dua($kata = null)
    {
        $data['title'] = 'Pencarian';
        $data['kata'] = '';
        if ($this->input->post('search')) {
            $kata = $this->input->post('search');
            $trim = rawurldecode($kata);
        } else {
            $trim = rawurldecode($kata);
        }
        if ($trim) {
            $data['kata'] = $trim;
            $data['perlengkapan'] = $this->db->query("SELECT * FROM login, tempat_sewa, perlengkapan WHERE login.email = tempat_sewa.email  AND login.status_validasi = '1' AND perlengkapan.id_tempat = tempat_sewa.id_tempat AND perlengkapan.nama_perlengkapan LIKE  '%$trim%' ")->result();
        } else {
            $data['perlengkapan'] = $this->db->query("SELECT * FROM login, perlengkapan, tempat_sewa WHERE login.email = tempat_sewa.email AND login.status_validasi = '1' AND perlengkapan.id_tempat = tempat_sewa.id_tempat  ")->result();
        }
        $data['jumlah'] = $this->db->query("SELECT * FROM perlengkapan, penyewaan WHERE perlengkapan.id_perlengkapan = penyewaan.id_perlengkapan AND  penyewaan.status_pembayaran = 'settlement' AND penyewaan.status_sewa = 1")->result_array();

        $this->load->view('tamplates_depan/header', $data);
        $this->load->view('depan/cari-dua', $data);
        $this->load->view('tamplates_depan/footer');
    }
    public function autocomplete()
    {
        $cari = $_GET['term'];
        $result = $this->db->query("SELECT * FROM perlengkapan WHERE nama_perlengkapan LIKE %$cari% ORDER BY nama_perlengkapan ");
        echo json_encode($result);
    }
    public function info()
    {
        cek_login_pelanggan();
        update_laporan();
        $data['title'] = 'Laporan';
        $data['pelanggan'] = $this->db->get_where('pelanggan', ['email' => $this->session->userdata('email')])->row_array();
        $id_pelanggan = $data['pelanggan']['id_pelanggan'];
        $data['penyewaan'] = $this->db->query("SELECT * FROM penyewaan, perlengkapan,tempat_sewa, pelanggan WHERE penyewaan.id_pelanggan =  '$id_pelanggan' AND penyewaan.id_pelanggan = pelanggan.id_pelanggan AND penyewaan.id_perlengkapan = perlengkapan.id_perlengkapan AND perlengkapan.id_tempat = tempat_sewa.id_tempat ORDER BY penyewaan.id_sewa DESC  ")->result();
        $this->load->view('tamplates_depan/header', $data);
        $this->load->view('depan/laporan', $data);
        $this->load->view('tamplates_depan/footer');
    }
    public function aksi_cari_dua()
    {
        echo "<ul id='hasil_pencarian'>";
        $cari = $this->input->post('search');
        if ($cari) {
            $query_pencarian = $this->db->query("SELECT * FROM login, perlengkapan, tempat_sewa WHERE login.email = tempat_sewa.email AND login.status_validasi = '1' AND perlengkapan.id_tempat = tempat_sewa.id_tempat  AND nama_perlengkapan LIKE '%$cari%' GROUP BY perlengkapan.nama_perlengkapan  LIMIT 4")->result_array();
            if ($query_pencarian) {
                foreach ($query_pencarian as $q)
                    echo '<li> <a class="btn" href="' . base_url() . 'depan/beranda/cari_dua/' . $q['nama_perlengkapan'] . '" > ' . $q['nama_perlengkapan'] . ' <a/> </li>';
            } else {
            }
        }
        echo "</ul>";
    }

    public function aksi_ulasan()
    {
        $kode = $this->kode_model->kd_rating_terakhir()->row();
        if ($kode->id_rating != null) {
            $id_rating = $kode->id_rating;
        } else {
            $id_rating = "rtg-0000";
        }
        $no_urut = (int)substr($id_rating, 4, 4);
        $no_urut++;
        $id = "rtg-";

        $id_baru  = $id . sprintf("%04s", $no_urut);
        $id_tempat = $this->input->post('id_tempat');
        $id_pelanggan       = $this->session->userdata('id_pelanggan');
        $id_sewa = $this->input->post('id_sewa');
        $rating = $this->input->post('rating');
        $komentar = $this->input->post('komentar');

        $data = array(
            'id_rating' => $id_baru,
            'id_tempat' => $id_tempat,
            'id_pelanggan' => $id_pelanggan,
            'jumlah_rating' => $rating,
            'komentar' => $komentar,
            'id_sewa' => $id_sewa
        );

        $update = array(
            'status_sewa' => '3'
        );
        $where = array(
            'id_sewa' => $id_sewa
        );


        $this->sewa_model->update_data($update, 'penyewaan', $where);

        $this->sewa_model->insert_data($data, 'rating');
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Terimakasih Telah Memberikan Rating</div>');
        redirect('depan/beranda');
    }

    public function konfirmasi()
    {
        $id_sewa = $this->input->post('id_sewa');
        $status    = $this->input->post('status');
        $update = array(
            'status_sewa' => $status
        );
        $where = array(
            'id_sewa' => $id_sewa
        );


        $this->sewa_model->update_data($update, 'penyewaan', $where);
        redirect('depan/beranda/info');
    }
    public function wilayah_tempat($kata = null)
    {
        $data['title'] = 'Tempat Penyewaan';


        $trim = rawurldecode($kata);

        if ($trim) {

            $data['kata'] = $trim;
            $data['tempat'] = $this->db->query("SELECT * FROM login, tempat_sewa  WHERE login.email = tempat_sewa.email  AND login.status_validasi = '1' AND tempat_sewa.alamat_distrik = '$trim' ")->result();
        }
        $this->load->view('tamplates_depan/header', $data);
        $this->load->view('depan/cari-tempat', $data);
        $this->load->view('tamplates_depan/footer');
    }

    public function rating_tempat()
    {
        $data['title'] = 'Ranting';
        $data['tempat']  = $this->db->query("SELECT * FROM login, tempat_sewa, rating WHERE login.status_validasi = '1' and login.email = tempat_sewa.email AND rating.id_tempat = tempat_sewa.id_tempat GROUP BY rating.id_tempat  ORDER BY rating.jumlah_rating DESC  ")->result();
        $this->load->view('tamplates_depan/header', $data);
        $this->load->view('depan/rating', $data);
        $this->load->view('tamplates_depan/footer');
    }
    public function detailinfo()
    {
        cek_login_pelanggan();
        update_laporan();
        $data['title'] = 'Laporan';
        $id = $this->input->post('id');
        $data['pelanggan'] = $this->db->get_where('pelanggan', ['email' => $this->session->userdata('email')])->row_array();
        $id_pelanggan = $data['pelanggan']['id_pelanggan'];
        $data['penyewaan'] = $this->db->query("SELECT * FROM perlengkapan,  penyewaan, tempat_sewa, pelanggan WHERE penyewaan.id_pelanggan =  '$id_pelanggan' AND penyewaan.id_pelanggan = pelanggan.id_pelanggan AND penyewaan.id_perlengkapan = perlengkapan.id_perlengkapan AND perlengkapan.id_tempat = tempat_sewa.id_tempat AND penyewaan.id_sewa = '$id' ORDER BY penyewaan.id_sewa DESC  ")->result();
        $this->load->view('tamplates_depan/header', $data);
        $this->load->view('depan/laporan', $data);
        $this->load->view('tamplates_depan/footer');
    }
    public function detailbayar()
    {
        $id = $this->input->post('id_penyewaan');
        $id_sewa = $this->input->post('id_sewa');
        $hasil =  $this->midtrans->status($id);
            if($hasil->transaction_status == 'pending'){
                $hasil->settlement_time = '-';
            }
        $dataTempat= $this->db->query("SELECT * FROM perlengkapan,  penyewaan, tempat_sewa WHERE penyewaan.id_perlengkapan = perlengkapan.id_perlengkapan AND perlengkapan.id_tempat = tempat_sewa.id_tempat AND penyewaan.id_sewa = '$id_sewa' ORDER BY penyewaan.id_sewa DESC  ")->result();
     if($hasil->payment_type == 'bank_transfer'){
        foreach ($hasil->va_numbers as $va){
            echo '
            <div class="row m-3">
                <div class="col">
                    <h3>Pembayaran</h3>
                        <table>
                            <tr>
                                <td>Bank</td>
                                <td>:</td>
                                <td>'.  $va->bank .' </td>
                            </tr>
                            <tr>
                                <td>No. Rek</td>
                                <td>:</td>
                                <td>'.  $va->va_number .' </td>
                            </tr>
                            <tr>
                            <td>Jumlah Yang dibayar</td>
                            <td>:</td>
                            <td>Rp. '.  number_format($hasil->gross_amount) .' </td>
                        </tr>
                            <tr>
                                <td>Waktu Penyewaan</td>
                                <td>:</td>
                                <td>'.  $hasil->transaction_time .' </td>
                            </tr>
                            <tr>
                                <td>Tipe Pembayaran</td>
                                <td>:</td>
                                <td>'.  $hasil->payment_type .' </td>
                            </tr>
                            <tr>
                              <td>Status</td>
                              <td>:</td>
                              <td>'.  $hasil->transaction_status.' </td>
                            </tr>
                            <tr>
                            <td>Waktu pembayaran</td>
                            <td>:</td>
                            <td>'.  $hasil->settlement_time.' </td>
                          </tr>
                        </table>
                </div>
            </div>
           
            ';
        }
     }
     

     if($hasil->payment_type == 'gopay'){
       
            echo '
            <div class="row m-3">
                <div class="col">
                    <h3>Pembayaran</h3>
                        <table>
                            <tr>
                            <td>Jumlah Yang dibayar</td>
                            <td>:</td>
                            <td>Rp. '.  number_format($hasil->gross_amount) .' </td>
                        </tr>
                            <tr>
                                <td>Waktu Penyewaan</td>
                                <td>:</td>
                                <td>'.  $hasil->transaction_time .' </td>
                            </tr>
                            <tr>
                                <td>Tipe Pembayaran</td>
                                <td>:</td>
                                <td>'.  $hasil->payment_type .' </td>
                            </tr>
                            <tr>
                              <td>Status</td>
                              <td>:</td>
                              <td>'.  $hasil->transaction_status.' </td>
                            </tr>
                            <tr>
                            <td>Waktu pembayaran</td>
                            <td>:</td>
                            <td>'.  $hasil->settlement_time.' </td>
                          </tr>
                        </table>
                </div>
            </div>
            ';
     }
      
        foreach ($dataTempat as $dt){
            echo '
            <div class="row m-3">
                <div class="col">
                    <h3>Data Tempat</h3>
                        <table>
                            <tr>
                                <td>Nama Tempat</td>
                                <td>:</td>
                                <td>'.  $dt->nama_tempat .' </td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>:</td>
                                <td>'.  $dt->alamat_jalan .', '.  $dt->alamat_distrik.' </td>
                            </tr>
                            <tr>
                        <td>Nomor HP</td>
                            <td>:</td>
                            <td>'.  $dt->nm_hp .' </td>
                        </tr>
                        <td>Email</td>
                        <td>:</td>
                        <td>'.  $dt->email .' </td>
                    </tr>
                        </table>
                </div>
            </div>
           
            ';
        }
        

      
    }
}
