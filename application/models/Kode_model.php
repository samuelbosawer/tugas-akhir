<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kode_model extends CI_Model
{
    public function kd_perlengkapan_terakhir()
    {
        $hasil = $this->db->query("SELECT * FROM perlengkapan ORDER BY id_perlengkapan DESC LIMIT 1");
        return $hasil;
    }
    public function kd_paket_terakhir()
    {
        $hasil = $this->db->query("SELECT * FROM perlengkapan ORDER BY id_perlengkapan DESC LIMIT 1");
        return $hasil;
    }
    public function kd_tempat_terakhir()
    {
        $hasil = $this->db->query("SELECT * FROM tempat_sewa ORDER BY id_tempat DESC LIMIT 1");
        return $hasil;
    }
    public function kd_pelanggan_terakhir()
    {
        $hasil = $this->db->query("SELECT * FROM pelanggan ORDER BY id_pelanggan DESC LIMIT 1");
        return $hasil;
    }
    public function kd_ranjang_terakhir()
    {
        $hasil = $this->db->query("SELECT * FROM keranjang ORDER BY id_ranjang DESC LIMIT 1");
        return $hasil;
    }
    public function kd_sewa_terakhir()
    {
        $hasil = $this->db->query("SELECT * FROM penyewaan ORDER BY id_sewa DESC LIMIT 1");
        return $hasil;
    }
    public function kd_rating_terakhir()
    {
        $hasil = $this->db->query("SELECT * FROM rating ORDER BY id_rating DESC LIMIT 1");
        return $hasil;
    }
}
