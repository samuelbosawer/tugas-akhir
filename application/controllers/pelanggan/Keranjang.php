<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Keranjang extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // cek_login_tempat_sewa();
    }
    public function index()
    {
        cek_login_pelanggan();
        if ($this->session->userdata('hak_akses') != 3) {
            redirect('pelanggan/beranda');
        };
        $data['title'] = 'Keranjang';
        $data['pelanggan'] = $this->db->get_where('pelanggan', ['email' => $this->session->userdata('email')])->row_array();
        $id_pelanggan = $data['pelanggan']['id_pelanggan'];

        $query = "SELECT * FROM perlengkapan, ranjang WHERE perlengkapan.id_perlengkapan = ranjang.id_perlengkapan AND ranjang.id_pelanggan = '$id_pelanggan' GROUP BY perlengkapan.id_perlengkapan";
        $data['ranjang'] = $this->db->query($query)->result_array();

        // Cek apakah barang masih tersedia atau sudah dibeli nanti akan terhapus otomatis
        if ($data['ranjang']) {
            foreach ($data['ranjang'] as $r) {
                if ($r['stok_sewa'] > $r['stok']) {
                    $this->db->set('stok_sewa', $r['stok']);
                    $this->db->where('id_perlengkapan', $r['id_perlengkapan']);
                    $this->db->where('id_pelanggan', $id_pelanggan);
                    $this->db->update('ranjang');
                    redirect('pelanggan/ranjang');
                }
            }
            $this->load->view('tamplates_pelanggan/header', $data);
            $this->load->view('pelanggan/keranjang');
            $this->load->view('tamplates_pelanggan/footer');
        } else {

            redirect('pelanggan/beranda');
        }
    }
    public function tambahperlengkapan($id)
    {
        $data['title'] = 'Keranjang';

        $datap = $this->db->query("SELECT * FROM perlengkapan WHERE id_perlengkapan = '$id'")->row();
        $kode = $this->kode_model->kd_ranjang_terakhir()->row();
        if ($kode->id_ranjang != null) {
            $id_ranjang = $kode->id_ranjang;
        } else {
            $id_ranjang = "rjg-0000";
        }
        $no_urut = (int)substr($id_ranjang, 4, 4);
        $no_urut++;
        $id = "rjg-";
        $id_ranjang         = $id . sprintf("%04s", $no_urut);
        $id_pelanggan       = $this->session->userdata('id_pelanggan');
        $id_perlengkapan    = $datap->id_perlengkapan;
        $stock_sewa    = 1;
        $waktu_mundur       = date("Y-m-d h:i:sa");
        $data = array(
            'id_ranjang' => $id_ranjang,
            'id_pelanggan' => $id_pelanggan,
            'id_perlengkapan' => $id_perlengkapan,
            'stock_sewa' => $stock_sewa,
            'waktu_mundur' => $waktu_mundur
        );
        $this->sewa_model->insert_data($data, 'ranjang');
        redirect('pelanggan/keranjang');
    }

    public function getKeranjang()
    {
        $data['pelanggan'] = $this->db->get_where('pelanggan', ['email' => $this->session->userdata('email')])->row_array();
        $id_pelanggan = $data['pelanggan']['id_pelanggan'];
        // $query = "SELECT perlengkapan.*, ranjang.* FROM perlengkapan, ranjang WHERE perlengkapan.id_perlengkapan = ranjang.id_ranjang AND ranjang.id_pelanggan = '$id_pelanggan' GROUP BY perlengkapan.id_perlengkapan";
        $query = "SELECT * FROM ranjang, perlengkapan WHERE ranjang.id_pelanggan = '$id_pelanggan' AND perlengkapan.id_perlengkapan = ranjang.id_perlengkapan GROUP BY perlengkapan.id_perlengkapan";
        $hasil = $this->db->query($query)->result_array();
        echo json_encode($hasil);
    }
    public function updateKeranjang()
    {
        $pelanggan = $this->db->get_where('pelanggan', ['email' => $this->session->userdata('email')])->row_array();
        $id_pelanggan = $pelanggan['id_pelanggan'];
        $stok_sewa = $pelanggan['stok_sewa'];
        $id_perlengkapan = $pelanggan['id_perlengkapan'];
        $query = "UPDATE keranjang SET stok_sewa = '$stok_sewa' WHERE id_pelanggan = '$id_pelanggan' AND id_perlengkapan = '$id_perlengkapan' ";
        $hasil = $this->db->query($query);
        echo json_encode($hasil);
    }
}
