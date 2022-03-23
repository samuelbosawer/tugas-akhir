<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rating extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        cek_login_tempat_sewa();
    }
    public function index()
    {
        $data['title'] = 'Laporan Ranting';
        $id = $this->session->userdata('id_tempat');
        $data['rating'] = $this->db->query("SELECT * FROM rating, pelanggan, penyewaan, tempat_sewa WHERE penyewaan.id_sewa = rating.id_sewa AND rating.id_pelanggan = pelanggan.id_pelanggan AND rating.id_tempat = tempat_sewa.id_tempat AND rating.id_tempat = '$id' ")->result();
        $this->load->view('tamplates_admin/header', $data);
        $this->load->view('tamplates_ts/sidebar');
        $this->load->view('admin/laporan-rating', $data);
        $this->load->view('tamplates_admin/footer');
    }
    public function cetak()
    {
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');
        $data['pelanggan'] = $this->db->get_where('tempat_sewa', ['email' => $this->session->userdata('email')])->row_array();
        $id = $data['pelanggan']['id_tempat'];
        if ($bulan != '') {
            $b = date('m', strtotime($bulan));
            $y = date('Y', strtotime($bulan));
            $data['penyewaan'] = $this->db->query("SELECT * FROM penyewaan, perlengkapan, tempat_sewa, pelanggan WHERE penyewaan.id_pelanggan = pelanggan.id_pelanggan AND penyewaan.id_perlengkapan = perlengkapan.id_perlengkapan AND perlengkapan.id_tempat = tempat_sewa.id_tempat AND penyewaan.status_pembayaran = 'settlement' AND MONTH(penyewaan.mulai_sewa) = '$bulan' AND tempat_sewa.id_tempat = '$id' ORDER BY penyewaan.id_sewa DESC  ")->result();
        } elseif ($tahun != '') {
            $data['penyewaan'] = $this->db->query("SELECT * FROM penyewaan, perlengkapan, tempat_sewa, pelanggan WHERE penyewaan.id_pelanggan = pelanggan.id_pelanggan AND penyewaan.id_perlengkapan = perlengkapan.id_perlengkapan AND perlengkapan.id_tempat = tempat_sewa.id_tempat AND penyewaan.status_pembayaran = 'settlement' AND YEAR(penyewaan.mulai_sewa) = '$tahun' AND tempat_sewa.id_tempat = '$id' ORDER BY penyewaan.id_sewa DESC  ")->result();
        } else {
            $data['penyewaan'] = $this->db->query("SELECT * FROM penyewaan, perlengkapan, tempat_sewa, pelanggan WHERE penyewaan.id_pelanggan = pelanggan.id_pelanggan AND penyewaan.id_perlengkapan = perlengkapan.id_perlengkapan AND perlengkapan.id_tempat = tempat_sewa.id_tempat AND penyewaan.status_pembayaran = 'settlement' AND tempat_sewa.id_tempat = '$id' ORDER BY penyewaan.id_sewa DESC  ")->result();
        };

        $mpdf = new \Mpdf\Mpdf();
        $cetak =   $this->load->view('admin/cetak_penyewaan_banyak', $data, true);
        $mpdf->WriteHTML($cetak);
        $mpdf->Output();
    }
}
