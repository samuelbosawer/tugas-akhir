<?php

use Mpdf\Tag\P;

defined('BASEPATH') or exit('No direct script access allowed');

class Keranjang extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        cek_login_pelanggan();
    }
    public function index()
    {
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

        $data = array(
            'id_ranjang' => $id_ranjang,
            'id_pelanggan' => $id_pelanggan,
            'id_perlengkapan' => $id_perlengkapan,
            'stock_sewa' => $stock_sewa
        );
        $this->sewa_model->insert_data($data, 'keranjang');
        redirect('depan/transaksi/keranjang');
    }

    public function getKeranjang()
    {
        $data['pelanggan'] = $this->db->get_where('pelanggan', ['email' => $this->session->userdata('email')])->row_array();
        $id_pelanggan = $data['pelanggan']['id_pelanggan'];

        $cek = $this->db->query("SELECT * FROM keranjang, perlengkapan, penyewaan WHERE keranjang.id_perlengkapan = penyewaan.id_perlengkapan AND penyewaan.id_pelanggan = '$id_pelanggan'  AND keranjang.id_pelanggan = '$id_pelanggan' AND perlengkapan.id_perlengkapan = keranjang.id_perlengkapan GROUP BY perlengkapan.id_perlengkapan")->result();

        $query2 = "SELECT penyewaan.id_perlengkapan, penyewaan.jumlah_stok FROM perlengkapan, penyewaan WHERE penyewaan.id_perlengkapan = perlengkapan.id_perlengkapan AND  penyewaan.id_pelanggan = '$id_pelanggan'  AND penyewaan.status_pembayaran = 'settlement' AND penyewaan.status_sewa = 1 GROUP BY perlengkapan.id_perlengkapan";

        $query = "SELECT * FROM keranjang, perlengkapan WHERE  keranjang.id_pelanggan = '$id_pelanggan' AND perlengkapan.id_perlengkapan = keranjang.id_perlengkapan GROUP BY perlengkapan.id_perlengkapan";

        $hasil1 = $this->db->query($query)->result_array();
        $hasil2 = $this->db->query($query2)->result_array();
        $hasil3 = array_merge($hasil1);

        echo json_encode($hasil3);
    }
    public function updateKeranjang()
    {

        $pelanggan = $this->db->get_where('pelanggan', ['email' => $this->session->userdata('email')])->row_array();
        $id_pelanggan = $pelanggan['id_pelanggan'];
        $jumlah = $this->input->post('jumlah');
        $id_perlengkapan = $this->input->post('id_perlengkapan');
        if ($jumlah == '0') {
            $jumlah = '1';
        };
        if ($jumlah == '') {
            $jumlah = '1';
        };
        $cekStok = $this->db->query("SELECT * FROM perlengkapan WHERE id_perlengkapan = '$id_perlengkapan'")->result();
        if ($cekStok) {
            $jumlahStok = 0;
            foreach ($cekStok as $cs) {
                $jumlahStok = $jumlahStok + $cs->stok;
            }
            if ($jumlah > $jumlahStok) {
                $jumlah = $jumlahStok;
            }
        }
        $cek =  $this->db->query("SELECT * FROM perlengkapan, penyewaan WHERE penyewaan.id_perlengkapan = '$id_perlengkapan' AND perlengkapan.id_perlengkapan = penyewaan.id_perlengkapan AND  penyewaan.status_pembayaran = 'settlement' AND penyewaan.status_sewa = 1 ")->result();

        if ($cek) {
            $jumlahsewa = 0;
            foreach ($cek as $c) {
                $jumlahsewa = $c->jumlah_stok + $jumlahsewa;
            }
            $kurang = $c->stok - $jumlahsewa;
            if ($jumlah > $kurang) {
                $jumlah = $kurang;
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> Stok terbatas !  </div>');
            }
        }

        $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button> Stok terbatas !  </div>');

        $query = "UPDATE keranjang SET stok_sewa = '$jumlah' WHERE id_pelanggan = '$id_pelanggan' AND id_perlengkapan = '$id_perlengkapan' ";
        $hasil = $this->db->query($query);
        echo json_encode($hasil);
    }
    public function hapusKeranjang()
    {
        $pelanggan = $this->db->get_where('pelanggan', ['email' => $this->session->userdata('email')])->row_array();
        $id_pelanggan = $pelanggan['id_pelanggan'];
        $id_perlengkapan = $this->input->post('id_perlengkapan');

        $query = "DELETE FROM keranjang WHERE id_pelanggan = '$id_pelanggan' AND id_perlengkapan = '$id_perlengkapan' ";
        $hasil = $this->db->query($query);
        echo json_encode($hasil);
    }

    public function labelHarga()
    {
        $hariKedepan = date_create($this->input->post('hari'));
        $awal = date_create();
        $hari =   date_diff($awal, $hariKedepan);
        if ($hariKedepan < $awal) {
            $haribaru = 0;
            echo "
            <script>
            $(document).ready(function() {
                document.getElementById('pay-button').disabled = true;
            });
            </>
            <input type='hidden' id='harga' value='" . $haribaru . "' name='harga'>  <h6 class='m-0 align-self-center text-success'> Tanggal Error </h6>";
        } elseif ($hari->d == 0) {
            $haribaru = 1;
            $this->session->set_userdata('hari', $haribaru);
            echo "
            <script>
            $(document).ready(function() {
                document.getElementById('pay-button').disabled = false;
            });
        </script>
            
            <input onchange='this.form.submit()'   type='hidden'  value='" . $haribaru . "'  id='harga' name='harga'>  <h6 class='m-0 align-self-center text-success'> Sewa " . $haribaru . " hari </h6>";
        } elseif ($hariKedepan > $awal) {
            $diff  = date_diff($awal, $hariKedepan);
            $haribaru = $diff->d + 1;
            echo "
            
            <script>
            $(document).ready(function() {
                document.getElementById('pay-button').disabled = false;
            });
            </script>
            
            
            <input onchange='this.form.submit()' type='hidden' value='" . $haribaru . "' id='harga' name='harga'>  <h6 class='m-0 align-self-center text-success'> Sewa " . $haribaru . " hari </h6>";
            $this->session->set_userdata('hari', $haribaru);
        }
    }
    public function editinfopelanggan()
    {
        $nama = $this->input->post('nama');
        $nm_hp = $this->input->post('nm_hp');
        $alamat_distrik = $this->input->post('alamat_distrik');
        $alamat_jalan = $this->input->post('alamat_jalan');
        $id_pelanggan = $this->session->userdata('id_pelanggan');
        $data = array(
            'nama'         => $nama,
            'nm_hp'         => $nm_hp,
            'alamat_distrik'         => $alamat_distrik,
            'alamat_jalan'         => $alamat_jalan,
        );
        $id = array(
            'id_pelanggan'         => $id_pelanggan
        );

        $this->sewa_model->update_data($data, 'pelanggan', $id);

        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Informasi telah diupdate!</div>');
        redirect('depan/transaksi/keranjang');
    }
    public function getTotal()
    {
        // Selisih hari
        $hariKedepan = date_create($this->input->post('hari'));
        $awal = date_create();
        $hari =   date_diff($awal, $hariKedepan);

        // update tanggal di tabel ranjang
        $pelanggan = $this->db->get_where('pelanggan', ['email' => $this->session->userdata('email')])->row_array();
        $id_pelanggan = $pelanggan['id_pelanggan'];
        $ranjang = $this->db->query("SELECT * FROM keranjang WHERE id_pelanggan = '$id_pelanggan' ")->result();

        // foreach ($ranjang as $r) {
        // echo $awal;
        $mulai = $awal->format('Y-m-d');
        $query = "UPDATE keranjang SET waktu_mulai = '$mulai' WHERE id_pelanggan = '$id_pelanggan'";
        $hasil = $this->db->query($query);

        $akhir = $hariKedepan->format('Y-m-d');
        $query = "UPDATE keranjang SET waktu_akhir = '$akhir' WHERE id_pelanggan = '$id_pelanggan'";
        $hasil = $this->db->query($query);



        // Ambil harga 
        $data['pelanggan'] = $this->db->get_where('pelanggan', ['email' => $this->session->userdata('email')])->row_array();
        $id_pelanggan = $data['pelanggan']['id_pelanggan'];
        $query = "SELECT * FROM keranjang, perlengkapan WHERE keranjang.id_pelanggan = '$id_pelanggan' AND perlengkapan.id_perlengkapan = keranjang.id_perlengkapan GROUP BY perlengkapan.id_perlengkapan";
        $hasil = $this->db->query($query)->result_array();
        if ($hariKedepan < $awal) {
            $harga = 0;
            echo "
          
            
            <h6 class='m-0 align-self-center text-success'>Rp. " . number_format($harga) . "</h6>";
        } elseif ($hari->d == 0) {
            $haribaru = 1;
            $harga = 0;
            foreach ($hasil as $h) {
                $harga += intval($h['harga'] * $h['stok_sewa']);
            }
            $harga = $harga * $haribaru;
            echo "<h6 class='m-0 align-self-center text-success'>Rp. " . number_format($harga) . "</h6>";
        } elseif ($hariKedepan > $awal) {
            $diff  = date_diff($awal, $hariKedepan);
            $haribaru = $diff->d + 1;
            $harga = 0;
            foreach ($hasil as $h) {
                $harga += intval($h['harga'] * $h['stok_sewa']);
            }
            $harga = $harga * $haribaru;
            echo "<h6 class='m-0 align-self-center text-success'>Rp. " . number_format($harga) . "</h6>";
        }
    }
    public function addperlengkapan($id)
    {
        $data['title'] = 'Keranjang';
        $perlengkapan = $id;
        $id_akun = $this->session->userdata('id_pelanggan');
        $dalam = $this->db->query("SELECT * FROM keranjang WHERE id_perlengkapan = '$perlengkapan' AND id_pelanggan = '$id_akun' ")->row_array();

        if ($dalam) {

            $id_ranjang = $dalam['id_ranjang'];
            $stok = (int)$dalam['stok_sewa'] + 1;
            $cek =  $this->db->query("SELECT * FROM perlengkapan, penyewaan WHERE penyewaan.id_perlengkapan = '$perlengkapan' AND perlengkapan.id_perlengkapan = penyewaan.id_perlengkapan AND  penyewaan.status_pembayaran = 'settlement' AND penyewaan.status_sewa = 1 ")->result();
            if ($cek) {
                $jumlahsewa = 0;
                foreach ($cek as $c) {
                    $jumlahsewa = $c->jumlah_stok + $jumlahsewa;
                }
                $kurang = $c->stok - $jumlahsewa;
                if ($stok > $kurang) {
                    $stok = $kurang;
                }
            };
            $data = array(
                'stok_sewa'              => $stok,
            );
            $id = array('id_ranjang'              => $id_ranjang);
            $this->sewa_model->update_data($data, 'keranjang', $id);
            redirect('depan/transaksi/keranjang');
        }
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

        $data = array(
            'id_ranjang' => $id_ranjang,
            'id_pelanggan' => $id_pelanggan,
            'id_perlengkapan' => $id_perlengkapan,
            'stok_sewa' => $stock_sewa

        );
        $this->sewa_model->insert_data($data, 'keranjang');
        redirect('depan/transaksi/keranjang');
    }
}
