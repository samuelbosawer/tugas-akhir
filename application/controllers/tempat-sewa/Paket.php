<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Paket extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        cek_login_tempat_sewa();
    }
    public function index()
    {
        $data['title'] = 'Data Paket';
        $id = $this->session->userdata('id_tempat');
        $data['paket'] = $this->db->query("SELECT * FROM perlengkapan WHERE kategori = 'paket' AND id_tempat = '$id' ")->result();
        $data['disewa'] = $this->db->query("SELECT * FROM perlengkapan, penyewaan WHERE perlengkapan.id_tempat = '$id' AND perlengkapan.kategori = 'paket' AND perlengkapan.id_perlengkapan = penyewaan.id_perlengkapan AND  penyewaan.status_pembayaran = 'settlement' ")->result();
        $this->load->view('tamplates_admin/header', $data);
        $this->load->view('tamplates_ts/sidebar');
        $this->load->view('tempat-sewa/data-paket', $data);
        $this->load->view('tamplates_admin/footer');
    }
    public function tambah_paket()
    {
        $data['title'] = 'Tambah Data Paket';
        $id = $this->session->userdata('id_tempat');
        $data['paket'] = $this->db->query("SELECT * FROM perlengkapan WHERE kategori = 'paket' AND id_tempat = '$id' ")->result();
        $data['kode'] = $this->kode_model->kd_paket_terakhir()->row();
        // $data['paket'] = $this->db->query("SELECT * FROM paket WHERE ")
        $this->load->view('tamplates_admin/header', $data);
        $this->load->view('tamplates_ts/sidebar');
        $this->load->view('tempat-sewa/tambah-paket', $data);
        $this->load->view('tamplates_admin/footer');
    }
    function aksi_tambah_paket()
    {
        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $this->tambah_paket();
        } else {
            $id_perlengkapan = $this->input->post('id_perlengkapan');
            $nama_perlengkapan = $this->input->post('nama_perlengkapan');
            $kategori = 'Paket';
            $harga = $this->input->post('harga');
            $stok = $this->input->post('stok');
            $deskripsi = $this->input->post('deskripsi');
            $id_tempat = $this->session->userdata('id_tempat');
            $foto = $_FILES['foto']['name'];
            if ($foto == '') {
            } else {
                $config['upload_path'] = './assets/upload/perlengkapan';
                $config['allowed_types'] = 'jpg|jpeg|png|tiff';
                $config['max_size'] = '2048';
                $config['file_name'] = 'plk-' . date('ymd') . '-' . substr(md5(rand()), 0, 6);
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('foto')) {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            Gambar gagar diupload!
        </div>
');
                    redirect('tempat-sewa/paket');
                } else {
                    $foto = $this->upload->data('file_name');
                }
            }
            $data = array(
                'id_perlengkapan'       => $id_perlengkapan,
                'nama_perlengkapan'     => $nama_perlengkapan,
                'kategori'              => $kategori,
                'harga'                 => $harga,
                'stok'                  => $stok,
                'id_tempat'             => $id_tempat,
                'foto'                  => $foto,
                'deskripsi'             => $deskripsi,
            );
            $this->sewa_model->insert_data($data, 'perlengkapan');
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            Data paket berhasil ditambahkan !
        </div>
');
            redirect('tempat-sewa/paket');
        }
    }
    public function update_paket($id)
    {
        $data['title'] = 'Ubah Data Paket';
        $id_tempat = $this->session->userdata('id_tempat');
        $data['detail'] = $this->db->query("SELECT * FROM perlengkapan WHERE id_perlengkapan = '$id' AND kategori = 'paket' AND id_tempat = '$id_tempat' ")->result();
        $this->load->view('tamplates_admin/header', $data);
        $this->load->view('tamplates_ts/sidebar');
        $this->load->view('tempat-sewa/update-paket', $data);
        $this->load->view('tamplates_admin/footer');
    }
    public function aksi_ubah_paket()
    {
        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $id_perlengkapan = $this->input->post('id_perlengkapan');
            $this->tambah_paket($id_perlengkapan);
        } else {
            $id_perlengkapan = $this->input->post('id_perlengkapan');
            $nama_perlengkapan = $this->input->post('nama_perlengkapan');
            $harga = $this->input->post('harga');
            $stok = $this->input->post('stok');
            $deskripsi = $this->input->post('deskripsi');
            $foto = $_FILES['foto']['name'];
            if ($foto == '') {
            } else {
                $config['upload_path'] = './assets/upload/perlengkapan';
                $config['allowed_types'] = 'jpg|jpeg|png|tiff';
                $config['max_size'] = '2048';
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('foto')) {
                    $foto = $this->upload->data('file_name');
                    $this->db->set('foto', $foto);
                } else {
                }
            }
            $data = array(
                'id_perlengkapan'   => $id_perlengkapan,
                'nama_perlengkapan'    => $nama_perlengkapan,
                'harga'                 => $harga,
                'kategori'              => 'paket',
                'stok'                  => $stok,
                'deskripsi'             => $deskripsi,
            );
            $id = array('id_perlengkapan' => $id_perlengkapan);
            $this->sewa_model->update_data($data, 'perlengkapan', $id);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            Data paket berhasil diubah !
        </div>
');
            redirect('tempat-sewa/paket');
        }
    }
    public function detail_paket($id)
    {
        $data['title'] = 'Detail Data Paket';
        $id_tempat = $this->session->userdata('id_tempat');
        $data['detail'] = $this->db->query("SELECT * FROM perlengkapan WHERE id_perlengkapan = '$id' AND kategori = 'paket' AND id_tempat = '$id_tempat' ")->result();
        $this->load->view('tamplates_admin/header', $data);
        $this->load->view('tamplates_ts/sidebar');
        $this->load->view('tempat-sewa/detail-paket', $data);
        $this->load->view('tamplates_admin/footer');
    }
    public function _rules()
    {
        $this->form_validation->set_rules('nama_perlengkapan', 'Nama Perlengkapan', 'required');
        $this->form_validation->set_rules('harga', 'Harga Paket Perlengkapan', 'required|integer');
        $this->form_validation->set_rules('stok', 'Jumlah Stok Paket ', 'required|integer');
        $this->form_validation->set_message('required', '%s masih kosong, silahkan diisi !');
        $this->form_validation->set_message('integer', '%s harus angka, silahkan diisi dengan benar!');
    }
    public function delete_paket($id)
    {
        $where = array('id_perlengkapan' => $id);
        $this->sewa_model->delete_data($where, 'perlengkapan');
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        Data paket berhasil dihapus !
        </div>');
        redirect('tempat-sewa/paket');
    }
}
