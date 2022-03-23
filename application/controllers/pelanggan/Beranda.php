<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Beranda extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // cek_login_tempat_sewa();
    }
    public function index()
    {
        $data['title'] = 'Beranda';
        $data['perlengkapan'] = $this->sewa_model->get_data('perlengkapan')->result();
        $data['paket'] = $this->sewa_model->get_data('paket')->result();
        $data['tempat'] = $this->sewa_model->get_data('tempat_sewa')->result();
        $this->load->view('tamplates_pelanggan/header', $data);
        $this->load->view('tamplates_pelanggan/carousel');
        $this->load->view('pelanggan/beranda', $data);
        $this->load->view('tamplates_pelanggan/footer');
    }
}
