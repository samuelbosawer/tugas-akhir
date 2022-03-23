<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        cek_login_pelanggan();
    }
    public function keranjang()
    {
        if ($this->session->userdata('hak_akses') != 3) {
            redirect('depan/beranda');
        };
        $data['title'] = 'Keranjang';
        $data['pelanggan'] = $this->db->get_where('pelanggan', ['email' => $this->session->userdata('email')])->row_array();
        $id_pelanggan = $data['pelanggan']['id_pelanggan'];

        $query = "SELECT * FROM perlengkapan, keranjang WHERE perlengkapan.id_perlengkapan = keranjang.id_perlengkapan AND keranjang.id_pelanggan = '$id_pelanggan' GROUP BY perlengkapan.id_perlengkapan";
        $data['ranjang'] = $this->db->query($query)->result_array();

        // Cek apakah barang masih tersedia atau sudah dibeli nanti akan terhapus otomatis
        if ($data['ranjang']) {
            foreach ($data['ranjang'] as $r) {
                if ($r['stok_sewa'] > $r['stok']) {
                    $this->db->set('stok_sewa', $r['stok']);
                    $this->db->where('id_perlengkapan', $r['id_perlengkapan']);
                    $this->db->where('id_pelanggan', $id_pelanggan);
                    $this->db->update('ranjang');
                    redirect('depan/transaksi/keranjang');
                }
            }
            $this->load->view('tamplates_depan/header', $data);
            $this->load->view('depan/keranjang', $data);
            $this->load->view('tamplates_depan/footer');
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
           Keranjang masih kosong !
        </div>');
            redirect('depan/beranda');
        }
    }
    public function updatekeranjang()
    {
        $data['title'] = 'Keranjang';
        $pelanggan = $this->db->get_where('pelanggan', ['email' => $this->session->userdata('email')])->row_array();

        $id_pelanggan = $pelanggan['id_pelanggan'];


        $jml_order = $this->input->post('jml_order');
        $id_perlengkapan = $this->input->post('id_perlengkapan');

        $keranjang = $this->db->query("SELECT perlengkapan, keranjang from perlengkapan, keranjang where perlengkapan.id_perlengkapan = keranjang.id_perlengkapan AND keranjang.id_pelanggan = '$id_pelanggan' ")->result_array();




        for ($k = 0; $k < count($jml_order); $k++) {
            if ($jml_order[$k] > $keranjang[$k]['stok']) {
                $this->session->set_flashdata('pesan_error' . $k, '<small class="text-danger">stok maksimum dari ' . $keranjang[$k]['nama_perlengkapan'] . ' berjumlah ' . $keranjang[$k]['stok'] . '</small>');
                $total_error[] = $keranjang[$k]['stok'];
            }

            if ($jml_order[$k] < 1) {
                $this->session->set_flashdata('pesan_error' . $k, '<small class="text-danger">jumlah pesanan dari ' . $keranjang[$k]['nama_perlengkapan'] . ' Minimal 1</small>');
                $total_error[] = $keranjang[$k]['stok'];
            }
        }


        if (count($total_error) != 0) {
            $data['total_error'] = count($total_error);
            $this->session->set_flashdata('total_error', count($total_error));
            redirect('depan/transaksi/keranjang', $data);
        }



        $i = 0;
        foreach ($jml_order as $j) {
            $this->db->set('stok_sewa', $j);
            $this->db->where('id_pelanggan', $id_pelanggan);
            $this->db->where('id_perlengkapan', $id_perlengkapan[$i]);
            $this->db->update('keranjang');
            $i++;
        }
        redirect('depan/transaksi/keranjang');
    }
}
