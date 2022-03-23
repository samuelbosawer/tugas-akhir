<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penyewaan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $params = array('server_key' => 'SB-Mid-server-CPFhEb941poDUZmwImeJ-GiQ', 'production' => false);
        $this->load->library('midtrans');
        $this->midtrans->config($params);
        $this->load->helper('url');
    }

    // MIDTRANS =======================================================================
    public function token()
    {
        $pelanggan = $this->db->get_where('pelanggan', ['email' => $this->session->userdata('email')])->row_array();
        $id_pelanggan = $pelanggan['id_pelanggan'];
        $query = "SELECT `perlengkapan`.*, `keranjang`.* 
        FROM `perlengkapan` JOIN `keranjang`
        ON `perlengkapan`.`id_perlengkapan` = `keranjang`.`id_perlengkapan` AND `keranjang`.`id_pelanggan` = '$id_pelanggan' ";
        $keranjang = $this->db->query($query)->result_array();
        $daftar_sewa = [];
        foreach ($keranjang as $k) {
            $total[] = $k['stok_sewa'] * $k['harga'] * $this->session->userdata('hari');
            $daftar_sewa[] = [
                'id' => $k['id_perlengkapan'],
                'price' => $k['harga'],
                'quantity' => $k['stok_sewa'] * $this->session->userdata('hari'),
                'name' => $k['nama_perlengkapan']
            ];
        }

        // Required
        $transaction_details = array(
            'order_id' => 'sw-' . time() . '-' . rand(111, 999),
            'gross_amount' => array_sum($total) // no decimal allowed for creditcard
        );

        $pelanggan = $this->db->get_where('pelanggan', ['email' => $this->session->userdata('email')])->row_array();

        // Optional
        $item_details[] = $daftar_sewa;
        $item_details1[] = [
            'id' => '',
            'price' => 200,
            'quantity' => 1,
            'name' => 'Hari'
        ];
        $item_details2 = $item_details[0];
        // Optional
        $billing_address = array(
            'first_name'    => $pelanggan['nama'],
            'last_name'     => "",
            'address'       => "jln " . $pelanggan['alamat_jalan'] . ", Distrik " . $pelanggan['alamat_distrik'],
            'city'          => "Jayapura",
            'postal_code'   => "",
            'phone'         => $pelanggan['nm_hp'],
            'country_code'  => 'IDN'
        );

        //  Optional
        $shipping_address = array(
            'first_name'    => $pelanggan['nama'],
            'last_name'     => "",
            'address'       => "jln " . $pelanggan['alamat_jalan'] . ", Distrik " . $pelanggan['alamat_distrik'],
            'city'          => "Jayapura",
            'postal_code'   => "",
            'phone'         => $pelanggan['nm_hp'],
            'country_code'  => 'IDN'
        );

        // Optional
        $customer_details = array(
            'first_name'    => $pelanggan['nama'],
            'last_name'     => "",
            'email'         => $this->session->userdata('email'),
            'phone'         => $pelanggan['nm_hp'],
            'billing_address'  => $billing_address,
            'shipping_address' => $shipping_address
        );

        // Data yang akan dikirim untuk request redirect_url.
        $credit_card['secure'] = true;
        // //ser save_card true to enable oneclick or 2click
        // //$credit_card['save_card'] = true;
        $enabled_payments = array(
            "bni_va", "bri_va", "bca_va", "gopay", "ovo"
        );
        $time = time();
        $custom_expiry = array(
            'start_time' => date("Y-m-d H:i:s O", $time),
            'unit' => 'minute',
            'duration'  => 30
        );
        $transaction_data = array(
            'transaction_details' => $transaction_details,
            'item_details'       => $item_details2,
            'customer_details'   => $customer_details,
            'credit_card'        => $credit_card,
            'enabled_payments'               => $enabled_payments,
            'expiry'             => $custom_expiry
        );

        error_log(json_encode($transaction_data));
        $snapToken = $this->midtrans->getSnapToken($transaction_data);
        error_log($snapToken);
        echo $snapToken;
    }
    public function finish()
    {

        $result = json_decode($this->input->post('result_data'));

        var_dump($result);
        $pelanggan = $this->db->get_where('pelanggan', ['email' => $this->session->userdata('email')])->row_array();
        $id_pelanggan = $pelanggan['id_pelanggan'];

        $query = "SELECT* FROM perlengkapan , keranjang  WHERE perlengkapan.id_perlengkapan = keranjang.id_perlengkapan AND  keranjang.id_pelanggan = '$id_pelanggan' GROUP BY perlengkapan.id_perlengkapan";
        $ranjang = $this->db->query($query)->result_array();

        $kode = $this->kode_model->kd_sewa_terakhir();
        error_reporting(0);
        if ($kode->id_sewa != null) {
            $id_sewa = $kode->id_sewa;
        } else {
            $id_sewa = "sw-0000";
        }
        $no_urut = (int)substr($id_sewa, 3, 4);

        $id = "sw-";


        foreach ($ranjang as $k) {
            $no_urut++;
            $id_sewa_baru = $id . sprintf("%04s", $no_urut);
            $datapenyewaan = [
                'no_penyewaan' => $result->order_id,
                'id_sewa' => $id_sewa_baru,
                'id_pelanggan' => $k['id_pelanggan'],
                'id_perlengkapan' => $k['id_perlengkapan'],
                'harga' => $k['harga'] * $k['stok_sewa'] * $this->session->userdata('hari'),
                'mulai_sewa' => $k['waktu_mulai'],
                'akhir_sewa' => $k['waktu_akhir'],
                'jumlah_stok' => $k['stok_sewa'],
                'status_sewa' => '0',
                'status_pembayaran' => $result->transaction_status
            ];
            $this->db->insert('penyewaan', $datapenyewaan);

            $dataPendapatan = [
                'id_pendapatan' => '',
                'id_sewa' => $this->db->insert_id(),
                'pendapatan_admin' => (1 / 100) * $k['harga'] * $k['stok_sewa'] * $this->session->userdata('hari'),
                'pendapatan_tempat' => $k['harga'] * $k['stok_sewa'] * $this->session->userdata('hari') - (1 / 100) * $k['harga'] * $k['stok_sewa'] * $this->session->userdata('hari'),
                'tanggal' => $k['waktu_mulai']
            ];

            $this->db->insert('pendapatan', $dataPendapatan);
            $this->db->delete('keranjang', ['id_pelanggan' => $id_pelanggan]);
        }


        $status = $this->midtrans->status($result->order_id);
        if ($status->transaction_status == 'pending') {
            $judulPesan = 'Segera Transfer';
            $isiPesan1 = 'silahkan melakukan pembayar sebelum 30 menit setelah melakukan checkout';
            $isiPesan2 = 'Ditunggu yah ';
            $gambar = 'pending.jpg';
        } else  if ($status->transaction_status == 'settlement') {
            $judulPesan = 'Checkout Berhasil';
            $isiPesan1 = 'Anda akan Perlengkapan akan diantar !';
            $isiPesan2 = 'Harap bersabar ';
            $gambar = 'sukses.png';
        }

        $this->session->set_flashdata('bayar', '<div class="modal fade checkout-modal-success" id="checkoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-body text-center">
                                <img src="' . base_url() . 'assets/cart/' . $gambar . '" class="mb-5" style="width: 200px;">
                                <h3>' . $judulPesan . '</h3>
                                <p>' . $isiPesan1 . ' <br> ' . $isiPesan2 . '<span class=""><i class="fas fa-smile-beam"></i></p>
                                <button type="button" class="btn mt-3" data-dismiss="modal" style="background-color: #EAEAEF; color: #ADADAD;">Home</button>
                            </div>
                        </div>
                    </div>
                </div>');
        redirect('depan/beranda');
    }
}
