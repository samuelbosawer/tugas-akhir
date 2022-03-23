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
        $data['title'] = 'Beranda';
        $data['detail'] = $this->db->query("SELECT * FROM perlengkapan,tempat_sewa WHERE perlengkapan.id_perlengkapan = '$id' AND tempat_sewa.id_tempat = perlengkapan.id_tempat")->result();
        $this->load->view('tamplates_pelanggan/header', $data);
        $this->load->view('pelanggan/detail-perlengkapan', $data);
        $this->load->view('tamplates_pelanggan/footer');
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
