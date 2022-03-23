<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        cek_login_tempat_sewa();
    }
    public function index()
    {
        $data['title'] = 'Dashboard';
        $id = $this->session->userdata('id_tempat');
        $email = $this->session->userdata('email');
        $data['perlengkapan'] = count($this->db->query("SELECT * FROM perlengkapan WHERE id_tempat = '$id' and kategori = 'perlengkapan'")->result());
        $data['paket'] = count($this->db->query("SELECT * FROM perlengkapan WHERE id_tempat = '$id' and kategori = 'paket'")->result());
        $data['sewa'] =  count($this->db->query("SELECT * FROM penyewaan, perlengkapan, tempat_sewa, pelanggan WHERE perlengkapan.id_tempat = '$id' AND penyewaan.id_pelanggan = pelanggan.id_pelanggan AND penyewaan.id_perlengkapan = perlengkapan.id_perlengkapan AND perlengkapan.id_tempat = tempat_sewa.id_tempat ORDER BY penyewaan.id_sewa DESC  ")->result());
        $data['pendapatan'] = $this->db->query("SELECT * FROM pendapatan, penyewaan, perlengkapan WHERE pendapatan.id_sewa = penyewaan.id_sewa AND penyewaan.status_pembayaran = 'settlement' AND perlengkapan.id_perlengkapan = penyewaan.id_perlengkapan AND perlengkapan.id_tempat = '$id'  ")->result();

        $data['rating'] = $this->db->query("SELECT * FROM rating, pelanggan, penyewaan, tempat_sewa WHERE penyewaan.id_sewa = rating.id_sewa AND rating.id_pelanggan = pelanggan.id_pelanggan AND  rating.id_tempat = '$id' ")->result();

        $data['validasi'] = $this->db->query("SELECT * FROM login WHERE email = '$email'")->result();

        $this->load->view('tamplates_admin/header', $data);
        $this->load->view('tamplates_ts/sidebar');
        $this->load->view('tempat-sewa/dashboard', $data);
        $this->load->view('tamplates_admin/footer');
    }
}
