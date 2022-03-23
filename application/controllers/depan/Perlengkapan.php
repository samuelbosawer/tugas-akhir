<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Perlengkapan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // cek_login_tempat_sewa();
    }
    public function detail($id)
    {
        $data['title'] = 'Detail';
        $data['jumlah'] = $this->db->query("SELECT * FROM perlengkapan, penyewaan WHERE perlengkapan.id_perlengkapan = penyewaan.id_perlengkapan AND  penyewaan.status_pembayaran = 'settlement' AND penyewaan.status_sewa = 1")->result_array();
        $data['detail'] = $this->db->query("SELECT * FROM perlengkapan,tempat_sewa WHERE perlengkapan.id_perlengkapan = '$id' AND tempat_sewa.id_tempat = perlengkapan.id_tempat")->result();
        $this->load->view('tamplates_depan/header', $data);
        $this->load->view('depan/detail-perlengkapan', $data);
        $this->load->view('tamplates_depan/footer');
    }
    public function keranjang($id)
    {
        $data['title'] = 'Keranjang';
        $data['detail'] = $this->db->query("SELECT * FROM perlengkapan,tempat_sewa WHERE perlengkapan.id_perlengkapan = '$id' AND tempat_sewa.id_tempat = perlengkapan.id_tempat")->result();
        $this->load->view('tamplates_pelanggan/header', $data);
        $this->load->view('pelanggan/keranjang', $data);
        $this->load->view('tamplates_pelanggan/footer');
    }
}
