<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pendapatan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        cek_login_tempat_sewa();
    }
    public function index()
    {
        $data['title'] = 'Laporan Pendapatan';
        $id = $this->session->userdata('id_tempat');
        $data['pendapatan'] = $this->db->query("SELECT * FROM pendapatan, penyewaan, perlengkapan WHERE pendapatan.id_sewa = penyewaan.id_sewa AND penyewaan.status_pembayaran = 'settlement' AND penyewaan.status_sewa = '2' AND perlengkapan.id_perlengkapan = penyewaan.id_perlengkapan AND perlengkapan.id_tempat = '$id'  ")->result();
        $this->load->view('tamplates_admin/header', $data);
        $this->load->view('tamplates_ts/sidebar');
        $this->load->view('admin/laporan-pendapatan', $data);
        $this->load->view('tamplates_admin/footer');
    }
    public function cetak_pemasukan()
    {
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');
        $id = $this->session->userdata('id_tempat');
        if ($bulan != '') {
            $b = date('m', strtotime($bulan));
            $y = date('Y', strtotime($bulan));
            $data['pendapatan'] = $this->db->query("SELECT * FROM pendapatan, penyewaan, perlengkapan WHERE MONTH(pendapatan.tanggal) = '$b' AND YEAR(tanggal) = '$y' AND penyewaan.status_pembayaran = 'settlement' AND perlengkapan.id_perlengkapan = penyewaan.id_perlengkapan AND perlengkapan.id_tempat = '$id' ")->result();
        } elseif ($tahun != '') {
            $data['pendapatan'] = $this->db->query("SELECT * FROM pendapatan, penyewaan, perlengkapan WHERE YEAR(pendapatan.tanggal) = '$tahun' AND penyewaan.status_pembayaran = 'settlement' AND perlengkapan.id_perlengkapan = penyewaan.id_perlengkapan AND perlengkapan.id_tempat = '$id' ")->result();
        } else {
            $data['pendapatan'] = $this->db->query("SELECT * FROM pendapatan, penyewaan, perlengkapan WHERE pendapatan.id_sewa = penyewaan.id_sewa AND penyewaan.status_pembayaran = 'settlement' AND perlengkapan.id_perlengkapan = penyewaan.id_perlengkapan AND perlengkapan.id_tempat = '$id' ")->result();
        };

        $mpdf = new \Mpdf\Mpdf();
        $cetak =   $this->load->view('admin/cetak_pendapatan', $data, true);
        $mpdf->WriteHTML($cetak);
        $mpdf->Output();
    }
}
