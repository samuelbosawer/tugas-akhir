<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ranting extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('star_model');
        // cek_login_tempat_sewa();
    }
    public function index()
    {
        // $data['pelanggan'] = $this->db->get_where('pelanggan', ['email' => $this->session->userdata('email')])->row_array();
        // $id_pelanggan = $data['pelanggan']['id_pelanggan'];

        $q = $this->db->query("SELECT jumlah_rating FROM rating")->row_array();

        foreach ($q as $qe) {
        }
        $data['hasil'] = $qe;
        // $data['cek']    = $this->db->query("SELECT * FROM rating WHERE id_pelanggan = '$id_pelanggan'");

        $this->load->view('tamplates_depan/ranting', $data);
    }
    public function proses()
    {
        if ($this->input->post('rate')) {
        }
    }
    public function fetch()
    {
        $data = $this->star_model->html_output();
    }
}
