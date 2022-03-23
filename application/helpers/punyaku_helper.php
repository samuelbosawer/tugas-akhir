<?php

function cek_login_admin()
{
    $ci = get_instance();
    $email = $ci->session->userdata('email');
    $query = "SELECT * FROM login WHERE email = '$email'";
    $pengguna = $ci->db->query($query)->row_array();
    if (!$pengguna) {
        redirect('auth');
    }
    if (($pengguna['email'] != $ci->session->userdata('email')) and ($pengguna['hak_akses'] != 1)) {
        redirect('auth');
    }
    if ($pengguna['hak_akses'] == 2 or $pengguna['hak_akses'] == 3) {
        redirect('auth');
    }
}

function cek_login_tempat_sewa()
{
    $ci = get_instance();
    $email = $ci->session->userdata('email');
    $query = "SELECT * FROM login WHERE email = '$email'";
    $pengguna = $ci->db->query($query)->row_array();
    if (!$pengguna) {
        redirect('auth');
    }
    if (($pengguna['email'] != $ci->session->userdata('email')) and ($pengguna['hak_akses'] != 2)) {
        redirect('auth');
    }
    if ($pengguna['hak_akses'] == 1 or $pengguna['hak_akses'] == 3) {
        redirect('auth');
    }
}
function cek_login_pelanggan()
{
    $ci = get_instance();
    $email = $ci->session->userdata('email');
    $query = "SELECT * FROM login WHERE email = '$email'";
    $pengguna = $ci->db->query($query)->row_array();
    if (!$pengguna) {
        redirect('auth');
    }
    if (($pengguna['email'] != $ci->session->userdata('email')) and ($pengguna['hak_akses'] != 3)) {
        redirect('auth');
    }
    if ($pengguna['hak_akses'] == 1 or $pengguna['hak_akses'] == 2) {
        redirect('auth');
    }
}

function cek_laporan()
{
    $ci = get_instance();
    $email = $ci->session->userdata('email');
    $query = "SELECT * FROM login WHERE email = '$email'";
    $pengguna = $ci->db->query($query)->row_array();
    if (!$pengguna) {
        redirect('auth');
    }
    if (($pengguna['email'] != $ci->session->userdata('email')) and ($pengguna['hak_akses'] != 1 or $pengguna['hak_akses'] != 2)) {
        redirect('auth');
    }
    if ($pengguna['hak_akses'] == 3) {
        redirect('auth');
    }
}
function update_laporan()
{
    $ci = get_instance();
    $jml_perlengkapan = [];
    $queryCoba = "SELECT penyewaan.*, perlengkapan.nama_perlengkapan, perlengkapan.stok, COALESCE(penyewaan.no_penyewaan, 'total') as total, COALESCE(perlengkapan.id_perlengkapan, 'total_perlengkapan') as id_perlengkapan, sum(penyewaan.jumlah_stok) as jml_sewa FROM penyewaan, perlengkapan WHERE penyewaan.id_perlengkapan = perlengkapan.id_perlengkapan AND penyewaan.status_pembayaran != 'settlement' GROUP BY perlengkapan.id_perlengkapan, penyewaan.id_pelanggan, penyewaan.no_penyewaan WITH ROLLUP ";
    $coba = $ci->db->query($queryCoba)->result_array();



    $params = array('server_key' => 'SB-Mid-server-CPFhEb941poDUZmwImeJ-GiQ', 'production' => false);
    $ci->load->library('midtrans');
    $ci->midtrans->config($params);
    $ci->load->helper('url');

    foreach ($coba as $p) {
        if (($p['total'] == 'total') and ($p['id_pelanggan'] == NULL) and ($p['id_perlengkapan'] != 'total_perlengkapan')) {
            $jml_perlengkapan[] = $p;
        }
    }



    $query = "SELECT penyewaan.*, perlengkapan.nama_perlengkapan, perlengkapan.stok FROM penyewaan, perlengkapan WHERE penyewaan.id_perlengkapan = perlengkapan.id_perlengkapan";
    $penyewaan = $ci->db->query($query)->result_array();


    $tes = $ci->midtrans->status('sw-1635836634-992');

    for ($i = 0; $i < count($penyewaan); $i++) {

        $status[$i] = $ci->midtrans->status($penyewaan[$i]['no_penyewaan']);
    }



    $i = 0;
    foreach ($penyewaan as  $p) {
        if ($status[$i]->transaction_status == 'settlement') {
            $ci->db->set('status_pembayaran', 'settlement');
            $ci->db->where('no_penyewaan', $p['no_penyewaan']);
            $ci->db->update('penyewaan');
        }

        if ($status[$i]->transaction_status == 'expire') {
            $ci->db->delete('penyewaan', ['no_penyewaan' => $p['no_penyewaan']]);
        }

        $i++;
    }
}
