<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penyewaan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        cek_login_tempat_sewa();
        $this->load->config('midtrans', TRUE);
        $params = $this->config->item('midtrans_server_key', 'midtrans');
        $this->load->library('midtrans');
        $this->midtrans->config($params);
    }
    public function index()
    {
        update_laporan();
        $data['title'] = 'Laporan penyewaan';
        $data['pelanggan'] = $this->db->get_where('tempat_sewa', ['email' => $this->session->userdata('email')])->row_array();
        $id_pelanggan = $data['pelanggan']['id_tempat'];
        $data['penyewaan'] = $this->db->query("SELECT * FROM penyewaan, perlengkapan, tempat_sewa, pelanggan WHERE perlengkapan.id_tempat = '$id_pelanggan' AND penyewaan.id_pelanggan = pelanggan.id_pelanggan AND penyewaan.id_perlengkapan = perlengkapan.id_perlengkapan AND perlengkapan.id_tempat = tempat_sewa.id_tempat ORDER BY penyewaan.id_sewa DESC  ")->result();
        $this->load->view('tamplates_admin/header', $data);
        $this->load->view('tamplates_ts/sidebar');
        $this->load->view('tempat-sewa/penyewaan', $data);
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

    public function datapenyewaan()
    {
        update_laporan();
        $data['title'] = 'Laporan Penyewaan';
        $data['pelanggan'] = $this->db->get_where('tempat_sewa', ['email' => $this->session->userdata('email')])->row_array();
        $id_pelanggan = $data['pelanggan']['id_tempat'];
        $data['penyewaan'] = $this->db->query("SELECT * FROM penyewaan, perlengkapan, tempat_sewa, pelanggan WHERE  tempat_sewa.id_tempat ='$id_pelanggan' AND penyewaan.id_pelanggan = pelanggan.id_pelanggan AND penyewaan.id_perlengkapan = perlengkapan.id_perlengkapan AND perlengkapan.id_tempat = tempat_sewa.id_tempat ORDER BY penyewaan.id_sewa DESC  ")->result();

        $this->load->view('tamplates_admin/header', $data);
        $this->load->view('tamplates_ts/sidebar');
        $this->load->view('tempat-sewa/data-penyewaan', $data);
        $this->load->view('tamplates_admin/footer');
    }

    public function detail($id = null)
    {
        update_laporan();
        $data['title'] = 'Detail Penyewaan';
        $data['pelanggan'] = $this->db->get_where('tempat_sewa', ['email' => $this->session->userdata('email')])->row_array();
        $id_pelanggan = $data['pelanggan']['id_tempat'];
        $data['penyewaan'] = $this->db->query("SELECT * FROM penyewaan, tempat_sewa, pelanggan,  perlengkapan WHERE penyewaan.id_sewa = '$id' AND  tempat_sewa.id_tempat ='$id_pelanggan' AND penyewaan.id_pelanggan = pelanggan.id_pelanggan AND penyewaan.id_perlengkapan = perlengkapan.id_perlengkapan AND perlengkapan.id_tempat = tempat_sewa.id_tempat ORDER BY penyewaan.id_sewa DESC  ")->result();

        $this->load->view('tamplates_admin/header', $data);
        $this->load->view('tamplates_ts/sidebar');
        $this->load->view('tempat-sewa/detail-penyewaan', $data);
        $this->load->view('tamplates_admin/footer');
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
        redirect('tempat-sewa/penyewaan/datapenyewaan');
    }
}
